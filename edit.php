<?php ob_start();

$pageTitle = 'Edit Car';
require_once ('header.php');

try {
$carId = null;
$name = null;
$price = null;
$manufacturerId = null;
$photo = null;

if (!empty($_GET['carId'])) {
    if (is_numeric($_GET['carId'])) {
        $carId = $_GET['carId'];

        // connect to database
        require_once ('db.php');

        $sql = "SELECT carId, name, price, manufacturerId, photo FROM cars WHERE carId = :carId";
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':carId', $carId, PDO::PARAM_INT);
        $cmd->execute();
        $user = $cmd->fetch();

         
        $carId = $car['carId'];
        $name = $car['name'];
        $price = $car['price'];
        $manufacturerId = $car['manufacturerId'];
        $photo = $car['photo'];

        // disconnect from the database
        $conn = null;
    }
}

?>

<main class="container">
    <h1>Edit a Car</h1>
    <!-- New page form -->
    <form method="post" action="save-car.php" enctype="multipart/form-data">
        <fieldset class="form-group">
            <label for="name" class="col-sm-1">Name: *</label>
            <input name="name" id="name" required placeholder="Name" value="<?php echo $name; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="price" class="col-sm-1">Price: *</label>
            <input name="price" id="price" required placeholder="Price" value="<?php echo $price; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="manufacturerId" class="col-sm-1">ManufacturerId: *</label>
            <input name="manufacturerId" id="manufacturerId" required placeholder="ManufacturerId" value="<?php echo $manufacturerId; ?>" />
        </fieldset>
        <fieldset class="form-group">
            <label for="photo" class="col-sm-1">Photo: *</label>
            <input name="photo" id="photo" required placeholder="Photo" value="<?php echo $photo; ?>" />
        </fieldset>

         <input name="carId" id="carId" value="<?php echo $carId; ?>" type="hidden" />
        <button class="btn btn-success col-sm-offset-1">Save</button>
    </form>

</main>

<?php
}
catch (exception $e) {
    header('location:error.php');
}
require_once('footer.php');
ob_flush(); ?>
