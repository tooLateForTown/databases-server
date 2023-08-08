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
        $record['startDate'] = $_POST['startDate'];
        $record['facilityID'] = $_POST['facilityID'];
        $record['primaryEmploymentRoleID'] = $_POST['role1'];
        $record['secondaryEmploymentRoleID'] = $_POST['role2'];
        $record['tertiaryEmploymentRoleID'] = $_POST['role3'];
        $record['endDate'] = $_POST['originalEndDate'];
        if ($record['primaryEmploymentRoleID']==-1)
            $record['primaryEmploymentRoleID']=null;
        if ($record['secondaryEmploymentRoleID']==-1)
            $record['secondaryEmploymentRoleID']=null;
        if ($record['tertiaryEmploymentRoleID']==-1)
            $record['tertiaryEmploymentRoleID']=null;
    } // end of ADD or EDIT
    if ($action == 'delete') {
        $record['personID'] = $_POST['personID'];
        $record['startDate'] = $_POST['originalStartDate'];
        $record['facilityID'] = $_POST['originalFacilityID'];
        $record['endDate'] = $_POST['originalEndDate'];
    }

    //** PART 2:  Validation */
    if ($action != 'delete') {
        if ($record['primaryEmploymentRoleID'] == null) {
            show_error("Primary role must be set");
            exit();
        }
        if ($record['secondaryEmploymentRoleID'] == null && $record['tertiaryEmploymentRoleID'] != null) {
            show_error("Secondary role must be set before tertiary role");
            exit();
        }
    }

    if ($action=='add' || $action=='edit') {
        if ($record['startDate'] == null || $record['startDate'] == "") {
            show_error("Start date must be set");
            exit();
        }
    }
//        if ($record['grade'] == null || $record['grade'] == "") {
//            show_error("Grade must be set");
//            exit();
//        }
//    }


    // ** PART 3: CHECKS PASSED.  COMMIT

    $sql = "to build";
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO Employees (personID, facilityID, startDate, primaryEmploymentRoleID, secondaryEmploymentRoleID, tertiaryEmploymentRoleID)"; //don't put enddate. default null
            $sql .= " VALUES(";
            $sql .= $record['personID'] . ",";
            $sql .= $record['facilityID'] .",";
            $sql .= "'" . $record['startDate'] . "',";
            $sql .= nullOrValue($record['primaryEmploymentRoleID']) . ",";
            $sql .= nullOrValue($record['secondaryEmploymentRoleID']) . ",";
            $sql .= nullOrValue($record['tertiaryEmploymentRoleID']);
            $sql .= ");";
            break;
        case 'edit':
            $sql = "UPDATE Employees SET ";
            $sql .= "startDate='" . $record['startDate'] . "',";
            $sql .= "facilityID=" . $record['facilityID'].",";
            $sql .= "primaryEmploymentRoleID=" . nullOrValue($record['primaryEmploymentRoleID']) . ",";
            $sql .= "secondaryEmploymentRoleID=" . nullOrValue($record['secondaryEmploymentRoleID']) . ",";
            $sql .= "tertiaryEmploymentRoleID=" . nullOrValue($record['tertiaryEmploymentRoleID']);
            $sql .= " WHERE personID=" . $record['personID'] . " AND startDate='" . $_POST['originalStartDate'] . "' AND facilityID=". $_POST['originalFacilityID'].";";
            break;
        case 'delete':
            if ($record['endDate']==null) { // Don't delete.  Just set enddate to today
                $sql = "UPDATE Employees SET ";
                $sql .= "endDate=CURDATE()"; // set enddate to today
                $sql .= " WHERE personID=" . $record['personID'] . " AND startDate='" . $_POST['originalStartDate'] . "' AND facilityID=". $_POST['originalFacilityID'].";";
            } else {
                $sql = "DELETE FROM Employees WHERE personID=" . $record['personID'] . " AND startDate='" . $_POST['originalStartDate'] . "' AND facilityID=". $_POST['originalFacilityID'].";";
            }
            break;
        case 'view':
            break; // nothing to do

    }

    $success = commit($sql, $conn);
    if ($success) {
        header("Location: edit_person.php?id=".$record['personID']."&action=view&mode=employee"); // jump away.  Cannot have any html before header command.  todo fix this
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
$record['startDate'] = date('Y-m-d'); // current date
$record['endDate'] = null;
$record['facilityID'] = null;
$record['primaryEmploymentRoleID'] = null;
$record['secondaryEmploymentRoleID'] = null;
$record['tertiaryEmploymentRoleID'] = null;
$personname = getPersonName($record['personID'], $conn);


if ($action != 'add') {
    $row = selectSingleTuple("SELECT * FROM Employees WHERE personID=" . $_GET['personID'] . " AND facilityID=" . $_GET['facilityID'] . " AND startDate='" . $_GET['startDate'] . "'", $conn);
    $record['personID'] = $row['personID'];
    $record['startDate'] = $row['startDate'];
    $record['endDate'] = $row['endDate'];
    $record['facilityID'] = $row['facilityID'];
    $record['primaryEmploymentRoleID'] = $row['primaryEmploymentRoleID'];
    $record['secondaryEmploymentRoleID'] = $row['secondaryEmploymentRoleID'];
    $record['tertiaryEmploymentRoleID'] = $row['tertiaryEmploymentRoleID'];

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
        echo "<h1>Add Employment Record</h1>";
    } else {
        echo "<h1>Employment Record for id= " . $record['personID'] . "</h1>";
    }
    ?>
    <div class="debug">Action is <?php print $_GET['action']; ?></div>


    <form action="edit_employment.php" method="post">
        <table class="table table-bordered table-hover table-sm">

            <tr>
                <td><label for="personname">Person</label></td>
                <td><input type="text" size="40" name="personname" id="personname" disabled value="<?= $personname ?>">
                </td>
            </tr>
            <tr>
                <td><label for="facilityID">Facility</label></td>
                <td><select name="facilityID" id="facilityID" <?= $readonly ?> >
                        <?php listFacilityOptions($record['facilityID'], $conn); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="startDate">Start Date</label></td>
                <td><input type="date" name="startDate" <?= $readonly ?>
                           value="<?= $record['startDate'] ?? '' ?>">
                </td>
            </tr>
            <?php if ($action != 'add') {
                ?>
            <tr>
                <td><label for="endDate">End Date</label></td>
                <td>
                    <?php if ($record['endDate']==null) {
                        echo "Still employed";
                    } else {
                        echo '<input type="date" name="endDate" disabled value="'.$record['endDate'].'">';
                    } ?>
                </td>
            </tr>
            <?php } ?>

            <tr>
                <td><label for="role1">Primary Role</label></td>
                <td><select name="role1" id="role1" <?= $readonly ?> >
                        <?php listEmploymentRoleOptions($record['primaryEmploymentRoleID'], $conn); ?>
                    </select> (required)
                </td>
            </tr>
            <tr>
                <td><label for="role2">Secondary Role</label></td>
                <td><select name="role2" id="role2" <?= $readonly ?> >
                        <?php listEmploymentRoleOptions($record['secondaryEmploymentRoleID'], $conn); ?>
                    </select> (optional)
                </td>
            </tr>
            <tr>
                <td><label for="role3">Tertiary Role</label></td>
                <td><select name="role3" id="role3" <?= $readonly ?> >
                        <?php listEmploymentRoleOptions($record['tertiaryEmploymentRoleID'], $conn); ?>
                    </select> (optional)
                </td>
            </tr>



            <input type="hidden" name="commit" value="<?= $action ?>">
            <input type="hidden" name="personID" value="<?= $record['personID'] ?>">
            <input type="hidden" name="originalStartDate" value="<?= $record['startDate'] ?>">
            <input type="hidden" name="originalFacilityID" value="<?= $record['facilityID'] ?>">
            <input type="hidden" name="originalEndDate" value="<?= $record['endDate'] ?>">
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
                            if ($record['endDate'] == null) {
                                print "<input type='submit' value='END EMPLOYMENT' style='color:red'>";
                            } else {
                                print "<input type='submit' value='EMPLOYMENT ALREADY ENDED. CONFIRM DELETE' style='color:red'>";
                            }
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
