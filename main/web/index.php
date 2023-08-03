<?php require('globals.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--    <meta charset="UTF-8">-->
<!--    <title>Comp 353 Project</title>-->
<!--    <link rel="stylesheet" href="style1.css">-->
    <?php commonHead(); ?>
</head>
<body>
<?php commonNav(); ?>
<main>
<h1>Group Project Test</h1>

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

echo "<h3>Tables in database</h3>";
$result= mysqli_query($conn, "SHOW TABLES FROM $dbname");
$tables = mysqli_fetch_all($result);
mysqli_free_result($result);
mysqli_close($conn);

//foreach ($tables as $table) {
//    echo "<div class='tablerow'>" .$table[0]."</div>\n";
//}


?>
<h3><a href="ministries.php">Ministries</a></h3>
<h3><a href="facilities.php">Facilities</a></h3>
<h3><a href="students.php">Students</a></h3>
</main>
</body>
</html>