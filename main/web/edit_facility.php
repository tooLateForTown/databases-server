<?php require('globals.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comp 353 Project</title>
    <?php commonHead(); ?>
</head>
<body>
<?php commonNav(); ?>
<?php
    $table = null;
    $action = null; // view, delete, add, edit, commit


    // ********   HANDLE SUBMIT FORM HERE ***  ******
    if(isset($_POST['db'])) {

        // ** PART 1: LOAD DATA FROM POST
        $record['id'] = $_POST['id'];
        $record['name'] = $_POST['name'];
        $record['address'] = $_POST['address'];
        $record['city'] = $_POST['city'];
        $record['province'] = $_POST['province'];
        $record['isManagementGeneral']  = 0;
        $record['isManagementHeadOffice'] = 0;
        switch ($_POST['management']) {
            case 'headoffice':
                $record['isManagementHeadOffice'] = 1;
                break;
            case 'general':
                $record['isManagementGeneral'] = 1;
                break;
        }
        $isSchoolPrimary = isset($_POST['isSchoolPrimary']) ? 1 : 0;
        $isSchoolMiddle = isset($_POST['isSchoolMiddle']) ? 1 : 0;
        $isSchoolHigh = isset($_POST['isSchoolHigh']) ? 1 : 0;

        // ** PART 2: VALIDATE DATA
        if ($record['isManagementGeneral'] == 1 && $record['isManagementHeadOffice'] == 1) {
            print("<div class='error'>Cannot be both head office and general office</div>");
            exit();
        }

    }

    // *******NOT A SUBMIT, HANDLE EDIT/ADD/VIEW HERE
    if (isset($_GET['action'])) {
        $action = $_GET['action'];
    }
    $valid_actions = array("add","edit","delete","view");
    if (!in_array($action, $valid_actions)) {
        print("<div class='error'>Invalid action.  Must be of type ");
        print_r($valid_actions);
        print("</div");
        exit();
    }
    $readonly = ($action == "view") ? "disabled" : "";


if (isset($_GET['db'])) {
    print ("SUBMIT!");
    exit();
}

// default values for new record
$record['id'] = -1;
$record['name'] = "";
$record['address'] = "";
$record['city'] = "";
$record['province'] = "QC";
$isManagementHeadOffice = 0;
$isManagementGeneral = 0;
$isSchoolPrimary = 0;
$isSchoolMiddle = 0;
$isSchoolHigh = 0;

$row = selectSingleTuple("SELECT * FROM Facilities WHERE facilityID = " . $_GET['id']);
print_r($row);
if ($row != null) {
    $record['id'] = $row['facilityID'];
    $record['name'] = $row['name'];
    $record['address'] = $row['address'];
    $record['city'] = $row['city'];
    $record['province'] = $row['province'];
    $record['isManagementHeadOffice'] = $row['isManagementHeadOffice'];
    $record['isManagementGeneral'] = $row['isManagementGeneral'];
    $record['isSchoolPrimary'] = $row['isSchoolPrimary'];
    $record['isSchoolMiddle'] = $row['isSchoolMiddle'];
    $record['isSchoolHigh'] = $row['isSchoolHigh'];

}

?>


<h1>Facility <?php print $_GET['id']; ?></h1>
<h1>Action is <?php print $_GET['action']; ?></h1>



<form action="edit_facility.php" method="post">
    <table>
        <tr>
            <td><label for="id">ID</label></td>
            <td><input type="number" name="id" value="<?= $record['id'] ?>" disabled></td>
        </tr>
        <tr>
            <td><label for="name">Name</label></td>
            <td><input type="text" name="name" maxlength="100" <?=$readonly ?> value="<?= $record['name'] ?? '' ?>"><td>
        </tr>
        <tr>
            <td><label for="address">Address</label></td>
            <td><input type="text" name="address" maxlength="100" <?=$readonly ?>  value="<?= $record['address'] ?? '' ?>"></td>
        </tr>
        <tr>
            <td><Label for="city">City</Label></td>
            <td><input type="text" name="city" maxlength="100"" <?=$readonly ?> value="<?= $record['city'] ?? '' ?>"></td>
        </tr>
        <tr>
            <td><label for="province">Province</label></td>
            <td><select name="province" id ="province" <?=$readonly ?> >
                <?php listProvinceOptions($record['province']); ?></select></td>
        </tr>
        <tr>
    <tr>
        <td>Management</td>
        <td>
            <input type="radio" name="management" value="Not Management" id="none" <?=$readonly ?> >
            <label for="none">None</label>
            <input type="radio" name="management" value="Head Office" id="head" <?=$readonly ?> >
            <label for="head">Head Office</label>
            <input type="radio" name="management" value="General Office" id="general" <?=$readonly ?> >
            <label for="head">General</label>
        </td>
    </tr>
    <tr>
        <td>School</td>
        <td>
            <input type="checkbox" name="isSchoolPrimary" value="1" <?=$readonly ?>  <?php if ($record['isSchoolPrimary'] == 1) print "checked"; ?>
            <label for="isSchoolPrimary">Primary</label>
            <input type="checkbox" name="isSchoolMiddle" value="1"  <?=$readonly ?> <?php if ($record['isSchoolMiddle'] == 1) print "checked"; ?>
            <label for="isSchoolMiddle">Middle</label>
            <input type="checkbox" name="isSchoolHigh" value="1"  <?=$readonly ?> <?php if ($record['isSchoolHigh'] == 1) print "checked"; ?>
            <label for="isSchoolHigh">High</label>
        </td>
    </tr>

    <input type="hidden" name="db" value="commit">
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
                        default:
                            break;
                    }
                ?>
                </td>
        </tr>

</table>
</form>


</body>
<html>
