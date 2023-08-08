<?php require('globals.php'); ?>
<?php
// PROCESSING SUBMISSION FROM FORM HERE
$conn = createConnection();
$table = null;
$action = null; // view, delete, add, edit, commit

// ********   HANDLE SUBMIT FORM HERE ***  ******
if (isset($_POST['commit'])) {
    $action = $_POST['commit'];
    if ($action == 'add' || $action == 'edit') {
        // PART 1 AND 2 ONLY RUN IF ADDING OR EDITING
        // ** PART 1: LOAD DATA FROM POST
        $record['personID'] = $_POST['personID'];
        $record['workDate'] = $_POST['workDate'];
        $record['facilityID'] = $_POST['facilityID'];
        $record['startTime'] = timeStringToInt($_POST['startTime']);
        $record['endTime'] = timeStringToInt($_POST['endTime']);
    } // end of ADD or EDIT
//    if ($action == 'delete') {
//        $record['personID'] = $_POST['personID'];
//        $record['sDate'] = $_POST['originalStartDate'];
//        $record['facilityID'] = $_POST['originalFacilityID'];
//        $record['endDate'] = $_POST['originalEndDate'];
//    }

//    ** PART 2:  Validation */
    if ($action=='add' || $action =='edit' ) {
        if (validateTime($record['startTime']) == false) {
            show_error("Start time invalid.  Must be between 00:00 and 23:59");
            exit();
        }
        if (validateTime($record['endTime']) == false) {
            show_error("End time invalid.  Must be between 00:00 and 23:59");
            exit();
        }
        if ($record['startTime'] >= $record['endTime']) {
            show_error("Start time must be before end time");
            exit();
        }

        //todo validate no conflict with any other schedules

    }

//    if ($action != 'delete') {
//        if ($record['primaryEmploymentRoleID'] == null) {
//            show_error("Primary role must be set");
//            exit();
//        }
//        if ($record['secondaryEmploymentRoleID'] == null && $record['tertiaryEmploymentRoleID'] != null) {
//            show_error("Secondary role must be set before tertiary role");
//            exit();
//        }
//    }
//
//    if ($action=='add' || $action=='edit') {
//        if ($record['startDate'] == null || $record['startDate'] == "") {
//            show_error("Start date must be set");
//            exit();
//        }
//    }



    // ** PART 3: CHECKS PASSED.  COMMIT

    $sql = "to build";
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO Schedule (workDate, startTime, endTime, personID, facilityID)";
            $sql .= " VALUES(";
            $sql .= "'" . $record['workDate'] . "',";
            $sql .= $record['startTime'] . ",";
            $sql .= $record['endTime'] . ",";
            $sql .= $record['personID'] . ",";
            $sql .= $record['facilityID'];
            $sql .= ");";
            break;
        case 'edit':
            $sql = "UPDATE Schedule SET ";
            $sql .= "workDate='" . $record['workDate'] . "',";
            $sql .= "facilityID=" . $record['facilityID'].",";
            $sql .= "startTime=" . $record['startTime'].",";
            $sql .= "endTime=" . $record['endTime'];
            $sql .= " WHERE personID=" . $record['personID'] . " AND workDate='" . $_POST['originalWorkDate'] . "' AND facilityID=". $_POST['originalFacilityID']." AND startTime=".$_POST['originalStartTime'].";";
            break;
        case 'delete':
            $sql = "DELETE FROM Schedule WHERE personID=" . $_POST['personID'] . " AND workDate='" . $_POST['originalWorkDate'] . "' AND facilityID=". $_POST['originalFacilityID']." AND startTime=".$_POST['originalStartTime'].";";
            break;
        case 'view':
            break; // nothing to do

    }

    $success = commit($sql, $conn);
    if ($success) {
        header("Location: edit_person.php?id=".$_POST['personID']."&action=view&mode=employee"); // jump away.  Cannot have any html before header command.
    }
    // Commit FAILED!
    echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
    echo "<div class='debug'>";
    print_r($_POST);
    echo "</div>";
    exit();
}

// *******NOT A SUBMIT, HANDLE EDIT/ADD/VIEW HERE
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}
$valid_actions = array("add", "edit", "delete", "view");
if (!in_array($action, $valid_actions)) {
    print("<div class='error'>Invalid action.  Must be of type ");
    print_r($valid_actions);
    print("</div");
    exit();
}
if ($action == "view" || $action == "delete") {
    $readonly = "disabled";
} else {
    $readonly = '';
}


// default values for new record
$record['personID'] = $_GET['personID'];
$record['workDate'] = date('Y-m-d'); // current date
$record['facilityID'] = null;
$record['startTime']=900;
$record['endTime']=1700;
$personname = getPersonName($record['personID'], $conn);


if ($action != 'add') {
    $row = selectSingleTuple("SELECT * FROM Schedule WHERE personID=" . $_GET['personID'] . " AND facilityID=" . $_GET['facilityID'] . " AND workDate='" . $_GET['workDate'] . "' AND startTime=".$_GET['startTime'].";", $conn);
    $record['personID'] = $row['personID'];
    $record['workDate'] = $row['workDate'];
    $record['facilityID'] = $row['facilityID'];
    $record['startTime'] = $row['startTime'];
    $record['endTime'] = $row['endTime'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comp 353 Project</title>
    <?php commonHead(); ?>
</head>
<body>
<main>
    <?php commonNav(); ?>


    <?php
    if ($action == 'add') {
        echo "<h1>Add Schedule</h1>";
    } else {
        echo "<h1>Employment Scedule for id= " . $record['personID'] . "</h1>";
    }
    ?>
    <div class="debug">Action is <?php print $_GET['action']; ?></div>


    <form action="edit_schedule.php" method="post">
        <table class="table table-bordered table-hover table-sm">

            <tr>
                <td><label for="personname">Person</label></td>
                <td><input type="text" size="40" name="personname" id="personname" disabled value="<?= $personname ?>">
                </td>
            </tr>
            <tr>
                <td><label for="facilityID">Facility</label></td>
                <td><select name="facilityID" id="facilityID" <?= $readonly ?> >
                        <?php listFacilityWhereWorkingOptions($record['facilityID'], $conn,$_GET['personID']); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="workDate">Date</label></td>
                <td><input type="date" name="workDate" <?= $readonly ?>
                           value="<?= $record['workDate'] ?? '' ?>">
                </td>
            </tr>

            <tr>
                <td><label for="startTime">Start Time</label></td>
                <td><input type="text" name="startTime" minlength="5" maxlength="5" <?= $readonly ?> value="<?= timeIntToString($record['startTime']) ?? '' ?>"> HH:MM</td>
            </tr>
            <tr>
                <td><label for="endTime">End Time</label></td>
                <td><input type="text" name="endTime" minlength="5" maxlength="5" <?= $readonly ?> value="<?= timeIntToString($record['endTime']) ?? '' ?>"> HH:MM</td>
            </tr>



            <input type="hidden" name="commit" value="<?= $action ?>">
            <input type="hidden" name="personID" value="<?= $record['personID'] ?>">
            <input type="hidden" name="originalFacilityID" value="<?= $record['facilityID'] ?>">
            <input type="hidden" name="originalWorkDate" value="<?= $record['workDate'] ?>">
            <input type="hidden" name="originalStartTime" value="<?= $record['startTime'] ?>">
            <tr>
                <td></td>

                <td>
                    <?php
                    switch ($action) {
                        case "add":
                            print "<input type='submit' value='Create'>";
                            break;
                        case "edit":
                            print "<input type='submit' value='Update'>";
                            break;
                        case "delete":

                            print "<input type='submit' value='CONFIRM DELETE' style='color:red'>";
                            break;
                        default:
                            break;
                    }
                    ?>
                </td>
            </tr>

        </table>
    </form>

</main>
</body>
<html>
