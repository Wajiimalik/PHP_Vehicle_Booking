<?php

$title = "Edit Vehicle";
include('../Shared/Admin/head_include.php');

// if no id pass, go to list page
if (!(isset($_GET["id"])   || isset($_POST["vehicle_id"]))) {
    header("location: vehicles.php");
    exit;
}

if (isset($_GET["id"])) {
    $vehicle_id = $_GET["id"];
} else {
    $vehicle_id = $_POST["vehicle_id"];
}


include('../Shared/connection.php');
try {
    $stmt = $conn->prepare("SELECT * FROM tb_vehicles WHERE vehicle_id = :vehicle_id;");
    $stmt->bindParam(":vehicle_id", $vehicle_id);
    $stmt->execute();
    $vehicle = $stmt->fetch();

    // print_r($vehicle);
    // exit;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $conn = null;
    exit;
}

if (isset($_POST["btn_update_vehicle"])) {
    $vehicle_name = $_POST["vehicle_name"];
    $model = $_POST["model"];
    $make = $_POST["make"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    try {

        if (isset($_FILES["picture"]) && $_FILES["picture"]['error'] == 0) {
            // image changed
            include('../Shared/image_upload.php');
            $fileResult = UploadImage($_FILES["picture"]);

            if ($fileResult["status"] == "success") {
                $stmt = $conn->prepare("UPDATE tb_vehicles SET vehicle_name= :vehicle_name, model = :model, make = :make, picture = :picture, price = :price, description = :description WHERE vehicle_id = :vehicle_id ;");
                $picture = $fileResult["uploadedFile"];
                $stmt->bindParam(':vehicle_id', $vehicle_id);
                $stmt->bindParam(':vehicle_name', $vehicle_name);
                $stmt->bindParam(':model', $model);
                $stmt->bindParam(':make', $make);
                $stmt->bindParam(':picture', $picture);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':description', $description);
                $stmt->execute();

                header("location: vehicles.php");
                exit;
            } else {
                echo $fileResult["msg"];
            }
        } else {
            // not changed
            $stmt = $conn->prepare("UPDATE tb_vehicles SET vehicle_name= :vehicle_name, model = :model, make = :make, price = :price, description = :description WHERE vehicle_id = :vehicle_id ;");
            $stmt->bindParam(':vehicle_id', $vehicle_id);
            $stmt->bindParam(':vehicle_name', $vehicle_name);
            $stmt->bindParam(':model', $model);
            $stmt->bindParam(':make', $make);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':description', $description);
            $stmt->execute();

            header("location: vehicles.php");
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $conn = null;
        exit;
    }
}

?>


<!-- main body content -->
<div class="container">
    <h1 class="text-center my-5">Edit Vehicle</h1>

    <form class="px-5" action="edit_vehicle.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle["vehicle_id"]; ?>">
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Vehicle Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Vehicle name" name="vehicle_name" value="<?php echo $vehicle["vehicle_name"]; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Model</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Model" name="model" value="<?php echo $vehicle["model"]; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Make</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="Make" name="make" value="<?php echo $vehicle["make"]; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Picture</label>
            <div class="col-sm-10">
                <div class="row">
                    <div class="col-md-8">
                        <input type="file" class="form-control" placeholder="Picture" name="picture" onchange="ChangeShownImage(event)">
                    </div>
                    <div class="col-md-4">
                        <img src="<?php echo $vehicle["picture"]; ?>" alt="" height="100" id="shownImage">
                    </div>
                    <script>
                        function ChangeShownImage(event) {
                            document.getElementById("shownImage").src = URL.createObjectURL(event.target.files[0]);
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Price</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" placeholder="Price" name="price" value="<?php echo $vehicle["price"]; ?>">
            </div>
        </div>
        <div class="row mb-3">
            <label for="" class="col-sm-2 col-form-label">Description</label>
            <div class="col-sm-10">
                <textarea class="form-control" placeholder="Description" name="description"><?php echo $vehicle["description"]; ?></textarea>
            </div>
        </div>
        <div class="text-end">
            <button type="submit" class="btn btn-secondary" name="btn_update_vehicle">Update Vehicle</button>
        </div>
    </form>
</div>


<?php
include('../Shared/Admin/footer_include.php');
?>