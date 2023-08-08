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
            show_error("Cannot be both head office and general office");
            exit();

        }
        if ($isManagement && $isSchool) {
            show_error("Cannot be both management and school");
            exit();
        }
        if (!$isManagement && !$isSchool) {
            show_error("Must be either management or school");
            exit();
        }
        if ($isManagement && $record['isManagementHeadOffice']) { // fixme doesnb't work
            // check if there is already a head office for this ministry
            $check = selectSingleTuple("SELECT * from Facilities WHERE isManagementHeadOffice=1 AND ministryID=" . $record['ministryID'], $conn);
            if ($check != null && $check['facilityID'] != $record['id']) {
                show_error("There is already a head office for this ministry");
                exit();
            }

        }
        if ($record['ministryID'] < 0 || $record['ministryID'] == null) {
            show_error("Ministry ID must be set");
            exit();
        }
        if ($record['name'] == null || $record['name'] == "") {
            show_error("Name must be set");
            exit();
        }
        if ($record['address'] == null || $record['address'] == "") {
            show_error("Address must be set");
            exit();
        }
        if ($record['city'] == null || $record['city'] == "") {
            show_error("City must be set");
            exit();
        }
        if  ($record['capacity'] < 0) {
            show_error("Capacity cannot be negative");
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
            $sql .= $record['capacity'].",";
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
$record['id'] = -1;
$record['ministryID'] = -1;
$record['name'] = "";
$record['address'] = "";
$record['city'] = "";
$record['province'] = "QC";
$record['postalcode'] = "";
$record['phone'] = "";
$record['web'] = "";
$record['capacity'] = 0;
$record['isManagementHeadOffice'] = 0;
$record['isManagementGeneral'] = 0;
$record['isSchoolPrimary'] = 0;
$record['isSchoolMiddle'] = 0;
$record['isSchoolHigh'] = 0;

if ($action != 'add') {
    $row = selectSingleTuple("SELECT * FROM Facilities WHERE facilityID = " . $_GET['id']);
    if ($row != null) {
        $record['id'] = $row['facilityID'];
        $record['ministryID'] = $row['ministryID'];
        $record['name'] = $row['name'];
        $record['address'] = $row['address'];
        $record['city'] = $row['city'];
        $record['province'] = $row['province'];
        $record['phone'] = $row['phoneNumber'];
        $record['web'] = $row['web'];
        $record['postalcode'] = $row['postalCode'];
        $record['capacity'] = $row['capacity'];
        $record['isManagementHeadOffice'] = $row['isManagementHeadOffice'];
        $record['isManagementGeneral'] = $row['isManagementGeneral'];
        $record['isSchoolPrimary'] = $row['isSchoolPrimary'];
        $record['isSchoolMiddle'] = $row['isSchoolMiddle'];
        $record['isSchoolHigh'] = $row['isSchoolHigh'];
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


    <?php
    if ($action == 'add') {
        echo "<h1>Add Facility</h1>";
    } else {
        echo "<h1>Facility " . $record['id'] . "</h1>";
    }
    ?>
    <div class="debug">Action is <?php print $_GET['action']; ?></div>


    <form action="edit_facility.php" method="post">
        <table class="table table-bordered table-hover table-sm">
            <tr <?php if ($action == 'add') echo 'style="display:none;' ?>>
                <td><label for="id">ID</label></td>
                <td><input type="number" name="id" size="4" value="<?= $record['id'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="ministryID">Ministry</label></td>
                <td><select name="ministryID" id="ministryID" <?= $readonly ?>>
                        <?php listMinistryOptions($record['ministryID'], $conn); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="name">Name</label></td>
                <td><input type="text" name="name" maxlength="100" size="40" <?= $readonly ?>
                           value="<?= $record['name'] ?? '' ?>">
                </td>
            </tr>
            <tr>
                <td><label for="address">Address</label></td>
                <td><input type="text" name="address" maxlength="100" size="40" <?= $readonly ?>
                           value="<?= $record['address'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td><Label for="city">City</Label></td>
                <td><input type="text" name="city" maxlength="100" size="40" <?= $readonly ?> value="<?= $record['city'] ?? '' ?>
                    ">
                </td>
            </tr>
            <tr>
                <td><label for="province">Province</label></td>
                <td><select name="province" id="province" <?= $readonly ?> >
                        <?php listProvinceOptions($record['province']); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><Label for="postalcode">Postal Code</Label></td>
                <td>
                    <input type="text" name="postalcode" maxlength="7" size="20" <?= $readonly ?> value="<?= $record['postalcode'] ?? '' ?>">
                </td>
            </tr>
            <tr>
                <td><Label for="phone">Phone</Label></td>
                <td>
                    <input type="text" name="phone" maxlength="14" size="20" <?= $readonly ?> value="<?= $record['phone'] ?? '' ?>">
                </td>
            </tr>
            <tr>
                <td><Label for="web">Website</Label></td>
                <td>
                    <input type="text" name="web" maxlength="200" size="60" <?= $readonly ?> value="<?= $record['web'] ?? '' ?>">
                </td>
            </tr>
            <tr>
                <td><Label for="capacity">Capacity</Label></td>
                <td>
                    <input type="number" name="capacity" min="0" size="10" <?= $readonly ?> value="<?= $record['capacity'] ?? '' ?>">
                </td>
            </tr>

            <tr>
                <td>Management</td>
                <td>
                    <input type="radio" name="management" value="none"
                           id="none" <?= $readonly ?> <?= ($record['isManagementGeneral'] == 0 && $record['isManagementHeadOffice'] == 0) ? "checked" : "" ?>>
                    <label for="none">None</label>
                    <input type="radio" name="management" value="head"
                           id="head" <?= $readonly ?> <?= $record['isManagementHeadOffice'] == 1 ? "checked" : "" ?>>
                    <label for="head">Head Office</label>
                    <input type="radio" name="management" value="general"
                           id="general" <?= $readonly ?> <?= $readonly ?> <?= $record['isManagementGeneral'] == 1 ? "checked" : "" ?>>
                    <label for="general">General</label>
                </td>
            </tr>
            <tr>
                <td>School</td>
                <td>
                    <input type="checkbox" name="isSchoolPrimary"
                           value="1" <?= $readonly ?>  <?php if ($record['isSchoolPrimary'] == 1) print "checked"; ?>
                    <label for="isSchoolPrimary">Primary</label>
                    <input type="checkbox" name="isSchoolMiddle"
                           value="1" <?= $readonly ?> <?php if ($record['isSchoolMiddle'] == 1) print "checked"; ?>
                    <label for="isSchoolMiddle">Middle</label>
                    <input type="checkbox" name="isSchoolHigh"
                           value="1" <?= $readonly ?> <?php if ($record['isSchoolHigh'] == 1) print "checked"; ?>
                    <label for="isSchoolHigh">High</label>
                </td>
            </tr>

            <input type="hidden" name="commit" value="<?= $action ?>">
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
