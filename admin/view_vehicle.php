<?php

$title = "View Vehicle";
include('../Shared/Admin/head_include.php');

// if no id pass, go to list page
if (!isset($_GET["id"])) {
    header("location: vehicles.php");
    exit;
}

$vehicle_id = $_GET["id"];

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

?>


<!-- view product form -->
<div class="container">
    <h1 class="text-center my-5">Product Details</h1>
    <div class="table-responsive">
        <table class="table">
            <tbody>
                <tr>
                    <th scope="row">Vehicle Name</th>
                    <td><?php echo $vehicle["vehicle_name"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">Model</th>
                    <td><?php echo $vehicle["model"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">Make</th>
                    <td><?php echo $vehicle["make"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">Description</th>
                    <td><?php echo $vehicle["description"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">Price</th>
                    <td><?php echo $vehicle["price"]; ?></td>
                </tr>
                <tr>
                    <th scope="row">Picture</th>
                    <td><?php echo $vehicle["picture"]; ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="container d-flex justify-content-between">
    <a href="edit_vehicle.php?id=<?php echo $vehicle["vehicle_id"]; ?>" class="btn btn-secondary">Edit Vehicle</a>

    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete Vehicle</button>
</div>


<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Delete Vehicle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       Are you sure you want to delete <?php echo $vehicle["vehicle_name"]; ?>?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>
<?php
include('../Shared/Admin/footer_include.php');
?>