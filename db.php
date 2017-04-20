<?php 
// connect to my database
$conn = new PDO('mysql:host=ca-cdbr-azure-central-a.cloudapp.net;dbname=comp1006jessecannondatabase', 'bf3c946f4d66ff', '1d953141');

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>