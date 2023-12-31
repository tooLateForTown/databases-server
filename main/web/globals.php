<?php

    require 'queries.php';
    $servername = "ddc353.encs.concordia.ca";
    $username = "ddc353_1";
    $password = "12pass34";
    $dbname = "ddc353_1";


function commonHead() {
        echo "\t<meta charset='UTF-8'>\r\n";
        echo "\t<meta name='viewport' content='width=device-width, initial-scale=1'>\r\n";
        echo "\t<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>\r\n";
        echo "\t<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>\r\n";
        echo "\t<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>\r\n";
        echo "\t<link rel='stylesheet' href='style2.css'>\r\n";
        echo "\t<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>\r\n";
    }

function commonNav() {

    global $queries;

    echo "<nav class='navbar navbar-inverse'>\r\n";
    echo "\t<div class='container-fluid'>\r\n";
    echo "\t\t<div class='navbar-header'>\r\n";
    echo "\t\t\t<a class='navbar-brand' href='index.php'>EPSTS</a>\r\n";
    echo "\t\t</div>\r\n";
    echo "\t\t<ul class='nav navbar-nav'>\r\n";
    echo "\t\t\t<li class='dropdown'>\r\n";
    echo "\t\t\t\t<a class='dropdown-toggle' data-toggle='dropdown' href='tables.php'>Tables<span class='caret'></span></a>\r\n";
    echo "\t\t\t\t<ul class='dropdown-menu'>\r\n";
    echo "\t\t\t\t\t<li><a href='ministries.php'>Ministries</a></li>\r\n";
    echo "\t\t\t\t\t<li><a href='facilities.php'>Facilities</a></li>\r\n";
    echo "\t\t\t\t\t<li><a href='students.php'>Students</a></li>\r\n";
    echo "\t\t\t\t\t<li><a href='employees.php'>Employees</a></li>\r\n";
    echo "\t\t\t\t</ul>\r\n";
    echo "\t\t\t</li>\r\n"; 
    echo "\t\t\t<li class='dropdown'>\r\n";
    echo "\t\t\t\t<a class='dropdown-toggle' data-toggle='dropdown' href='#'>Emails<span class='caret'></span></a>\r\n";
    echo "\t\t\t\t<ul class='dropdown-menu'>\r\n";
    echo "\t\t\t\t\t<li><a href='emails.php'>Weekly Report</a></li>\r\n";
    echo "\t\t\t\t\t<li><a href='emails_view.php'>Email Log</a></li>\r\n";
    echo "\t\t\t\t</ul>\r\n";
    echo "\t\t\t</li>\r\n";
    echo "\t\t\t<li class='dropdown'>\r\n";
    echo "\t\t\t\t<a class='dropdown-toggle' data-toggle='dropdown' href='queries.php'>Queries<span class='caret'></span></a>\r\n";
    echo "\t\t\t\t<ul class='dropdown-menu'>\r\n";
    echo "\t\t\t\t\t<li><a href='run_query.php'>Generic</a></li>\r\n";

    foreach ($queries as $q) {
        echo "\t\t\t\t\t<li><a href='run_query.php?queryID=".$q->id."'>Query ".$q->id.": " . $q->brief_title."</a></li>\r\n";
    }

    echo "\t\t\t\t</ul>\r\n";
    echo "\t\t\t</li>\r\n";
    echo "\t\t</ul>\r\n";
    echo "\t</div>\r\n";
    echo "</nav>\r\n";
}

function generateMasterTable($selectSQL, $consumer, $col1Index=0, $col2Index=1, $col3Index=2, $col1Name='ID', $col2Name='Name', $col3Name='Medicare',$isStudent=false, $isEmployee=false) {

    $conn = createConnection();

    try {
        $result = mysqli_query($conn, $selectSQL);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    mysqli_close($conn);

    $handle_mode = "";
    if ($isStudent) {
        $handle_mode = "&mode=student";
    }
    if ($isEmployee) {
        $handle_mode = "&mode=employee";
    }


    echo "<a href='" . $consumer . "?id=-1&action=add" . $handle_mode . "'><i class='material-icons'>add_box</i> Add new record</a>";
    echo "<br/><br/>";
    echo "<table class='table table-bordered table-hover table-sm'>";
    echo "<thead>";
    echo "<tr><th>$col1Name</th><th>$col2Name</th>";
    if ($col3Index != -1) {
        echo "<th>$col3Name</th>";
    }
    echo "<th>View</th><th>Edit</th><th>Delete</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($tables as $table) {
        echo "<tr class='tablerow'>";
        echo "<td>" . $table[$col1Index] . "</td>";
        
        echo "<td style='text-align:left'><a href='" . $consumer . "?id=" . $table[$col1Index] . "&action=view" . $handle_mode . "'>" . $table[$col2Index] . "</a></td>";

    
        if ($col3Index != -1) {
            echo "<td>" . $table[$col3Index] . "</td>";
        }
        echo "<td><a href='" . $consumer . "?id=" . $table[$col1Index] . "&action=view" . $handle_mode . "'><i class='material-icons'>visibility</i></a></td>";
        echo "<td><a href='" . $consumer . "?id=" . $table[$col1Index] . "&action=edit" . $handle_mode . "'><i class='material-icons'>edit</i></a></td>";
        echo "<td><a href='" . $consumer . "?id=" . $table[$col1Index] . "&action=delete" . $handle_mode . "'><i class='material-icons'>delete</i></a></td>";
        echo "</tr>\r\n";
    }
    echo "</tbody>";
    echo "</table>";
}

function generateMasterTableEmail($selectSQL){
    

        $conn = createConnection();
    
        try {
            $result = mysqli_query($conn, $selectSQL);
        } catch (mysqli_sql_exception $e) {

            echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
            return;
        }
        $tables = mysqli_fetch_all($result);
        mysqli_free_result($result);
        mysqli_close($conn);

//        echo "<a href='emails.php'>Generate Email</a>";
        echo "<br/><br/>";
        echo "<table class='table table-bordered table-hover table-sm table-email'>";
        echo "<thead>";
        echo "<tr><th>Email ID</th><th>Date</th>";
        echo "<th>Sender</th>";
        echo "<th>Reciever</th><th>Subject</th>";
        echo "<th>Body</th>";
        echo "</thead>";

    
        foreach ($tables as $table) {
            echo "<tr class='tablerow'>";
            echo "<td>" . $table[0] . "</td>";
            echo "<td>" . $table[1] . "</td>";
            echo "<td>" . $table[2] . "</td>";
            echo "<td>" . $table[3] . "</td>";
            echo "<td>" . $table[4] . "</td>";
            echo "<td>" . $table[5] . "</td>";
            
    
    
        
           
            echo "</tr>\r\n";
        }
        echo "</tbody>";
        echo "</table>";
    
    
}


function createConnection() {
    // Create connection
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}

function selectSingleTuple($sql, $conn = null) {
    $closeconn = false;
    if ($conn == null) {
        $conn = createConnection();
        $closeconn=true;
    }

    try {
        $result= mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $row = mysqli_fetch_assoc($result);
//    $rows = mysqli_fetch_all($result);
    mysqli_free_result($result);
    if ($closeconn) {
        mysqli_close($conn);
    }

    if ($row == null) {
        echo "<div class='error'>Query failed to return a single row: " . $sql . "</div>";
        exit();
    } else {
        return $row;
    }
}

function executeQueryAndReturnTable($sql, $conn) {
    $closeconn = false;
    if ($conn == null) {
        $conn = createConnection();
        $closeconn=true;
    }
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    mysqli_free_result($result);
    if ($closeconn) {
        mysqli_close($conn);
    }
    return $rows;
}

//create a function to generate new email ID
function generateEmailID($conn){
    $sql = "SELECT MAX(emailID) AS maxID FROM Emails";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $maxID = $row['maxID'];
    $newID = $maxID + 1;
    return $newID;
}

function sendEmail($senderID, $receiver, $subject, $body, $conn) {
//    print "Sending email from $sender to $receiver with subject $subject and body $body<br>";
//    return;
//    $closeconn = false;
//    if ($conn == null) {
//        $conn = createConnection();
//        $closeconn=true;
//    }
    $sql = "INSERT INTO Emails (senderID, receiver, emailDate, subject, emailBody)";
    $sql .= " VALUES(";
    $sql .= $senderID . ",";
    $sql .= "'".mysqli_real_escape_string($conn,$receiver)."',";
    $sql .= "NOW(),";
    $sql .= "'" . mysqli_real_escape_string($conn, $subject) . "',";
    $sql .= "'" . mysqli_real_escape_string($conn, $body) . "'";
    $sql .= ");";

    $success = mysqli_query($conn, $sql);
    if (!$success) {
        print("Failed to send email: " . $sql);
    }
//
//    if ($closeconn) {
////        mysqli_close($conn);
//    }
}


//create a function to validate time that it's 24 hour format like 1630, 100, 200
function validateTime($time) {
    // Check if the time string is empty
    $time = trim($time);
    if (empty($time)) {
        return false;
    }
    // Check if the time string contains only digits
    if (!ctype_digit($time)) {
        return false;
    }
    // Check if the time string has a length of 3 or 4 characters
    $length = strlen($time);
    if ($length < 1 || $length > 4) {
        return false;
    }
    // Check if the time is within the valid range
    $timeInt = (int)$time;
    if ($timeInt < 0 || $timeInt > 2359) {
        return false;
    }
    // Check if the hours are within the valid range
    $hours = (int)($timeInt / 100);
    if ($hours > 23) {
//        echo("false");
        return false;
    }
    // Check if the minutes are within the valid range
    $minutes = $timeInt % 100;
    if ($minutes > 59) {
        return false;
    }
    // If all checks passed, the time is valid
    return true;
}

function validateNoTimeOverlap($time1Start,$time1End,$time2Start,$time2End) {
    if ($time1Start >= $time2Start && $time1Start <= $time2End)
        return false;
    if ($time1End >= $time2Start && $time1End <= $time2End)
        return false;
    if ($time2Start >= $time1Start && $time2Start <= $time1End)
        return false;
    if ($time2End >= $time1Start && $time2End <= $time1End)
        return false;
    return true;
}

function timeIntToString($time) {
    if ($time == null) {
        return '';
    }
    $time = (int)$time;
    $hours = (int)($time / 100);
    $minutes = $time % 100;
    $hours = str_pad($hours, 2, '0', STR_PAD_LEFT);
    $minutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);
    return $hours . ':' . $minutes;
}

function timeStringToInt($time) {
    if ($time == null) {
        return null;
    }
    $time = str_replace(':', '', $time);
    if (!ctype_digit($time)) {
        return 'Invalid time format';
    }

    return (int)$time;
}


function generateTableFromQuery($sql, $title) {
    //    Example consumer:  'edit_facility.php'
    $conn = createConnection();

    try {
        $result=mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }

    $fields = $result->fetch_fields();
    $cols = $result->field_count;
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    mysqli_close($conn);

    echo "<h1>".$title."</h1>";

    echo "<table class='table table-bordered table-hover table-sm'>";
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<th>".$field->name."</th>";
    }
    echo "</tr>";
    foreach ($tables as $table) {
        echo "<tr class='tablerow'>";
        for ($i = 0; $i < $cols; $i++) {
            if ($fields[$i]->type == 253) {
                echo "<td style='text-align:left'>".$table[$i]."</td>";
            } else {
                echo "<td>".$table[$i]."</td>";
            }

        }
        echo "</tr>\r\n";
    }
    echo "</table>";
}

function listProvinceOptions($selected) {
    echo "<option value='AB' ".($selected=="AB"?"selected='selected'":'').">Alberta</option>\r\n";
    echo "<option value='BC' ".($selected=="BC"?"selected='selected'":'').">British Columbia</option>\r\n";
    echo "<option value='ON' ".($selected=="ON"?"selected='selected'":'').">Ontario</option>\r\n";
    echo "<option value='MB' ".($selected=="MB"?"selected='selected'":'').">Manitoba</option>\r\n";
    echo "<option value='NB' ".($selected=="NB"?"selected='selected'":'').">New Brunswick</option>\r\n";
    echo "<option value='NL' ".($selected=="NL"?"selected='selected'":'').">Newfoundland and Labrador</option>\r\n";
    echo "<option value='NS' ".($selected=="NS"?"selected='selected'":'').">Nova Scotia</option>\r\n";
    echo "<option value='NT' ".($selected=="NT"?"selected='selected'":'').">Northwestern Territories</option>\r\n";
    echo "<option value='NU' ".($selected=="NU"?"selected='selected'":'').">Nunavut</option>\r\n";
    echo "<option value='PE' ".($selected=="PE"?"selected='selected'":'').">Prince Edward Island</option>\r\n";
    echo "<option value='QC' ".($selected=="QC"?"selected='selected'":'').">Quebec</option>\r\n";
    echo "<option value='SK' ".($selected=="SK"?"selected='selected'":'').">Saskatchewan</option>\r\n";
    echo "<option value='YT' ".($selected=="YT"?"selected='selected'":'').">Yukon</option>\r\n";
}



function listCitizenshipOptions($selected){
    echo "<option value='Canadian' ".($selected=="Canadian"?"selected='selected'":'').">Canadian</option>\r\n";
    echo "<option value='American' ".($selected=="American"?"selected='selected'":'').">American</option>\r\n";
    echo "<option value='British' ".($selected=="British"?"selected='selected'":'').">British</option>\r\n";
    echo "<option value='French' ".($selected=="French"?"selected='selected'":'').">French</option>\r\n";
    echo "<option value='German' ".($selected=="German"?"selected='selected'":'').">German</option>\r\n";
    echo "<option value='Italian' ".($selected=="Italian"?"selected='selected'":'').">Italian</option>\r\n";
    echo "<option value='Chinese' ".($selected=="Chinese"?"selected='selected'":'').">Chinese</option>\r\n";
    echo "<option value='Indian' ".($selected=="Indian"?"selected='selected'":'').">Indian</option>\r\n";
    echo "<option value='Japanese' ".($selected=="Japanese"?"selected='selected'":'').">Japanese</option>\r\n";
    echo "<option value='Korean' ".($selected=="Korean"?"selected='selected'":'').">Korean</option>\r\n";
    echo "<option value='Mexican' ".($selected=="Mexican"?"selected='selected'":'').">Mexican</option>\r\n";
    echo "<option value='Russian' ".($selected=="Russian"?"selected='selected'":'').">Russian</option>\r\n";
    echo "<option value='Spanish' ".($selected=="Spanish"?"selected='selected'":'').">Spanish</option>\r\n";
}


function listMinistryOptions($selected, $conn) {
    $sql = "SELECT ministryID,name FROM Ministries";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}

function listFacilityOptions($selected, $conn) {
    $sql = "SELECT FacilityID, name FROM Facilities";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}
function listFacilityWhereWorkingOptions($selected, $conn, $personID) {
    $sql = "SELECT FacilityID, name FROM Facilities NATURAL JOIN Employees WHERE endDate IS NULL AND personID=".$personID;
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}

function listSchoolOptions($selected, $conn) {
    $sql = "SELECT FacilityID, name FROM Facilities WHERE isSchoolHigh=1 OR isSchoolPrimary=1 OR isSchoolMiddle=1";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}
function listPersonOptions($selected, $conn) {
    $sql = "SELECT personID,CONCAT(firstName,' ', lastName) FROM Persons";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}

function listVaccineTypeOptions($selected, $conn) {
    $sql = "SELECT vaccinationTypeID, name FROM VaccinationTypes";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}

function listInfectionTypeOptions($selected, $conn) {
    $sql = "SELECT infectionTypeID, name FROM InfectionTypes";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}
function listEmploymentRoleOptions($selected, $conn) {
    $sql = "SELECT employmentRoleID, title FROM EmploymentRoles";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    echo "<option value='-1' ".($selected==null?"selected='selected'":'').">None</option>\r\n";
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}

function getPersonName($personID, $conn) {
    $sql = "SELECT CONCAT(firstName,' ', lastName) FROM Persons WHERE personID=".$personID;
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    return $rows[0][0];
}

function getFacilityName($facilityID, $conn) {
    $sql = "SELECT name FROM Facilities WHERE facilityID=".$facilityID;
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    return $rows[0][0];
}

function commit($sql, $conn=null) {
    if ($conn == null) {
        $conn = createConnection();
    }

    $result = true;
    try {
        $result=$conn->query($sql);
    } catch (mysqli_sql_exception $e) {
        echo "<HTML><HEAD><link rel='stylesheet' href='style1.css'></HEAD><BODY>";
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        echo "</BODY></HTML>";
        return;
    }
    mysqli_close($conn);
    return $result;
}

function generateVaccinationsTable($personID, $conn=null, $returnmode= null) {
    $closeconn = false;
    if ($conn == null) {
        $conn = createConnection();
        $closeconn=true;
    }
    $sql="SELECT date,VaccinationTypes.name as type, dose FROM Vaccines, VaccinationTypes WHERE Vaccines.vaccinationTypeID=VaccinationTypes.vaccinationTypeID AND personID=$personID ORDER BY date DESC";
    try {
        $result= mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    if ($closeconn) {
        mysqli_close($conn);
    }
    echo "<h3>Vaccinations</h3>";
    echo "<a href='edit_vaccination.php?personID=$personID&action=add".($returnmode != null? "&returnmode=$returnmode" : "")."'><i class='material-icons'>add_box</i>Add Vaccination</a>";
    echo "<br/><br/>";
    echo "<table class='table table-bordered table-hover table-sm'>";
    echo "<thead>";
    echo "<tr><th>Date</th><th>Type</th><th>Dose</th>";
    echo "<th>Edit</th><th>Delete</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($tables as $table) {
        echo "<tr class='tablerow'>";
        echo "<td>".$table[0]."</td>";
        echo "<td>".$table[1]."</td>";
        echo "<td>".$table[2]."</td>";
        echo "<td><a href='edit_vaccination.php?personID=$personID&date=".$table[0]."&action=edit".($returnmode != null? "&returnmode=$returnmode" : "")."'><i class='material-icons'>edit</i></a></td>";
        echo "<td><a href='edit_vaccination.php?personID=$personID&date=".$table[0]."&action=delete".($returnmode != null? "&returnmode=$returnmode" : "")."'><i class='material-icons'>delete</i></a></td>";
        echo "</tr>\r\n";
    }
    echo "</tbody>";
    echo "</table>";
}

function show_error($msg)
{
    echo "<HTML><HEAD>";
    commonHead();
    echo "</HEAD><BODY>";
    commonNav();
    echo "<div class='error'>$msg</div>";
    echo "</BODY></HTML>";
}

function generateEnrollmentTable($personID, $conn=null) {
    $closeconn = false;
    if ($conn == null) {
        $conn = createConnection();
        $closeconn=true;
    }
    $sql = "SELECT * FROM Students WHERE personID=$personID ORDER BY startDate DESC";
    try {
        $result= mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    if ($closeconn) {
        mysqli_close($conn);
    }
    echo "<h3>Enrollment</h3>";
    echo "<a href='edit_enrollment.php?personID=$personID&action=add'><i class='material-icons'>add_box</i> Add Enrollment</a>";
    echo "<br/><br/>";
    echo "<table class='table table-bordered table-hover table-sm'>";
    echo "<thead>";
    echo "<tr><th>startDate</th><th>endDate</th><th>School</th><th>Grade</th>";
    echo "<th>Edit</th><th>Delete</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($tables as $table) {
        $facilityID = $table[1];
        $startDate= $table[2];
        $endDate = $table[3];
        $grade = $table[4];
        $facilityName = getFacilityName($facilityID, $conn);
        echo "<tr class='tablerow'>";
        echo "<td>".$startDate."</td>";
        echo "<td>".$endDate."</td>";
        echo "<td>".$facilityName."</td>";
        echo "<td>".$grade."</td>";
        echo "<td><a href=\"edit_enrollment.php?personID=$personID&startDate=".$startDate."&facilityID=$facilityID&action=edit\"><i class='material-icons'>edit</i></a></td>";
        echo "<td><a href=\"edit_enrollment.php?personID=$personID&startDate=".$startDate."&facilityID=$facilityID&action=delete\"><i class='material-icons'>delete</i></a></td>";
        echo "</tr>\r\n";
    }
    echo "</tbody>";
    echo "</table>";
}

function generateInfectionTable($personID, $conn=null, $returnmode= null) {
    $closeconn = false;
    if ($conn == null) {
        $conn = createConnection();
        $closeconn=true;
    }
    $sql = "SELECT personID, date, InfectionTypes.name as type FROM Infections 
            JOIN InfectionTypes ON Infections.infectionTypeID = InfectionTypes.infectionTypeID
            WHERE personID=$personID ORDER BY date DESC";
    try {
        $result= mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    if ($closeconn) {
        mysqli_close($conn);
    }
    echo "<h3>Infections</h3>";
    echo "<a href='edit_infection.php?personID=$personID&action=add".($returnmode != null? "&returnmode=$returnmode" : "")."'><i class='material-icons'>add_box</i>Add Infection</a>";
    echo "<br/><br/>";
    echo "<table class='table table-bordered table-hover table-sm'>";
    echo "<thead>";
    echo "<tr><th>date</th><th>Type</th>";
    echo "<th>Edit</th><th>Delete</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($tables as $table) {
        $date= $table[1];
        $type= $table[2];
        echo "<tr class='tablerow'>";
        echo "<td>".$date."</td>";
        echo "<td>".$type."</td>";
        echo "<td><a href=\"edit_infection.php?personID=$personID&date=".$date."&action=edit".($returnmode != null? "&returnmode=$returnmode" : "")."\"><i class='material-icons'>edit</i></a></td>";
        echo "<td><a href=\"edit_infection.php?personID=$personID&date=".$date."&action=delete".($returnmode != null? "&returnmode=$returnmode" : "")."\"><i class='material-icons'>delete</i></a></td>";
        echo "</tr>\r\n";
    }
    echo "</tbody>";
    echo "</table>";
}

function generateScheduleTable($personID, $conn=null) {
    $closeconn = false;
    if ($conn == null) {
        $conn = createConnection();
        $closeconn=true;
    }
    $sql = "SELECT workDate, facilityID, startTime, endTime, name  FROM Schedule NATURAL JOIN Facilities WHERE personID=$personID ORDER BY workDate DESC, startTime";
    try {
        $result= mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    if ($closeconn) {
        mysqli_close($conn);
    }
    echo "<h3>Schedule</h3>";
    echo "<a href='edit_schedule.php?personID=$personID&action=add'><i class='material-icons'>add_box</i>Add Schedule</a>";
    echo "<br/><br/>";
    echo "<table class='table table-bordered table-hover table-sm'>";
    echo "<thead>";
    echo "<tr><th>Facility</th><th>workDate</th><th>startTime</th><th>endTime</th>";
    echo "<th>Edit</th><th>Delete</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($tables as $table) {
        $workDate=$table[0];
        $facilityID = $table[1];
        $startTime= $table[2];
        $endTime = $table[3];
        $facilityName = $table[4];
        echo "<tr class='tablerow'>";
        echo "<td>".$facilityName."</td>";
        echo "<td>".$workDate."</td>";
        echo "<td>".timeIntToString($startTime)."</td>";
        echo "<td>".timeIntToString($endTime)."</td>";
        echo "<td><a href=\"edit_schedule.php?personID=$personID&workDate=".$workDate."&facilityID=$facilityID&startTime=$startTime&action=edit\"><i class='material-icons'>edit</i></a></td>";
        echo "<td><a href=\"edit_schedule.php?personID=$personID&workDate=".$workDate."&facilityID=$facilityID&startTime=$startTime&action=delete\"><i class='material-icons'>delete</i></a></td>";
        echo "</tr>\r\n";
    }
    echo "</tbody>";
    echo "</table>";
}

function generateEmploymentTable($personID, $conn=null) {
    $closeconn = false;
    if ($conn == null) {
        $conn = createConnection();
        $closeconn=true;
    }
    $sql = "SELECT facilityID, startDate, endDate,name,primaryEmploymentRoleID, secondaryEmploymentRoleID, tertiaryEmploymentRoleID  FROM Employees NATURAL JOIN Facilities WHERE personID=$personID ORDER BY startDate DESC";
    try {
        $result= mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);

    // Load Employment Roles
    $sql = "SELECT * FROM EmploymentRoles";
    $result= mysqli_query($conn, $sql);
    $roles = mysqli_fetch_all($result);
    mysqli_free_result($result);

    if ($closeconn) {
        mysqli_close($conn);
    }



    echo "<h3>Employed At</h3>";
    echo "<a href='edit_employment.php?personID=$personID&action=add'><i class='material-icons'>add_box</i>Add Employment record</a>";
    echo "<br/><br/>";
    echo "<table class='table table-bordered table-hover table-sm'>";
    echo "<thead>";
    echo "<tr><th>Facility</th><th>startDate</th><th>endDate</th><th>Roles</th>";
    echo "<th>Edit</th><th>Delete</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($tables as $table) {
        $facilityID = $table[0];
        $startDate=$table[1];
        $endDate = $table[2];
        $facilityName = $table[3];
        $role1 = $table[4];
        $role2 = $table[5];
        $role3 = $table[6];

        $roletotal = "";
        foreach ($roles as $role)
            if ($role[0]==$role1)
                $roletotal = $roletotal . $role[1] . ", ";
        foreach ($roles as $role)
            if ($role[0]==$role2)
                $roletotal = $roletotal . $role[1] . ", ";
        foreach ($roles as $role)
            if ($role[0]==$role3)
                $roletotal = $roletotal . $role[1] . ", ";

        echo "<tr class='tablerow'>";
        echo "<td>".$facilityName."</td>";
        echo "<td>".$startDate."</td>";
        echo "<td>".$endDate."</td>";
        echo "<td>".$roletotal."</td>";
        echo "<td><a href=\"edit_employment.php?personID=$personID&startDate=".$startDate."&facilityID=$facilityID&action=edit\"><i class='material-icons'>edit</i></a></td>";
        echo "<td><a href=\"edit_employment.php?personID=$personID&startDate=".$startDate."&facilityID=$facilityID&action=delete\"><i class='material-icons'>delete</i></a></td>";
        echo "</tr>\r\n";
    }
    echo "</tbody>";
    echo "</table>";
}

function nullOrValue($val) {
    if ($val == null)
        return "NULL";
    else
        return $val;
}

function triggerAfterTeacherInfection($personID, $date,$conn=null) {
    $closeconn = false;
    if ($conn == null) {
        $conn = createConnection();
        $closeconn=true;
    }
    $infected_name=getPersonName($personID,$conn);
    //we've been alerted that a person has an infection
    //we need to check if that person works in a school
    $sql = "SELECT facilityID FROM Employees NATURAL JOIN Facilities
    WHERE personID=$personID AND startDate <= '$date' AND endDate IS NULL
        AND (isSchoolPrimary = 1 OR isSchoolMiddle = 1 OR isSchoolHigh = 1)";
    $result = mysqli_query($conn, $sql);
    $schools = mysqli_fetch_all($result);
    mysqli_free_result($result);
    foreach($schools as $school) {
        //get the principal of the school
        $sql ="SELECT personID, firstName, lastName, email FROM Employees NATURAL JOIN Persons
                WHERE facilityID=".$school[0]." AND startDate <= '$date' AND endDate IS NULL AND primaryEmploymentRoleID=10";
        $result = mysqli_query($conn, $sql);
        $principal = mysqli_fetch_assoc($result);
        $principalName = $principal['firstName'] . " " . $principal['lastName'];
        sendEmail($school[0],$principalName,'Warning',$infected_name. ' who works at your school has been infected with COVID-19 on ' .$date, $conn);
    }
    // Now we cancel their schedules for two seeks from the date of infection
    $sql = "DELETE FROM Schedule WHERE personID=$personID AND workDate >= '$date' AND workDate <= DATE_ADD('$date', INTERVAL 14 DAY)";
    mysqli_query($conn, $sql);

    if ($closeconn) {
        mysqli_close($conn);
    }
}
?>