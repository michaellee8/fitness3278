<?php
include("connect.php");

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
echo "</table>";
echo "<br><a href='index.html'>back</a>";
echo "</body>";
echo "</html>";

// last step: free the tuple result and close the MySQL database connection
mysqli_free_result($result_class);
mysqli_close($con);
