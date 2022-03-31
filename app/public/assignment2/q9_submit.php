<?php
include("connect.php");

// prepare the database query
// select the branch_ID and name of the branches in the “Tai Po” district.
$query = "
SELECT B.name, B.branch_ID, COUNT(C.class_ID) as class_num
FROM Branch B
         JOIN Class C on B.branch_ID = C.branch_ID
GROUP BY B.branch_ID
ORDER BY B.branch_ID DESC
";

// execute the query
$result = mysqli_query($con,$query) or die( "Unable to execute query:".mysqli_error($con));

echo "<!DOCTYPE html><html>";
echo "<head>";
echo "<title>Question 9_1</title>";
echo "</head>";
echo "<body  align=center>";
echo "<h3>Q9_1 Answer</h3>";

// display the table
echo "<form action='q9.php' method='post' align='center'>";
echo "<select name='ID'>";

// print data with HTML
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
{
    echo "<option value='".$row["branch_ID"]."'>".$row["name"].": ".$row["class_num"]."</option>";
}
echo "</select>";
echo "<br>";
echo "<br>";
echo "<input type='submit' name='submit' value='submit'>";
echo "</form>";
echo "</body>";
echo "</html>";

// last step: free the tuple result and close the MySQL database connection
mysqli_free_result($result);
mysqli_close($con);
