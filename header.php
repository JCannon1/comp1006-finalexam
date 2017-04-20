<?php 
ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $pageTitle; ?></title>

    <!-- minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- bootstrap theme CSS -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
</head>
<body>

<nav class="navbar navbar-default">
    <ul class="nav navbar-nav">

        <li><a href="default.php" class="navbar-brand"></li>
        <li><a href="admin-users.php">Users</a></li> <li><a href="<?php echo $page ?>"></a></li>

        <?php

        session_start();

        if (empty($_SESSION['carId'])) {
            echo '<li><a href=".php"></a>'
        }
        else {
            echo '<li><a href="pages.php">Manufacturer Names</a></li> <li><a href="logo.php">Logo</a></li> <li><a href="admin-users.php">Public Site</a></li> <li><a href="control-pannel.php">Control Pannel</a></li> <li><a href="logout.php">Logout</a></li>';
        }
        ?>

    </ul>

    <?php
    if (!empty($_SESSION['carId'])) {
        echo '<div class="navbar-text pull-right">' . $_SESSION['car'] . '</div>';
    }
    ?>
</nav>