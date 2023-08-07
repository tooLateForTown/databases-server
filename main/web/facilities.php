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
    generateMasterTable("SELECT Facilities.facilityID, Facilities.name, count(Employees.personID)+count(Students.personID) as count FROM Facilities, Students, Employees WHERE Students.facilityID=Facilities.facilityID AND Employees.facilityID=Facilities.facilityID AND Students.endDate IS NULL and Employees.endDate IS NULL GROUP BY Facilities.facilityID","edit_facility.php", 0,1,2,"ID","Name","Record",isStudent:false, isEmployee:false);
?>
</main>
</body>
</html>