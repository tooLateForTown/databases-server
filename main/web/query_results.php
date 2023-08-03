<?php require('globals.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comp 353 Project</title>
    <?php commonHead(); ?>
</head>
<body>
<?php commonNav(); ?>
<main>
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
