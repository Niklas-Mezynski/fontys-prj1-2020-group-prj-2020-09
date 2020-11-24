<?php 
include_once ("dbconnection.php");
$sql = "select * from album a inner join users u2 on a.artist_id = u2.user_id;";
// Execute a statement
$stmt = $conn->query($sql);
// Iterate the table and echo out the tuples
foreach ($stmt as $row)
{
echo "<h1>" . $row['title'] . "</h1><br />";
echo $row['date'] . "<br />";
echo $row['label'] . "<br />";
echo $row['publisher'] . "<br />";
echo $row['user_name'] . "<br />";
} 
?>