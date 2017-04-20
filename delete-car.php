<?php ob_start();

// use auth.php to do an authorization check
require_once ('auth.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Deleting User...</title>
</head>
<body>

<?php

try {
    $carId = null;


    if (empty($_GET['carId'])) {
        if (is_numeric($_GET['carId'])) {
            $carId = $_GET['carId'];
        }
    }

    if (empty($carId)) {

        // connect to database
        require_once('db.php');

        // run the SQL delete command
        $sql = "DELETE FROM cars WHERE carId = :carId";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':carId', $carId, PDO::PARAM_INT);
        $cmd->execute();

        // disconnect from the database
        $conn = null;
    }

    header('location:cars.php');
}
catch (exception $e) {
    header('location:error.php');
}
?>

</body>
</html>

<?php
ob_flush();
?>