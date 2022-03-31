<?php
include("connect.php");

function getClassLinksByMemberId($con, $member_id, $m_class_id)
{
    $query_class_m = "
SELECT C.class_ID, C.name
FROM Class C
         JOIN Enrollment E on C.class_ID = E.class_ID
         JOIN Member M on E.member_ID = M.member_ID
WHERE M.member_ID = $member_id AND C.class_ID <> $m_class_id
ORDER BY C.class_ID DESC
    ";
    $result_class_m = mysqli_query($con, $query_class_m) or die("Unable to execute query:" . mysqli_error($con));
    $link_entries = array();
    while ($row = mysqli_fetch_array($result_class_m, MYSQLI_ASSOC)) {
        $class_ID = $row["class_ID"];
        $name = $row["name"];
        $link_html = "<a href='q10.php?class_ID=$class_ID'>$name</a>";
        array_push($link_entries, $link_html);
    }
    mysqli_free_result($result_class_m);
    return implode("<br>", $link_entries);
}

function getClassMemberCount($con, $cid)
{
    $query_m_count = "
SELECT COUNT(*) as count
FROM Member M
         JOIN Enrollment E on M.member_ID = E.member_ID
         JOIN Class C on E.class_ID = C.class_ID
WHERE C.class_ID = '$cid'
    ";
    $result_m_count = mysqli_query($con, $query_m_count) or die("Unable to execute query:" . mysqli_error($con));
    $row = mysqli_fetch_array($result_m_count, MYSQLI_ASSOC);
    mysqli_free_result($result_m_count);
    return intval($row["count"]);
}

$class_id = mysqli_real_escape_string($con, $_GET["class_ID"]);

// prepare the database query
// select the branch_ID and name of the branches in the “Tai Po” district.
$query_class = "
SELECT C.class_ID, C.name as class_name, C.date, C.capacity, C.description, I.name as instructor_name
FROM Class C
         JOIN Instructor I on C.instructor_ID = I.instructor_ID
WHERE C.class_ID = '$class_id'
ORDER BY C.class_ID DESC
";

// execute the query
$result_class = mysqli_query($con, $query_class) or die("Unable to execute query:" . mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 10</title>";
echo "</head>";
echo "<body  align=center>";
echo "<h3>Q10 Answer</h3>";

// display the table
echo "<table border='1' align='center'>";
echo "<tr>";
echo "<td>class_ID</td>";
echo "<td>class_name</td>";
echo "<td>date</td>";
echo "<td>capacity</td>";
echo "<td>description</td>";
echo "<td>instructor_name</td>";
echo "</tr>";

// print data with HTML
while ($row = mysqli_fetch_array($result_class, MYSQLI_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['class_ID'] . "</td>";
    echo "<td>" . $row['class_name'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['capacity'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['instructor_name'] . "</td>";
    echo "</tr>";
}
echo "</table><br><br>";

// last step: free the tuple result and close the MySQL database connection
mysqli_free_result($result_class);

if (getClassMemberCount($con, $class_id) == 0) {
    echo "No enrollment yet";
} else {
    $query_member = "
SELECT M.member_ID, M.name as member_name
FROM Member M
         JOIN Enrollment E on M.member_ID = E.member_ID
         JOIN Class C on E.class_ID = C.class_ID
WHERE C.class_ID = $class_id
ORDER BY M.member_ID DESC
    ";
    echo "<table border='1' align='center'>";
    echo "<tr>";
    echo "<td>member_ID</td>";
    echo "<td>member_name</td>";
    echo "<td>classes_enrolled</td>";
    echo "</tr>";
    $result_member = mysqli_query($con, $query_member) or die("Unable to execute query:" . mysqli_error($con));
    while ($row = mysqli_fetch_array($result_member, MYSQLI_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['member_ID'] . "</td>";
        echo "<td>" . $row['member_name'] . "</td>";
        echo "<td>" . getClassLinksByMemberId($con, $row['member_ID'], $class_id) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result_member);
}

echo "<br><a href='index.html'>back</a>";
echo "</body>";
echo "</html>";


mysqli_close($con);
