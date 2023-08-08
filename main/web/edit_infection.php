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
        $record['infectionTypeID'] = $_POST['infectionTypeID'];

    } // end of ADD or EDIT

    //** PART 2:  Validation */
    if ($action == 'add' || $action=='edit') {
        if ($record['date'] == NULL) {
            show_error("Date must be set");
            exit();
        }
    }


    // ** PART 3: CHECKS PASSED.  COMMIT

    $sql = "to build";
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO Infections (personID, date, infectionTypeID)";
            $sql .= " VALUES(";
            $sql .= $record['personID'] . ",";
            $sql .= "'" . $record['date'] . "',";
            $sql .= $record['infectionTypeID'];
            $sql .= ");";
            break;
        case 'edit':
            $sql = "UPDATE Infections SET ";
            $sql .= "date='" . $_POST['date'] . "',";
            $sql .= "infectionTypeID=" . $record['infectionTypeID'];
            $sql .= " WHERE personID=" . $record['personID'] . " AND date='" . $_POST['originalDate'] . "';";
            break;
        case 'delete':
            $sql = "DELETE FROM Infections WHERE personID=" . $_POST['personID'] . " AND date='" . $_POST['originalDate'] ."';";
            break;
        case 'view':
            break; // nothing to do

    }

    $success = commit($sql, $conn);
    if ($success) {
        if ($action == 'add' || $action == 'edit') {
            triggerAfterTeacherInfection($record['personID'], $record['date']);
        }
        $returnto="";
        if (isset($_POST['returnmode']))
            $returnto="&mode=".$_POST['returnmode'];
//        exit(); // todo REMOVE THIS
        header("Location: edit_person.php?id=".$_POST['personID']."&action=view".$returnto); // jump away.  Cannot have any html before header command.  todo fix this
    }
    // Commit FAILED!
    echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
    echo "<div class='debug'>";
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
$record['date'] = date('Y-m-d'); // current date
$record['infectionTypeID'] = null;
$personname = getPersonName($record['personID'], $conn);


if ($action != 'add') {
    $row = selectSingleTuple("SELECT * FROM Infections WHERE personID=" . $_GET['personID'] . " AND date='".$_GET['date']."'", $conn);
    $record['personID'] = $row['personID'];
    $record['date'] = $row['date'];
    $record['infectionTypeID'] = $row['infectionTypeID'];

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
        echo "<h1>Add Infection</h1>";
    } else {
        echo "<h1>Infection for id= " . $record['personID'] . "</h1>";
    }
    ?>
    <div class="debug">Action is <?php print $_GET['action']; ?></div>


    <form action="edit_infection.php" method="post">
        <table class="table table-bordered table-hover table-sm">

            <tr>
                <td><label for="personname">Person</label></td>
                <td><input type="text" size="40" name="personname" id="personname" disabled value="<?= $personname ?>">
                </td>
            </tr>
            <tr>
                <td><label for="infectionTypeID">Type</label></td>
                <td><select name="infectionTypeID" id="infectionTypeID" <?= $readonly ?> >
                        <?php listInfectionTypeOptions($record['infectionTypeID'], $conn); ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="date">Date</label></td>
                <td><input type="date" name="date" <?= $readonly ?> value="<?= $record['date'] ?? '' ?>">
                </td>
            </tr>
            <input type="hidden" name="commit" value="<?= $action ?>">
            <input type="hidden" name="personID" value="<?= $record['personID'] ?>">
            <input type="hidden" name="originalDate" value="<?= $record['date'] ?>">
            <input type="hidden" name="returnmode" value="<?= $_GET['returnmode'] ?>">

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
