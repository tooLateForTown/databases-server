<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comp 353 Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Group Project Test</h1>
<h3><?php echo 'hello world'; ?></h3>

<?php
echo "Attempting to connect to MySql...";
$servername = "ddc353.encs.concordia.ca";
$username = "ddc353_1";
$password = "12pass34";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
</body>
</html>