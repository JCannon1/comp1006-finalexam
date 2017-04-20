<?php ob_start();

require_once('auth.php');

$pageTitle = 'Edit Car';
require_once ('header.php');

try {
$carId = null;
$name = null;

if (!empty($_GET['carId'])) {
    if (is_numeric($_GET['carId'])) {
        $carId = $_GET['carId'];

        // connect to database
        require_once ('db.php');

        $sql = "SELECT carId, name FROM cars WHERE carId = :carId";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':carId', $carId, PDO::PARAM_INT);
        $cmd->execute();
        $user = $cmd->fetch();

         
        $carId = $car['carId'];
        $name = $car['name'];

        // disconnect from the database
        $conn = null;
    }
}
