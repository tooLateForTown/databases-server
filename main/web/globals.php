<?php
    $servername = "ddc353.encs.concordia.ca";
    $username = "ddc353_1";
    $password = "12pass34";
    $dbname = "ddc353_1";

//enum Actions {
//    case add;
//    case edit;
//    case delete;
//    case view;
//}

function commonHead() {
        echo "\t<meta charset='UTF-8'>\r\n";
        echo "\t<meta name='viewport' content='width=device-width, initial-scale=1'>\r\n";
        echo "\t<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css'>\r\n";
        echo "\t<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>\r\n";
        echo "\t<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js'></script>\r\n";
        echo "\t<link rel='stylesheet' href='style1.css'>\r\n";
        echo "\t<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>\r\n";
    }
function commonNav() {
    echo "<nav class='navbar navbar-default'>\r\n";
    echo "\t<div class='container-fluid'>\r\n";
    echo "\t\t<div class='navbar-header'>\r\n";
    echo "\t\t\t<a class='navbar-brand' href='#'>EPSTS</a>\r\n";
    echo "\t\t</div>\r\n";
    echo "\t\t<ul class='nav navbar-nav'>\r\n";
    echo "\t\t\t<li class='active'><a href='index.php'>Tables</a></li>\r\n";
    echo "\t\t\t<li class='active'><a href='queries.php'>Queries</a></li>\r\n";
    echo "\t\t</ul>\r\n";
    echo "\t</div>\r\n";
    echo "</nav>\r\n";
}

function generateMasterTable($selectSQL, $consumer, $idCol=0, $nameCol=1, $scalarCol=2) {

    $conn = createConnection();

    try {
        $result= mysqli_query($conn, $selectSQL);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    mysqli_close($conn);

    echo "<a href='".$consumer."?id=-1&action=add'><i class='material-icons'>add_box</i> Add new record</a>";
    echo "<br/><br/>";
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr><th>ID</th><th>Name</th>";
    if ($scalarCol != -1) {
        echo "<th>Records</th>";
    }
    echo "<th>View</th><th>Edit</th><th>Delete</th></tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($tables as $table) {
        echo "<tr class='tablerow'>";
        echo "<td>".$table[$idCol]."</td>";
        echo "<td style='text-align:left'><a href='" .$consumer."?id=" . $table[$idCol] . "&action=view'>" . $table[$nameCol] . "</a></td>";
        if ($scalarCol != -1) {
            echo "<td>" . $table[$scalarCol] . "</td>";
        }
        echo "<td><a href='".$consumer."?id=" . $table[$idCol] . "&action=view'><i class='material-icons'>visibility</i></a></td>";
        echo "<td><a href='".$consumer."?id=" . $table[$idCol] . "&action=edit'><i class='material-icons'>edit</i></a></td>";
        echo "<td><a href='".$consumer."?id=" . $table[$idCol] . "&action=delete'><i class='material-icons'>delete</i></a></td>";
        echo "</tr>\r\n";
    }
    echo "</tbody>";
    echo "</table>";
}

function createConnection() {
    // Create connection
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }
}

function selectSingleTuple($sql, $conn = null) {

    if ($conn == null) {
        $conn = createConnection();
    }

    try {
        $result= mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    $row = mysqli_fetch_assoc($result);
//    $rows = mysqli_fetch_all($result);
    mysqli_free_result($result);
    mysqli_close($conn);
    if ($row == null) {
        echo "<div class='error'>Query failed to return a single row: " . $sql . "</div>";
        exit();
    } else {
        return $row;
    }
}


function generateTableFromQuery($sql, $title) {
    //    Example consumer:  'edit_facility.php'
    $conn = createConnection();

    try {
        $result=mysqli_query($conn, $sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }

    $fields = $result->fetch_fields();
    $cols = $result->field_count;
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    mysqli_close($conn);

    echo "<h1>".$title."</h1>";

    echo "<table>";
    echo "<tr>";
    foreach ($fields as $field) {
        echo "<th>".$field->name."</th>";
    }
    echo "</tr>";
    foreach ($tables as $table) {
        echo "<tr class='tablerow'>";
        for ($i = 0; $i < $cols; $i++) {
            if ($fields[$i]->type == 253) {
                echo "<td style='text-align:left'>".$table[$i]."</td>";
            } else {
                echo "<td>".$table[$i]."</td>";
            }

        }
        echo "</tr>\r\n";
    }
    echo "</table>";
}

function listProvinceOptions($selected) {
    echo "<option value='AB' ".($selected=="AB"?"selected='selected'":'').">Alberta</option>\r\n";
    echo "<option value='BC' ".($selected=="BC"?"selected='selected'":'').">British Columbia</option>\r\n";
    echo "<option value='ON' ".($selected=="ON"?"selected='selected'":'').">Ontario</option>\r\n";
    echo "<option value='MB' ".($selected=="MB"?"selected='selected'":'').">Manitoba</option>\r\n";
    echo "<option value='NB' ".($selected=="NB"?"selected='selected'":'').">New Brunswick</option>\r\n";
    echo "<option value='NL' ".($selected=="NL"?"selected='selected'":'').">Newfoundland and Labrador</option>\r\n";
    echo "<option value='NS' ".($selected=="NS"?"selected='selected'":'').">Nova Scotia</option>\r\n";
    echo "<option value='NT' ".($selected=="NT"?"selected='selected'":'').">Northwestern Territories</option>\r\n";
    echo "<option value='NU' ".($selected=="NU"?"selected='selected'":'').">Nunavut</option>\r\n";
    echo "<option value='PE' ".($selected=="PE"?"selected='selected'":'').">Prince Edward Island</option>\r\n";
    echo "<option value='QC' ".($selected=="QC"?"selected='selected'":'').">Quebec</option>\r\n";
    echo "<option value='SK' ".($selected=="SK"?"selected='selected'":'').">Saskatchewan</option>\r\n";
    echo "<option value='YT' ".($selected=="YT"?"selected='selected'":'').">Yukon</option>\r\n";
}


function listMinistryOptions($selected, $conn) {
    $sql = "SELECT ministryID,name FROM Ministries";
    $result = mysqli_query($conn, $sql);
    $rows = mysqli_fetch_all($result);
    foreach ($rows as $row) {
        echo "<option value='".$row[0]."' ".($selected==$row[0]?"selected='selected'":'').">".$row[1]."</option>\r\n";
    }
}

function commit($sql, $conn=null) {
    if ($conn == null) {
        $conn = createConnection();
    }

    $result = true;
    try {
        $result=$conn->query($sql);
    } catch (mysqli_sql_exception $e) {
        echo "<div class='error'>MySQl returned error evaluating : " . $sql . "<br>Message: " . $e->getMessage() . "</div>";
        return;
    }
    mysqli_close($conn);
    return $result;
}

?>

