<?php require('globals.php'); ?>
<?php
// PROCESSING SUBMISSION FROM FORM HERE
$conn = createConnection();
$table = null;
$action = null; // view, delete, add, edit, commit
$mode = null;

$mode = isset($_GET['mode']) ? $_GET['mode'] : null;

// ********   HANDLE SUBMIT FORM HERE ***  ******
if (isset($_POST['commit'])) {
    

    $action = $_POST['commit'];
    if ($mode == 'student') {
        if (($action == 'add' || $action == 'edit')) {
            // PART 1 AND 2 ONLY RUN IF ADDING OR EDITING
            // ** PART 1: LOAD DATA FROM POST
            $record['personID'] = $_POST['personID'];
            $record['facilityID'] = $_POST['facilityID'];
            $record['firstName'] = $_POST['firstName'];
            $record['lastName'] = $_POST['lastName'];
            $record['address'] = $_POST['address'];
            $record['city'] = $_POST['city'];
            $record['province'] = $_POST['province'];
            $record['medicare'] = $_POST['medicare'];
            $record['isStudent'] = 1;
            $record['isEmployee'] = isset($_POST['isEmployee']) ? 1 : 0;

            if ($record['personID'] == -1) {
                $personID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM Persons"))['COUNT(*)'] + 1;
                $record['personID'] = $personID;
            }

            // ** PART 2: VALIDATE DATA

            if (empty($record['medicare'])) {
                // Student does not have valid Medicare card number
                print("<div class='error> Student must have valid Medicare card number.</div>");
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
        }


        $sql = "to build";
        switch ($action) {
            case 'add':

                if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Persons WHERE medicare='$record[medicare]'")) > 0) {
                    // Person already exists
                    print("<div class='error> Person with same medicare number already exist in the database.</div>");
                    exit();
                } else {
                    // Insert new person into database

                    $sql = "INSERT INTO Persons (personID,firstName, lastName, address, city, province, medicare, isStudent, isEmployee)";
                    $sql .= " VALUES(";
                    $sql .= $record['personID'] . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['firstName']) . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['lastName']) . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['address']) . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['city']) . "',";
                    $sql .= "'" . $record['province'] . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['medicare']) . "',";
                    $sql .= "'" . $record['isStudent'] . ",";
                    $sql .= "'" . $record['isEmployee'] . ",";
                    $sql .= ");";

                    // Execute the INSERT statement for Persons table
                    if (!mysqli_query($conn, $sql)) {
                        // INSERT failed
                        echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
                        exit();
                    }
                }

                // Get the personID of the newly inserted person


                break;

            case 'edit':


                // Update Persons table
                $sql = "UPDATE Persons SET ";
                $sql .= "firstName='" . mysqli_real_escape_string($conn, $record['firstName']) . "',";
                $sql .= "lastName='" . mysqli_real_escape_string($conn, $record['lastName']) . "',";
                $sql .= "address='" . mysqli_real_escape_string($conn, $record['address']) . "',";
                $sql .= "city='" . mysqli_real_escape_string($conn, $record['city']) . "',";
                $sql .= "province='" . mysqli_real_escape_string($conn, $record['province']) . "',";
                $sql .= "medicare='" . mysqli_real_escape_string($conn, $record['medicare']) . "'";
                $sql .= "'" . $record['isStudent'] . ",";
                $sql .= "'" . $record['isEmployee'] . ",";
                $sql .= " WHERE personID=" . $record['personID'];
                break;


            case 'delete':
                $sql = "DELETE FROM Students WHERE personID=" . $_POST['personID'];

                break;
            case 'view':
                break; // nothing to do

        }


        $success = commit($sql, $conn);
        if ($success) {
            header("Location: students.php"); // jump away.  Cannot have any html before header command.
        }
        // Commit FAILED!
        echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
        echo "<div class='debug'>";
        print_r($_POST);
        echo "</div>";
        exit();
    } elseif ($mode == 'employee') // end of ADD or EDITif (($action == 'add' || $action == 'edit') && $mode == 'student' ) 
    {
        if (($action == 'add' || $action == 'edit')) {
            // PART 1 AND 2 ONLY RUN IF ADDING OR EDITING
            // ** PART 1: LOAD DATA FROM POST
            $record['personID'] = $_POST['personID'];
            $record['facilityID'] = $_POST['facilityID'];
            $record['firstName'] = $_POST['firstName'];
            $record['lastName'] = $_POST['lastName'];
            $record['address'] = $_POST['address'];
            $record['city'] = $_POST['city'];
            $record['province'] = $_POST['province'];
            $record['medicare'] = $_POST['medicare'];
            $record['isStudent'] = $_POST['isStudent'];
            $record['isEmployee'] = $_POST['isEmployee'];

            if ($record['personID'] == -1) {
                $personID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) FROM Persons"))['COUNT(*)'] + 1;
                $record['personID'] = $personID;
            }



            // ** PART 2: VALIDATE DATA

            if (empty($record['medicare'])) {
                // Student does not have valid Medicare card number
                print("<div class='error> Student must have valid Medicare card number.</div>");
                exit();
            }

            if ($record['firstName'] == null || $record['lastName'] == "") {
                print("<div class='error'>Name must be set</div>");
                exit();
            }
        }
        $sql = "to build";
        switch ($action) {
            case 'add':

                if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM Persons WHERE medicare='$record[medicare]'")) > 0) {
                    // Person already exists
                    print("<div class='error> Person with same medicare number already exist in the database.</div>");
                    exit();
                } else {
                    // Insert new person into database

                    $sql = "INSERT INTO Persons (personID,firstName, lastName, address, city, province, medicare)";
                    $sql .= " VALUES(";
                    $sql .= $record['personID'] . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['firstName']) . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['lastName']) . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['address']) . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['city']) . "',";
                    $sql .= "'" . $record['province'] . "',";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['medicare']) . "',";
                    $sql .= ");";

                    // Execute the INSERT statement for Persons table
                    if (!mysqli_query($conn, $sql)) {
                        // INSERT failed
                        echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
                        exit();
                    }
                }


                // Get the personID of the newly inserted person

                $personID = mysqli_insert_id($conn);

                // Check if student already exists
                $query = "SELECT * FROM Students WHERE personID='$personID' AND facilityID='$record[facilityID]' AND startDate='$record[startDate]'";
                $result = mysqli_query($conn, $query);
                if (
                    mysqli_num_rows($result) > 0
                ) {
                    // Student already exists
                    print("<div class='error'> Student already exists in database.</div>");
                    exit();
                } else {
                    // Insert new student into database
                    $sql = "INSERT INTO  (personID, facilityID, startDate, endDate, grade)";
                    $sql .= " VALUES(";
                    $sql .= "$personID" . ",";
                    $sql .= "$record[facilityID]" . ",";
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['startDate']) . "',";
                    if (!empty($record['endDate'])) {
                        $sql .= "'" . mysqli_real_escape_string($conn, $record['endDate']) . "',";
                    } else {
                        $sql .= "NULL,";
                    }
                    $sql .= "'" . mysqli_real_escape_string($conn, $record['grade']) . "'";
                    $sql .= ");";

                    // Execute the INSERT statement for Students table
                    if (!mysqli_query(
                        $conn,
                        $sql
                    )) {
                        // INSERT failed
                        echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
                        exit();
                    }
                }
                break;

            case 'edit':

                // Update Persons table
                $sql = "UPDATE Persons SET ";
                $sql .= "firstName='" . mysqli_real_escape_string($conn, $record['firstName']) . "',";
                $sql .= "lastName='" . mysqli_real_escape_string($conn, $record['lastName']) . "',";
                $sql .= "address='" . mysqli_real_escape_string($conn, $record['address']) . "',";
                $sql .= "city='" . mysqli_real_escape_string($conn, $record['city']) . "',";
                $sql .= "province='" . mysqli_real_escape_string($conn, $record['province']) . "',";
                $sql .= "medicare='" . mysqli_real_escape_string($conn, $record['medicare']) . "'";
                $sql .= " WHERE personID=" . $record['personID'];
                break;


            case 'delete':
                $sql = "DELETE FROM Students WHERE personID=" . $_POST['personID'];

                break;
            case 'view':
                break; // nothing to do

        }


        $success = commit($sql, $conn);
        if ($success) {
            header("Location: students.php"); // jump away.  Cannot have any html before header command.
        }
        // Commit FAILED!
        echo "<div class='error'>FAILED!  SQL: " . $sql . "</div>";
        echo "<div class='debug'>";
        print_r($_POST);
        echo "</div>";
        exit();
    }
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
if ($mode == 'student') {
    $record['personID'] = -1;
    $record['firstName'] = "";
    $record['lastName'] = "";
    $record['address'] = "";
    $record['medicare'] = "";
    $record['city'] = "";
    $record['province'] = "QC";
    $record['facilityID'] = -1;
} elseif ($mode == 'employee') {
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
}


if ($action != 'add' && $mode == 'student') {
    $row = selectSingleTuple("SELECT Students.*, Persons.firstName, Persons.lastName, Persons.address, Persons.city, Persons.province, Persons.medicare, Persons.isStudent, Persons.isEmployee FROM Students JOIN Persons ON Students.personID = Persons.personID WHERE Students.personID = " . $_GET['id']);
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
} elseif ($action != 'add' && $mode == 'employee') {
    $row = selectSingleTuple("SELECT Employees.*, Persons.firstName, Persons.lastName, Persons.address, Persons.city, Persons.province, Persons.medicare FROM Employees JOIN Persons ON Employees.personID = Persons.personID WHERE Employees.personID = " . $_GET['id']);
    if ($row != null) {
        $record['personID'] = $row['personID'];
        $record['facilityID'] = $row['facilityID'];
        $record['startDate'] = $row['startDate'];
        $record['endDate'] = $row['endDate'];
        $record['firstName'] = $row['firstName'];
        $record['lastName'] = $row['lastName'];
        $record['address'] = $row['address'];
        $record['city'] = $row['city'];
        $record['province'] = $row['province'];
        $record['medicare'] = $row['medicare'];
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
       
       $mode = isset($_GET['mode']) ? $_GET['mode'] : null;
        if ($mode == 'student') {
            if ($action == 'add') {
                echo "<h1>Add Student</h1>";
            } else {
                echo "<h1>Student " . $record['personID'] . "</h1>";
            }
        ?>
            <div class="debug">Action is <?php print $_GET['action']; ?></div>



            <form action="edit_person.php" method="post">
                <table>
                    <tr <?php if ($action == 'add') echo 'style="display:none;' ?>>
                        <td><label for="personID">ID</label></td>
                        <td><input type="number" name="personID" value="<?= $record['personID'] ?>" readonly></td>

                    </tr>
                    <tr>
                        <td><label for="firstName">First Name</label></td>
                        <td><input type="text" name="firstName" maxlength="100" <?= $readonly ?> value="<?= $record['firstName'] ?? '' ?>">
                        <td>
                    </tr>
                    <tr>
                        <td><label for="lastName">Last Name</label></td>
                        <td><input type="text" name="lastName" maxlength="100" <?= $readonly ?> value="<?= $record['lastName'] ?? '' ?>">
                        <td>
                    </tr>
                    <tr>
                        <td><label for="medicare">Medicare</label></td>
                        <td><input type="text" name="medicare" maxlength="14" pattern="[A-Z]{4} [0-9]{4} [0-9]{4}" <?= $readonly ?> value="<?= $record['medicare'] ?? '' ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="address">Address</label></td>
                        <td><input type="text" name="address" maxlength="100" <?= $readonly ?> value="<?= $record['address'] ?? '' ?>"></td>
                    </tr>
                    <tr>
                        <td><Label for="city">City</Label></td>
                        <td><input type="text" name="city" maxlength="100" <?= $readonly ?> value="<?= $record['city'] ?? '' ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="province">Province</label></td>
                        <td><select name="province" id="province" <?= $readonly ?>>
                                <?php listProvinceOptions($record['province']); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="facilityID">Facility</label></td>
                        <td><select name="facilityID" id="facilityID" <?= $readonly ?>>
                                <?php listFacilityOptions($record['facilityID'], $conn); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Is Student</td>
                        <td>
                            <input type="radio" name="isStudent" id="studentYes" value="1" <?= $readonly ?> checked >
                            <label for="studentYes">Yes</label>
                            <input type="radio" name="isStudent" id="studentNo" value="0" <?= $readonly ?> >
                            <label for="studentNo">No</label>
                        </td>
                    </tr>

                    <tr>
                        <td>Is Employee</td>
                        <td>
                            <input type="radio" name="isEmployee" value="1" <?= $readonly ?> <?php if ($record['isEmployee'] == 1) print "checked"; ?> 
                            <label for="isEmployee">Yes</label>
                            <input type="radio" name="isEmployee" value="1" <?= $readonly ?> <?php if ($record['isEmployee'] == 0) print "checked"; ?> 
                            <label for="isEmployee">No</label>
                        </td>
                    </tr>

                </table>
                
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
            </form>
        <?php
        } else if ($mode == 'employee') {
            // Display the employee form
            if ($action == 'add') {
                echo "<h1>Add Employee</h1>";
            } else {
                echo "<h1>Employee " . $record['personID'] . "</h1>";
            }

        ?>


            <div class="debug">Action is <?php print $_GET['action']; ?></div>


            <form action="edit_person.php" method="post">
                <table>
                    <tr <?php if ($action == 'add') echo 'style="display:none;' ?>>
                        <td><label for="personID">ID</label></td>
                        <td><input type="number" name="personID" value="<?= $record['personID'] ?>" readonly></td>

                    </tr>
                    <tr>
                        <td><label for="firstName">First Name</label></td>
                        <td><input type="text" name="firstName" maxlength="100" <?= $readonly ?> value="<?= $record['firstName'] ?? '' ?>">
                        <td>
                    </tr>
                    <tr>
                        <td><label for="lastName">Last Name</label></td>
                        <td><input type="text" name="lastName" maxlength="100" <?= $readonly ?> value="<?= $record['lastName'] ?? '' ?>">
                        <td>
                    </tr>
                    <tr>
                        <td><label for="medicare">Medicare</label></td>
                        <td><input type="text" name="medicare" maxlength="14" pattern="[A-Z]{4} [0-9]{4} [0-9]{4}" <?= $readonly ?> value="<?= $record['medicare'] ?? '' ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="address">Address</label></td>
                        <td><input type="text" name="address" maxlength="100" <?= $readonly ?> value="<?= $record['address'] ?? '' ?>"></td>
                    </tr>
                    <tr>
                        <td><Label for="city">City</Label></td>
                        <td><input type="text" name="city" maxlength="100" <?= $readonly ?> value="<?= $record['city'] ?? '' ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="province">Province</label></td>
                        <td><select name="province" id="province" <?= $readonly ?>>
                                <?php listProvinceOptions($record['province']); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="facilityID">Facility</label></td>
                        <td><select name="facilityID" id="facilityID" <?= $readonly ?>>
                                <?php listFacilityOptions($record['facilityID'], $conn); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Is Employee</td>
                        <td>
                            <input type="radio" name="isEmployee" id="employeeYes" value="1" <?= $readonly ?> checked disabled>
                            <label for="employeeYes">Yes</label>
                            <input type="radio" name="isEmployee" id="employeeNo" value="0" <?= $readonly ?> disabled>
                            <label for="employeeNo">No</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Is Student</td>
                        <td>
                            <input type="radio" name="isStudent" id="studentYes" value="1" <?= $readonly ?>>
                            <label for="studentYes">Yes</label>
                            <input type="radio" name="isStudent" id="studentNo" value="0" <?= $readonly ?>>
                            <label for="studentNo">No</label>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="startDate">Start Date</label></td>
                        <td><input type="date" name="startDate" <?= $readonly ?> value="<?= $record['startDate'] ?? '' ?>">
                        <td>
                    </tr>
                    <tr>
                        <td><label for="endDate">End Date</label></td>
                        <td><input type="date" name="endDate" <?= $readonly ?> value="<?= $record['endDate'] ?? '' ?>">
                        <td>
                    </tr>


                    <tr>
                </table>
                
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
            </form>

        <?php

        }
        ?>
    </main>
</body>
<html>