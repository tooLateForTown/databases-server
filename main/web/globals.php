<?php
    $servername = "ddc353.encs.concordia.ca";
    $username = "ddc353_1";
    $password = "12pass34";
    $dbname = "ddc353_1";


function generateMasterTable($selectSQL, $consumer, $idCol=0, $nameCol=1) {
    //    Example consumer:  'edit_facility.php'
    echo "<div class='debug'>";
    echo "Attempting to connect to MySql...";

    // Create connection
    $conn = new mysqli($GLOBALS['servername'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['dbname']);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    echo "</div>";

    $result= mysqli_query($conn, $selectSQL);
    $tables = mysqli_fetch_all($result);
    mysqli_free_result($result);
    mysqli_close($conn);

    echo "<a href='".$consumer."?id=-1&action=create'><i class='material-icons'>add_box</i> Add new record</a>";
    echo "<br/><br/>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>View</th><th>Edit</th><th>Delete</th></tr>";
    foreach ($tables as $table) {
        echo "<tr class='tablerow'>";
        echo "<td>".$table[$idCol]."</td>";
        echo "<td style='text-align:left'><a href='" .$consumer."?id=" . $table[$idCol] . "&action=display'>" . $table[$nameCol] . "</a></td>";
        echo "<td><a href='".$consumer."?id=" . $table[$idCol] . "&action=display'><i class='material-icons'>visibility</i></a></td>";
        echo "<td><a href='".$consumer."?id=" . $table[$idCol] . "&action=edit'><i class='material-icons'>edit</i></a></td>";
        echo "<td><a href='".$consumer."?id=" . $table[$idCol] . "&action=delete'><i class='material-icons'>delete</i></a></td>";
        echo "</tr>\r\n";
    }
    echo "</table>";
}
?>

