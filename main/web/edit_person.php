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
        $record['personID'] = $_POST['personID'];
        $record['firstName'] = $_POST['firstName'];
        $record['lastName'] = trim($_POST['lastName']);
        $record['address'] = trim($_POST['address']);
        $record['city'] = trim($_POST['city']);
        $record['province'] = $_POST['province'];
        $record['citizenship'] = $_POST['citizenship'];
        $record['medicare'] = $_POST['medicare'];
        $record['phoneNumber'] = $_POST['phoneNumber'];
        $record['email'] = $_POST['email'];
        $record['isStudent'] = isset($_POST['isStudent']) ? 1 : 0;
        $record['isEmployee'] = isset($_POST['isEmployee']) ? 1 : 0;
       
        
        


        // write a way to assign new Unique  ID to new record

        





        // ** PART 2: VALIDATE DATA

        if ($record['medicare'] == null) {
                           
            print("<div class='error'> Must have valid Medicare card number.</div>");
            exit();
            
        }

        if ($record['firstName'] == null || $record['lastName'] == "") {
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


    } // end of ADD or EDIT

    // ** PART 3: CHECKS PASSED.  COMMIT

    $sql = "to build";
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO Persons (personID, firstName, lastName, address, city, province, citizenship,medicare, phoneNumber, email, isStudent, isEmployee)";
            $sql .= " VALUES(";
            $sql .= mysqli_real_escape_string($conn, $record['firstName']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['lastName']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['address']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['city']) . "',";
            $sql .= "'" . $record['province'] . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['citizenship']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['medicare']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['phoneNumber']) . "',";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['email']) . "',";
            $sql .= $record['isStudent'] . ",";
            $sql .= $record['isEmployee'];
            $sql .= ");";
            break;
        case 'edit':
            $sql = "UPDATE Persons SET ";
            $sql .= "firstName='" . mysqli_real_escape_string($conn, $record['firstName']) . "',";
            $sql .= "lastName='" . mysqli_real_escape_string($conn, $record['lastName']) . "',";
            $sql .= "address='" . mysqli_real_escape_string($conn, $record['address']) . "',";
            $sql .= "city='" . mysqli_real_escape_string($conn, $record['city']) . "',";
            $sql .= "province='" . $record['province'] . "',";
            $sql .= "phoneNumber='" . mysqli_real_escape_string($conn, $record['phoneNumber']) . "',";
            $sql .= "medicare='" . mysqli_real_escape_string($conn, $record['medicare']) . "',";
            $sql .= "email='" . mysqli_real_escape_string($conn, $record['email']) . "',";
            $sql .= "citizenship='" . mysqli_real_escape_string($conn,$record['citizenship']) . "',";
            $sql .= "isStudent=" . $record['isStudent'] . ",";
            $sql .= "isEmployee=" . $record['isEmployee'];
            $sql .= " WHERE personID=" . $_POST['id'];
            break;
        case 'delete':
            $sql = "DELETE FROM Person WHERE personID=" . $_POST['id'];
            break;
        case 'view':
            break; // nothing to do

    }


    $success = commit($sql, $conn);
    if ($success && $mode == 'student') {
        header("Location: students.php"); // jump away.  Cannot have any html before header command.
    }elseif($success && $mode == 'employee'){
        header("Location: employees.php");
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
$mode = $_GET['mode'];
$record['personID'] = -1;
$record['firstName'] = "";
$record['lastName'] = "";
$record['address'] = "";
$record['medicare'] = "";
$record['city'] = "";
$record['province'] = "QC";
$record['citizenship'] = "Canadian";
$record['phoneNumber'] = "";
$record['email'] = "";
if ($mode == 'student') {
    $record['isStudent'] = 1;
    $record['isEmployee'] = 0;
} else {
    $record['isStudent'] = 0;
    $record['isEmployee'] = 1;
}

if ($action != 'add') {
    $row = selectSingleTuple("SELECT * FROM Persons WHERE personID = " . $_GET['id']);
    if ($row != null) {
        $record['personID'] = $row['personID'];
        $record['firstName'] = $row['firstName'];
        $record['lastName'] = $row['lastName'];
        $record['address'] = $row['address'];
        $record['city'] = $row['city'];
        $record['province'] = $row['province'];
        $record['citizenship'] = $row['citizenship'];
        $record['phoneNumber'] = $row['phoneNumber'];
        $record['email'] = $row['email'];
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

    <?php $modestring = ($_GET['mode'] == "student" ? 'Student' : 'Employee') ?>

    
    <?php
    if ($action == 'add') {
        echo "<h1>Add $modestring </h1>";
        
        
        
    } else {
        echo "<h1>$modestring " . $record['personID'] . "</h1>";
    }
    ?>
    <div class="debug">Action is <?php print $_GET['action']; ?></div>
    <form action="edit_person.php" method="post">
        <table>
            <tr <?php if ($action == 'add') echo 'style="display:none;' ?>>
                <td><label for="personID">ID</label></td>
                <td><input type="number" name="personID" size="4" value="<?= $record['personID'] ?>" readonly></td>

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
            <tr>
                <td><label for="citizenship">Citizenship</label></td>
                <td><select name="citizenship" id="citizenship" <?= $readonly ?>>
                        <?php listCitizenshipOptions($record['citizenship']); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="phoneNumber">Phone Number</label></td>
                <td><input type="text" name="phoneNumber" maxlength="14" size="20" <?= $readonly ?>
                           value="<?= $record['phoneNumber'] ?? '' ?>"></td>
            </tr>
            <tr>
                <td><label for="email">Email</label></td>
                <td><input type="text" name="email" maxlength="200" <?= $readonly ?>
                           value="<?= $record['email'] ?? '' ?>"></td>
            </tr>




            
            <tr>
                <td>Is Student</td>
                <td>
                <input type="radio" name="isStudent"
                           value="1" <?= $readonly ?> <?= ($record['isStudent'] == 1) ? "checked" : "" ?> <?= ($_GET['mode']  == 'student' && $_GET['action'] == 'add') ? 'disabled' : ''?>>
                    <label for="isStudent">Yes</label>
                    <input type="radio" name="isStudent"
                           value="0" <?= $readonly ?> <?= ($record['isStudent'] == 0) ? "checked" : ""?> <?= ($_GET['mode']  == 'student' && $_GET['action'] == 'add') ? 'disabled' : ''?>>
                    <label for="isStudent">No</label>
                </td>
            </tr>
            <tr>
                <td>Is Employee</td>
                <td>
                    <input type="radio" name="isEmployee"
                           value="1" <?= $readonly ?> <?= ($record['isEmployee'] == 1) ? "checked" : "" ?> <?= ($_GET['mode']  == 'employee' && $_GET['action'] == 'add') ? 'disabled' : ''?>>
                    <label for="isEmployee">Yes</label>
                    <input type="radio" name="isEmployee"
                           value="0" <?= $readonly ?> <?= ($record['isEmployee'] == 0) ? "checked": ""?><?= ($_GET['mode']  == 'employee' && $_GET['action'] == 'add') ? 'disabled' : ''?>>
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
        generateVaccinationsTable($record['personID'],$conn, $_GET['mode']);
        generateInfectionTable($record['personID'],$conn, $_GET['mode']);
        if ($_GET['mode'] == "student") {
            generateEnrollmentTable($record['personID'],$conn);
        }

    }
    ?>

</main>
</body>
<html>
