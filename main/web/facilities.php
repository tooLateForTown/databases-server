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
<h1>Facilities</h1>
<?php
    $sql="SELECT Facilities.facilityID, Facilities.name, count(Employees.personID)+count(Students.personID) as count FROM Facilities
    LEFT OUTER JOIN  Students ON Facilities.facilityID=Students.facilityID
    LEFT OUTER JOIN Employees ON Facilities.facilityID = Employees.facilityID
    WHERE Students.endDate IS NULL and Employees.endDate IS NULL 
    GROUP BY Facilities.facilityID";
    generateMasterTable($sql,"edit_facility.php", 0,1,2,"ID","Name","Record");
?>
</main>
</body>
</html>