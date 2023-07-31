<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Comp 353 Project</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>

<?php
if (isset($_GET['db'])) {
    print ("SUBMIT!");
}
?>


<h1>Facility <?php print $_GET['id']; ?></h1>
<h1>Action is <?php print $_GET['action']; ?></h1>


<form action="edit_facility.php" method="get">
    name: <input type="text" name="name"><br>
    <input type="hidden" name="db" value="commit">
    <input type="submit" value="submit">

</form>


</body>
<html>
