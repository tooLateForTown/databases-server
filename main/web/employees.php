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
<h1>Employees</h1>
<?php
    generateMasterTable("SELECT personID,CONCAT(firstName, ' ' , lastName), medicare  FROM Employees  NATURAL JOIN Persons","edit_person.php?mode=employee", 0, 1, 2);
?>
</main>
</body>
</html>