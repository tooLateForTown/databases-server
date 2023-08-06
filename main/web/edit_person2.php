<?php require('globals.php'); ?>
<?php
// PROCESSING SUBMISSION FROM FORM HERE
$conn = createConnection();
$table = null;
$action = null; // view, delete, add, edit, commit
$mode = null; // will be student or employee

// ********   HANDLE SUBMIT FORM HERE ***  ******
if (isset($_POST['commit'])) {
    $mode = $_POST['mode'];
    $action = $_POST['commit'];
    if ($action == 'add' || $action == 'edit') {
        // PART 1 AND 2 ONLY RUN IF ADDING OR EDITING
        // ** PART 1: LOAD DATA FROM POST
        $record['id'] = $_POST['id'];
        $record['ministryID'] = $_POST['ministryID'];
        $record['name'] = trim($_POST['name']);
        $record['address'] = trim($_POST['address']);
        $record['city'] = trim($_POST['city']);
        $record['province'] = $_POST['province'];
        $record['postalcode'] = $_POST['postalcode'];
        $record['phone'] = $_POST['phone'];
        $record['web'] = $_POST['web'];
        $record['capacity'] = $_POST['capacity'];
        $record['isManagementGeneral'] = 0;
        $record['isManagementHeadOffice'] = 0;
        $isManagement = false;
        $isSchool = false;
        if (isset($_POST['management'])) { // will be not sent if no options selected
            switch ($_POST['management']) {
                case 'head':
                    $record['isManagementHeadOffice'] = 1;
                    $isManagement = true;
                    break;
                case 'general':
                    $record['isManagementGeneral'] = 1;
                    $isManagement = true;
                    break;
            }
        }

        $record['isSchoolPrimary'] = isset($_POST['isSchoolPrimary']) ? 1 : 0;
        $record['isSchoolMiddle'] = isset($_POST['isSchoolMiddle']) ? 1 : 0;
        $record['isSchoolHigh'] = isset($_POST['isSchoolHigh']) ? 1 : 0;
        if ($record['isSchoolPrimary'] + $record['isSchoolMiddle'] + $record['isSchoolHigh'] > 0) {
            $isSchool = true;
        }

        // ** PART 2: VALIDATE DATA
        if ($record['isManagementGeneral'] == 1 && $record['isManagementHeadOffice'] == 1) {
            print("<div class='error'>Cannot be both head office and general office</div>");
            exit();
        }
        if ($isManagement && $isSchool) {
            print("<div class='error'>Cannot be both management and school</div>");
            exit();
        }
        if (!$isManagement && !$isSchool) {
            print("<div class='error'>Must be either management or school</div>");
            exit();
        }
        if ($isManagement && $record['isManagementHeadOffice']) { // fixme doesnb't work
            // check if there is already a head office for this ministry
            $check = selectSingleTuple("SELECT * from Facilities WHERE isManagementHeadOffice=1 AND ministryID=" . $record['ministryID'], $conn);
            if ($check != null && $check['facilityID'] != $record['id']) {
                print("<div class='error'>There is already a head office for this ministry</div>");
                exit();
            }

        }
        if ($record['ministryID'] < 0 || $record['ministryID'] == null) {
            print("<div class='error'>Ministry ID must be set</div>");
            exit();
        }
        if ($record['name'] == null || $record['name'] == "") {
            print("<div class='error'>Name must be set</div>");
            exit();
        }
        if ($record['address'] == null || $record['address'] == "") {
            print("<div class='error'>Address must be set</div>");
            exit();
        }
        if ($record['city'] == null || $record['city'] == "") {
            print("<div class='error'>City must be set</div>");
            exit();
        }
        if ($record['capacity'] < 0) {
            print("<div class='error'>Capacity cannot be negative</div>");
            exit();
        }
    } // end of ADD or EDIT

    // ** PART 3: CHECKS PASSED.  COMMIT

    $sql = "to build";
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO Facilities (ministryID, name, address, city, province, postalCode, phoneNumber, web, capacity, isManagementGeneral, isManagementHeadOffice, isSchoolPrimary, isSchoolMiddle, isSchoolHigh)";
            $sql .= " VALUES(";
            $sql .= $record['ministryID'] . ",";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['name']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['address']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['city']) . "',";
            $sql .= "'" . $record['province'] . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['postalcode']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['phone']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['web']) . "',";
            $sql .= $record['capacity'] . ",";
            $sql .= $record['isManagementGeneral'] . ",";
            $sql .= $record['isManagementHeadOffice'] . ",";
            $sql .= $record['isSchoolPrimary'] . ",";
            $sql .= $record['isSchoolMiddle'] . ",";
            $sql .= $record['isSchoolHigh'];
            $sql .= ");";
            break;
        case 'edit':
            $sql = "UPDATE Facilities SET ";
            $sql .= "ministryID=" . $record['ministryID'] . ",";
            $sql .= "name='" . mysqli_real_escape_string($conn, $record['name']) . "',";
            $sql .= "address='" . mysqli_real_escape_string($conn, $record['address']) . "',";
            $sql .= "city='" . mysqli_real_escape_string($conn, $record['city']) . "',";
            $sql .= "province='" . $record['province'] . "',";
            $sql .= "postalCode='" . mysqli_real_escape_string($conn, $record['postalcode']) . "',";
            $sql .= "phoneNumber='" . mysqli_real_escape_string($conn, $record['phone']) . "',";
            $sql .= "web='" . mysqli_real_escape_string($conn, $record['web']) . "',";
            $sql .= "capacity=" . $record['capacity'] . ",";
            $sql .= "isManagementGeneral=" . $record['isManagementGeneral'] . ",";
            $sql .= "isManagementHeadOffice=" . $record['isManagementHeadOffice'] . ",";
            $sql .= "isSchoolPrimary=" . $record['isSchoolPrimary'] . ",";
            $sql .= "isSchoolMiddle=" . $record['isSchoolMiddle'] . ",";
            $sql .= "isSchoolHigh=" . $record['isSchoolHigh'];
            $sql .= " WHERE facilityID=" . $record['id'];
            break;
        case 'delete':
            $sql = "DELETE FROM Facilities WHERE facilityID=" . $_POST['id'];
            break;
        case 'view':
            break; // nothing to do

    }


    $success = commit($sql, $conn);
    if ($success) {
        header("Location: facilities.php"); // jump away.  Cannot have any html before header command.
    }
    // Commit FAILED!
    echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
    echo "<div class='debug'>";
    print_r($_POST);
    echo "</div>";
    exit();
}

// *******NOT A SUBMIT, HANDLE EDIT/ADD/VIEW HERE
$mode = $_GET['mode'];
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
$record['personID'] = -1;
$record['firstName'] = "";
$record['lastName'] = "";
$record['address'] = "";
$record['medicare'] = "";
$record['city'] = "";
$record['province'] = "QC";
$record['facilityID'] = -1;
$record['startDate'] = null;
$record['endDate'] = null;
if ($mode == 'student') {
    $record['isEmployee'] = 0;
    $record['isStudent'] = 1;
} else {
    $record['isEmployee'] = 1;
    $record['isStudent'] = 0;
}

if ($action != 'add') {
    $row = selectSingleTuple("SELECT * FROM Persons WHERE personID = " . $_GET['id']);
    if ($row != null) {
        $record['personID'] = $row['personID'];
        $record['facilityID'] = $row['facilityID'];
        $record['firstName'] = $row['firstName'];
        $record['lastName'] = $row['lastName'];
        $record['address'] = $row['address'];
        $record['city'] = $row['city'];
        $record['province'] = $row['province'];
        $record['medicare'] = $row['medicare'];
        $record['isStudent'] = $row['isStudent'];
        $record['isEmployee'] = $row['isEmployee'];
    }
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

    <?php $modestring = ($mode == "student" ? 'Student' : 'Employee') ?>
    <?php
    if ($action == 'add') {
        echo "<h1>Add $modestring </h1>";
    } else {
        echo "<h1>$modestring " . $record['id'] . "</h1>";
    }
    ?>
    <div class="debug">Action is <?php print $_GET['action']; ?></div>
    <form action="edit_person2.php" method="post">
        <table>
            <tr <?php if ($action == 'add') echo 'style="display:none;' ?>>
                <td><label for="personID">ID</label></td>
                <td><input type="number" name="personID" value="<?= $record['personID'] ?>" readonly></td>

            </tr>
            <tr>
                <td><label for="firstName">First Name</label></td>
                <td><input type="text" name="firstName" maxlength="100" <?= $readonly ?>
                           value="<?= $record['firstName'] ?? '' ?>">
                <td>
            </tr>
            <tr>
                <td><label for="lastName">Last Name</label></td>
                <td><input type="text" name="lastName" maxlength="100" <?= $readonly ?>
                           value="<?= $record['lastName'] ?? '' ?>">
                <td>
            </tr>
            <tr>
                <td><label for="medicare">Medicare</label></td>
                <td><input type="text" name="medicare" maxlength="14" <?= $readonly ?>
                           value="<?= $record['medicare'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td><input type="text" name="address" maxlength="100" <?= $readonly ?>
                           value="<?= $record['address'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td><Label for="city">City</Label></td>
                <td><input type="text" name="city" maxlength="100" <?= $readonly ?>
                           value="<?= $record['city'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td><label for="province">Province</label></td>
                <td><select name="province" id="province" <?= $readonly ?>>
                        <?php listProvinceOptions($record['province']); ?>
                    </select>
                </td>
            </tr>
<!--            --><?php //if ($)
//            <tr>
//                <td><label for="facilityID">Facility</label></td>
//                <td><select name="facilityID" id="facilityID" <?= $readonly ?><!-->-->
<!--                        --><?php //listFacilityOptions($record['facilityID'], $conn); ?>
<!--                    </select>-->
<!--                </td>-->
<!--            </tr>-->
            <tr>
                <td>Is Student</td>
                <td>
                    <input type="radio" name="isStudent" id="studentYes" value="1" <?= $readonly ?> checked>
                    <label for="studentYes">Yes</label>
                    <input type="radio" name="isStudent" id="studentNo" value="0" <?= $readonly ?> >
                    <label for="studentNo">No</label>
                </td>
            </tr>

            <tr>
                <td>Is Employee</td>
                <td>
                    <input type="radio" name="isEmployee"
                           value="1" <?= $readonly ?> <?php if ($record['isEmployee'] == 1) print "checked"; ?>
                    <label for="isEmployee">Yes</label>
                    <input type="radio" name="isEmployee"
                           value="1" <?= $readonly ?> <?php if ($record['isEmployee'] == 0) print "checked"; ?>
                    <label for="isEmployee">No</label>
                </td>
            </tr>

        </table>

        <input type="hidden" name="commit" value="<?= $action ?>">
        <input type="hidden" name="mode" value="<?= $_GET['mode'] ?>">
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
    </form>

    <?php if ($action =='view') {
        generateVaccinationsTable($record['personID']);
    }
    ?>

</main>
</body>
<html>
