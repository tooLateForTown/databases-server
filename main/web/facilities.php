<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comp 353 Project</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
<h1>Facilities</h1>
<a href='edit_facility.php?action=create'>Create new Facility</a>
<p>
<?php
echo "<div class='debug'>";
echo "Attempting to connect to MySql...";
$servername = "ddc353.encs.concordia.ca";
$username = "ddc353_1";
$password = "12pass34";
$dbname = "ddc353_1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
echo "</div>";

echo "<h3>Facilities in Database</h3>";
$result= mysqli_query($conn, "SELECT facilityID,name FROM Facilities");
$tables = mysqli_fetch_all($result);
mysqli_free_result($result);
mysqli_close($conn);

?>
<table>
<?php
foreach ($tables as $table) {
    echo "<tr>";
    echo "<td><div class='tablerow'><a href='edit_facility.php?id=" .$table[0]."&action=delete'>".$table[1]."</a></div></td>";
    echo "<td><a href='edit_facility.php?id=".$table[0]."&action=edit'>edit</a></td>";
    echo "<td><a href='edit_facility.php?id=".$table[0]."&action=display'>display</a></td>";
    echo "<td><a href='edit_facility.php?id=".$table[0]."&action=delete'>delete</a></td>";
    echo "</tr>";
}

?>

</table>
</body>
</html>