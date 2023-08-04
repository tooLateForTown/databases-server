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
        $record['date'] = $_POST['date'];
        $record['vaccinationTypeID'] = $_POST['vaccinationTypeID'];
        $record['dose'] = $_POST['dose'];

        // ** PART 2: VALIDATE DATA
        if ($record['dose'] == null || $record['dose'] == "") {
            print("<div class='error'>Dose must be set</div>");
            exit();
        }
//        $highestdose = selectSingleTuple("SELECT MAX(dose) as last FROM Vaccines WHERE personID=" . $record['personID'], $conn);
//        if ($highestdose != null) {
//            if ($highestdose['last'] >= $record['dose']) {
//                print("<div class='error'>Dose is less than or equal to highest on record. Highest previous dose is ".$highestdose['last']."</div>");
//                exit();
//            }
//        }


    } // end of ADD or EDIT

    // ** PART 3: CHECKS PASSED.  COMMIT

    $sql = "to build";
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO Vaccines (personID, date, vaccinationTypeID, dose)";
            $sql .= " VALUES(";
            $sql .= $record['personID'] . ",";
            $sql .= "'" . $record['date'] . "',";
            $sql .= $record['vaccinationTypeID'] . ",";
            $sql .= $record['dose'];
            $sql .= ");";
            break;
        case 'edit':
            $sql = "UPDATE Vaccines SET ";
            $sql .= "date='" . $record['date'] . "',";
            $sql .= "vaccinationTypeID=" . $record['vaccinationTypeID'] . ",";
            $sql .= "dose=" . $record['dose'];
            $sql .= " WHERE personID=" . $record['personID'] . " AND date='" . $_POST['originaldate'] . "'";
            break;
        case 'delete':
            $sql = "DELETE FROM Vaccines WHERE personID=" . $_POST['personID'] . " AND date='" . $_POST['originaldate'] . "'";
            break;
        case 'view':
            break; // nothing to do

    }


    $success = commit($sql, $conn);
    if ($success) {
        header("Location: index.php"); // jump away.  Cannot have any html before header command.  todo fix this
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


$highestdose = selectSingleTuple("SELECT MAX(dose) as last FROM Vaccines WHERE personID=" . $_GET['personID'], $conn);
if ($highestdose != null) {
    $nextdose = $highestdose['last'] + 1;
} else {
    $nextdose = 1;
}


// default values for new record
$record['personID'] = $_GET['personID'];
$record['date'] = date('Y-m-d'); // current date
$record['vaccinationTypeID'] = -1;
$record['dose'] = $nextdose;
$personname = getPersonName($record['personID'], $conn);


if ($action != 'add') {
    $row = selectSingleTuple("SELECT * FROM Vaccines WHERE personID=" . $_GET['personID'] . " AND date='" . $_GET['date'] . "'", $conn);
    if ($row != null) {
        $record['personID'] = $row['personID'];
        $record['date'] = $row['date'];
        $record['vaccinationTypeID'] = $row['vaccinationTypeID'];
        $record['dose'] = $row['dose'];
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
        echo "<h1>Add Vaccination</h1>";
    } else {
        echo "<h1>Vaccination for id= " . $record['personID'] . "</h1>";
    }
    ?>
    <div class="debug">Action is <?php print $_GET['action']; ?></div>


    <form action="edit_vaccination.php" method="post">
        <table class="table table-bordered table-hover table-sm">
            <!--            <tr --><?php //if ($action == 'add') echo 'style="display:none;' ?><!-->-->
            <!--                <td><label for="personID">personID</label></td>-->
            <!--                <td><input type="number" name="personID" value="-->
            <?php //= $record['personID'] ?><!--" readonly></td>-->
            <!--            </tr>-->
            <tr>
                <td><label for="personname">Person</label></td>
                <td><input type="text" size="40" name="personname" id="personname" disabled value="<?= $personname ?>">
                </td>
            </tr>
            <tr>
                <td><label for="vaccinationTypeID">Type</label></td>
                <td><select name="vaccinationTypeID" id="vaccinationTypeID" <?= $readonly ?> >
                        <?php listVaccineTypeOptions(1, $conn); ?>
                    </select>
                </td>
            </tr>
            <tr>
            <tr>
                <td><label for="date">Date</label></td>
                <td><input type="date" name="date" <?= $readonly ?>
                           value="<?= $record['date'] ?? '' ?>">
                </td>
            </tr>
            <tr>
                <td><label for="dose">Dose</label></td>
                <td><input type="number" name="dose" min="1" size="5" <?= $readonly ?>
                           value="<?= $record['dose'] ?? '' ?>">
                </td>
            </tr>
            <input type="hidden" name="commit" value="<?= $action ?>">
            <input type="hidden" name="personID" value="<?= $record['personID'] ?>">
            <input type="hidden" name="originaldate" value="<?= $record['date'] ?>">
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
