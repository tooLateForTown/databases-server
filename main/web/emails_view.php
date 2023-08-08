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
<h1>Emails</h1>
<?php
$sql = "SELECT 
Emails.emailID,
Emails.emailDate,
Facilities.name AS sender,
CONCAT(Persons.firstName, ' ', Persons.lastName) AS receiver,
Emails.subject,
LEFT(Emails.emailBody, 80) AS emailBody
FROM 
Emails
JOIN Facilities ON Emails.senderID = Facilities.facilityID
JOIN Employees ON Emails.receiver = Employees.personID
JOIN Persons ON Employees.personID = Persons.personID
ORDER BY Emails.emailDate ASC;
";
    generateMasterTableEmail($sql);
?> ?>
</main>
</body>
</html>