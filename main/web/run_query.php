<?php require('globals.php'); ?>
<?php
$sql = "";
$title = "Generic Query";
$ask_employee = false;
$ask_facility = false;

if (isset($_GET['queryID'])) {
    // Need to show a predefined query
    global $queries;
    $qid = $_GET['queryID'];

    foreach ($queries as $query) {
        if ($query->id == $qid) {
            $sql = $query->sql;
            $title = $query->title;
            $ask_facility = $query->ask_facility;
            $ask_employee = $query->ask_employee;
            break;
        }
    }
} ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Comp 353 Project</title>
    <?php commonHead(); ?>
</head>
<body>
<?php commonNav(); ?>
<main>
    <h1>Run Query</h1>
    <form action="query_results.php" method="get">
        <label for="title">Title</label>
        <input id="title" type="text" name="title" maxlength="100" size="100" value="<?= $title ?>"><br><br>
        <label for="sql">SQL:</label>
        <textarea id="sql" name="sql" rows="20" cols="100"><?= $sql ?></textarea><br>
        <input type="submit" value="submit">
</main>
</body>
</html>