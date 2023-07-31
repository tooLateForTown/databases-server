<?php require('globals.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comp 353 Project</title>
    <link rel="stylesheet" href="../../style1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<h1>Ministries</h1>
<?php
    generateMasterTable("SELECT ministryID,name FROM Ministries","edit_ministry.php", 0, 1);
?>
</body>
</html>
