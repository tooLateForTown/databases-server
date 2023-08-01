<?php require('globals.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comp 353 Project</title>
    <?php commonHead(); ?>
</head>
<body>
<?php commonNav(); ?>
<h1>Students</h1>
<?php
    generateMasterTable("SELECT personID,CONCAT(firstName, ' ' , lastName)  FROM Students NATURAL JOIN Persons","edit_student.php", 0, 1, -1);
?>
</body>
</html>