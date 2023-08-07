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
<h1>Email Log</h1>
<?php


// Set the timezone
date_default_timezone_set('America/Montreal');

// Check if today is Sunday

    // Connect to the database
    $conn = createConnection();

    // Get the start today and end dates one week from now 
    $startDate = date('Y-m-d');
    $endDate = date('Y-m-d', strtotime('+1 week'));
    

    // Get all employees and their facilities
    $employees = mysqli_query($conn, "
        SELECT 
            Employees.personID, 
            Employees.facilityID, 
            Persons.firstName, 
            Persons.lastName, 
            Persons.email, 
            Facilities.name AS facilityName, 
            Facilities.address AS facilityAddress
        FROM 
            Employees
            JOIN Persons ON Employees.personID = Persons.personID
            JOIN Facilities ON Employees.facilityID = Facilities.facilityID
    ");

    // Loop through all employees
    while ($employee = mysqli_fetch_assoc($employees)) {
        // Get the employee's schedule for the coming week
        $schedule = mysqli_query($conn, "
            SELECT 
                workDate, 
                startTime, 
                endTime
            FROM 
                Schedule
            WHERE 
                personID = {$employee['personID']} AND 
                facilityID = {$employee['facilityID']} AND 
                workDate BETWEEN '$startDate' AND '$endDate'
            ORDER BY 
                workDate ASC,
                startTime ASC
        ");

        // Generate the email subject and body and subject should be only varchar(60)
        $subject = "{$employee['facilityName']} Schedule for Monday $startDate to Sunday $endDate";
        if (strlen($subject) > 60) {
            $subject = substr($subject, 0, 60);
        }
        $body = "Facility: {$employee['facilityName']}\n";
        $body .= "Address: {$employee['facilityAddress']}\n";
        $body .= "Employee: {$employee['firstName']} {$employee['lastName']}\n";
        $body .= "Email: {$employee['email']}\n\n";
        $body .= "Schedule:\n";

        // Loop through all days of the coming week
        for ($date = strtotime($startDate); $date <= strtotime($endDate); $date = strtotime('+1 day', $date)) {
            $dayOfWeek = date('l', $date);
            $body .= "$dayOfWeek: ";

            // Check if the employee has any scheduled shifts on this day
            $hasShifts = false;
            foreach ($schedule as $shift) {
                if (strtotime($shift['workDate']) == $date) {
                    $hasShifts = true;
                    $startTime = date('H:i', strtotime($shift['startTime']));
                    $endTime = date('H:i', strtotime($shift['endTime']));
                    $body .= "$startTime - $endTime, ";
                }
            }

            if ($hasShifts) {
                // Remove the trailing comma and space from the list of shifts
                $body = substr($body, 0, -2);
            } else {
                // If the employee has no scheduled shifts on this day, display "No Assignment"
                $body .= "No Assignment";
            }

            $body .= "\n";
        }

        $body = substr($body, 0, 80);

        
        // Generate the email ID
        $emailID = generateEmailID($conn);
        $sql = "INSERT INTO Emails (emailID, senderID, receiver, emailDate, subject, emailBody)";
        $sql .= " VALUES(";
        $sql .= $emailID . ",";
        $sql .= $employee['facilityID'] . ",";
        $sql .= $employee['personID'] . ",";
        $sql .= "NOW(),";
        $sql .= "'" . mysqli_real_escape_string($conn, $subject) . "',";
        $sql .= "'" . mysqli_real_escape_string($conn, $body) . "'";
        $sql .= ");";        
        $success = mysqli_query($conn, $sql);

        if (!$success) {
        // Commit FAILED!
        echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
        echo "<div class='debug'>";
        print_r($_POST);
        echo "</div>";
    }


    }

    // Close the database connection
    mysqli_close($conn);

    echo "<div class='success'>Emails generated successfully!</div>";

?>


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
JOIN Persons ON Employees.personID = Persons.personID;
ORDER BY Emails.emailDate ASC
";
    generateMasterTableEmail($sql);
?> 
</main>
</body>
</html>