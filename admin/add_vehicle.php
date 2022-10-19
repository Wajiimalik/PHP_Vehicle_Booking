<?php
$title = "Add Vehicle";
include('../Shared/Admin/head_include.php');


if(isset($_POST["btn_add_vehicle"]))
{
    $vehicle_name = $_POST["vehicle_name"];
    $model = $_POST["model"];
    $make = $_POST["make"];
    $picture = $_POST["picture"];
    $price = $_POST["price"];
    $description = $_POST["description"];

    include('../Shared/connection.php');

    try{
        $stmt = $conn->prepare("INSERT INTO tb_vehicles(vehicle_name, model, make, picture, price, description) VALUES(:vehicle_name, :model, :make, :picture, :price, :description);");

        $stmt->bindParam(':vehicle_name', $vehicle_name);
        $stmt->bindParam(':model', $model);
        $stmt->bindParam(':make', $make);
        $stmt->bindParam(':picture', $picture);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':description', $description);

        $stmt->execute();
        
        header("location: vehicles.php");
        exit;
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
        $conn = null;
        exit;
    }
}


?>

<!-- main body content -->
<div class="container">
    <h1 class="text-center my-5">Add Vehicle</h1>

    <form class="px-5" action="add_vehicle.php" method="POST">
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Vehicle Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Vehicle name" name="vehicle_name">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Model</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Model" name="model">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Make</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Make" name="make">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Picture</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Picture" name="picture">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" placeholder="Price" name="price">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" placeholder="Description" name="description"></textarea>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-secondary" name="btn_add_vehicle">Add Vehicle</button>
        </div>
    </form>
</div>


<?php
include('../Shared/Admin/footer_include.php');
?>