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
<h1>Run Query</h1>
<form action="query_results.php" method="get">
    <label for="title">Title:</label>
    <input id="title" type="text" name="title" maxlength="100"><br>
    <label for="sql">SQL:</label>
    <textarea id="sql" name="sql" rows="10" cols="30"></textarea><br>
    <input type="submit" value="submit">
</main>
</body>
</html>