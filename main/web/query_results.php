<?php require('globals.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comp 353 Project</title>
    <link rel="stylesheet" href="../../style1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
<?php
    $title= $_GET['title'] ?? "Query Results";
    if (isset($_GET['sql'])) {
        $query = $_GET['sql'];
        generateTableFromQuery($query,$title);
        exit();
    }
?>
</body>
</html>
