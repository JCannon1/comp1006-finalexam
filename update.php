<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Cars</title>
</head>
<body>

<?php
ini_set('display_errors', 1);

try {
    $carId = $_POST['carId'];
    $car = $_POST['car'];

    $ok = true;

    if (!empty($_FILES['car']['name'])) {
            $name = $_FILES['car']['name'];

            $arr = end(explode('.', $name));
            //echo $arr;

            // convert the extension to lower case
            $type = strtolower($arr);
            //echo $type;

            // allow jpg / png / gif / svg
            $fileTypes = ['jpg', 'png', 'gif', 'svg'];

            if (!in_array($type, $fileTypes)) {
                echo 'Invalid Image Type<br />';
                $ok = false;
            }

            // size check
            $size = $_FILES['car']['size'];
            if ($size > 2048000) {
                echo 'Logo Image must be less than 2 MB<br />';
                $ok = false;
            }

            // rename to unique file name
            $logo = uniqid("") . "-$name";

            // copy to logos/ folder
            $tmp_name = $_FILES['car']['tmp_name'];
            move_uploaded_file($tmp_name, "cars/$car");
        }

        if ($ok == true) {

            require_once ('db.php');

            $sql = "INSERT INTO cars (carId, car) VALUES (:car)";
            
            // execute the save
            $cmd = $conn->prepare($sql);
            $cmd->bindParam(':car', $car, PDO::PARAM_STR, 50);
            $cmd->execute();

            $car = $cmd->fetch();

            echo 'Image Saved. <a href="default.php">Logo</a>';
            }
}
catch (exception $e) {
    header('location:error.php');
}

// disconnect from my database
$conn = null;

?>

</body>
</html> 


