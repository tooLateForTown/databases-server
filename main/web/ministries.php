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
    $sql = "SELECT Ministries.ministryID, Ministries.name, count(Facilities.ministryID) as count FROM Ministries, Facilities WHERE Ministries.ministryID = Facilities.ministryID GROUP BY Ministries.ministryID";
    generateMasterTable($sql,"edit_ministry.php");
?>
</body>
</html>
