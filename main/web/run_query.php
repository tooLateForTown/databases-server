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
<h1>Run Query</h1>
<form action="query_results.php" method="get">
    <label for="title">Title:</label>
    <input id="title" type="text" name="title" maxlength="100"><br>
    <label for="sql">SQL:</label>
    <textarea id="sql" name="sql" rows="10" cols="30"></textarea><br>
    <input type="submit" value="submit">
</body>
</html>