<?php
include("connect.php");

// prepare the database query
// select the branch_ID and name of the branches in the “Tai Po” district.
$query = "
SELECT M.member_ID                                                        as member_ID,
       M.name                                                             as name,
       DATE_FORMAT(FROM_DAYS(DATEDIFF(now(), M.date_of_birth)), '%Y') + 0 as age
FROM Member M
         JOIN Enrollment E on M.member_ID = E.member_ID
         JOIN Class C on E.class_ID = C.class_ID
         JOIN Instructor I on C.instructor_ID = I.instructor_ID
WHERE I.name LIKE 'May Wong'
  AND DATE_FORMAT(FROM_DAYS(DATEDIFF(now(), M.date_of_birth)), '%Y') + 0 < 18
GROUP BY M.member_ID
ORDER BY M.member_ID DESC
";

// execute the query
$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 5</title>";
echo "</head>";
echo "<body  align=center>";
echo "<h3>Q5 Answer</h3>";

// display the table
echo "<table border='1' align='center'>";
echo "<tr>";
echo "<td>member_ID</td>";
echo "<td>name</td>";
echo "<td>age</td>";
echo "</tr>";

// print data with HTML
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<tr>";
    echo "<td>".$row['member_ID']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['age']."</td>";
    echo "</tr>";
}
echo "</table>";
echo "<br><a href='index.html'>back</a>";
echo "</body>";
echo "</html>";

// last step: free the tuple result and close the MySQL database connection
mysqli_free_result($result);
mysqli_close($con);
