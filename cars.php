<?php ob_start();

$pageTitle = 'Cars List';
require_once('header.php'); ?>

<h1>Cars List</h1>

<?php
// ini_set('display_errors', 1);
// start session
session_start();

if (empty($_SESSION['carId'])) {
    echo '<a href="edit.php">Edit a Car</a> ';
}

    // connect to my database
    require_once('db.php');

    $sql = "SELECT carId, name, price, manufacturerId FROM cars ORDER BY name";

    $cmd = $conn->prepare($sql);
    $cmd->execute();
    $cars = $cmd->fetchAll();

    echo '<table class="table table-striped table-hover">
    <tr><th>Name</th><th>Price</th><th>Manufacturer</th>';

    if (empty($_SESSION['carId'])) {
        echo '<th>Edit</th><th>Delete</th>';
    }

    echo '</tr>';

    foreach ($cars as $car) {
        echo '<tr><td>' . $car['name'] . '</td>
            <td>' . $car['price'] . '</td>
            <td>' . $car['manufacturerId'] . '</td>
            <td>';
            
        echo '</td>';

        if (empty($_SESSION['carId'])) {
            echo '<td><a href="edit.php?carId=' . $car
            ['carId'] . '" class="btn btn-primary">Edit</a></td>
            <td><a href="delete-car.php?carId=' . $car['carId'] 
            . '"
            class="btn btn-danger confirmation">Delete</a></td>';
        }

        echo '</tr>';
    }
    
    echo '</table>';

    $conn = null;

?>

<?php require_once('footer.php');
ob_flush(); ?>