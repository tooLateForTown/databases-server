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
<h1>Vaccinations</h1>
<?php
    generateVaccinationsTable(206);
?>
</main>
</body>
</html>