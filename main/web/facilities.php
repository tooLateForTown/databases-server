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
<h1>Facilities</h1>
<?php
    generateMasterTable("SELECT facilityID, name FROM Facilities","edit_facility.php", 0, 1);
?>
</body>
</html>