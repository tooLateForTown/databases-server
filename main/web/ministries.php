<?php require('globals.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comp 353 Project</title>
    <?php commonHead(); ?>
</head>
<body>
<?php commonNav(); ?>
<main>
<h1>Ministries</h1>
<?php
    $sql = "SELECT Ministries.ministryID, Ministries.name, count(Facilities.ministryID) as count FROM Ministries LEFT JOIN Facilities ON Facilities.ministryID = Ministries.ministryID GROUP BY Ministries.ministryID";
    generateMasterTable($sql,"edit_ministry.php", 0, 1,-1,"Ministry ID", "Name","", isStudent:false, isEmployee:false);
?>
</main>
</body>
</html>
