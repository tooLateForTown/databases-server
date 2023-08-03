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
        $record['name'] = trim($_POST['name']);

        // ** PART 2: VALIDATE DATA

        if ($record['name'] == null || $record['name'] == "") {
            print("<div class='error'>Name must be set</div>");
            exit();
        }

    } // end of ADD or EDIT

    // ** PART 3: CHECKS PASSED.  COMMIT

    $sql = "to build";
    switch ($action) {
        case 'add':
            $sql = "INSERT INTO Ministries (name)";
            $sql .= " VALUES(";
            $sql .= "'" . mysqli_real_escape_string($conn, $record['name']). "'";
            $sql .= ");";
            break;
        case 'edit':
            $sql = "UPDATE Ministries SET ";
            $sql .= "name='" . mysqli_real_escape_string($conn, $record['name']) . "'";
            $sql .= " WHERE ministryID=" . $record['id'];
            break;
        case 'delete':
            $sql = "DELETE FROM Ministries WHERE ministryID=" . $_POST['id'];
            break;
        case 'view':
            break; // nothing to do

    }


    $success = commit($sql, $conn);
    if ($success) {
        header("Location: ministries.php"); // jump away.  Cannot have any html before header command.
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
$record['name'] = "";


if ($action != 'add') {
    $row = selectSingleTuple("SELECT * FROM Ministries WHERE ministryID= " . $_GET['id']);
    if ($row != null) {
        $record['id'] = $row['ministryID'];
        $record['name'] = $row['name'];
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
        echo "<h1>Add Ministry</h1>";
    } else {
        echo "<h1>Ministry " . $record['id'] . "</h1>";
    }
    ?>
    <div class="debug">Action is <?php print $_GET['action']; ?></div>


    <form action="edit_ministry.php" method="post">
        <table>
            <tr <?php if ($action == 'add') echo 'style="display:none;' ?>>
                <td><label for="id">ID</label></td>
                <td><input type="number" name="id" value="<?= $record['id'] ?>" readonly></td>
            </tr>
            <tr>
                <td><label for="name">Name</label></td>
                <td><input type="text" name="name" maxlength="100" <?= $readonly ?>
                           value="<?= $record['name'] ?? '' ?>">
                <td>
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
