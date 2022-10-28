<?php
$title = "All Vehicles";
include('../Shared/Admin/head_include.php');

include('../Shared/connection.php');


if (isset($_POST["btn_delete_vehicle"])) {
    try {
        $vehicle_id = $_POST["vehicle_id"];
        $stmt = $conn->prepare("DELETE FROM tb_vehicles WHERE vehicle_id = :vehicle_id ;");
        $stmt->bindParam(':vehicle_id', $vehicle_id);
        $stmt->execute();
        header("location: vehicles.php");
        exit;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        $conn = null;
        exit;
    }
}

try {
    $stmt = $conn->prepare("SELECT * FROM tb_vehicles;");
    $stmt->execute();
    $vehicles = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    $conn = null;
    exit;
}

?>

<!-- main body content -->
<!-- list -->
<div class="container">
    <h1 class="text-center my-5">All Products</h1>
    <div class="table-responsive">
        <table class="table table-bordered table-sm align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Vehicle name</th>
                    <th scope="col">Model</th>
                    <th scope="col">Make</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($vehicles as $row) {
                ?>
                    <tr>
                        <th scope="row"><img src="logo.png" width="50"></th>
                        <td><?php echo $row["vehicle_name"]; ?></td>
                        <td><?php echo $row["model"]; ?></td>
                        <td><?php echo $row["make"]; ?></td>
                        <td><?php echo $row["price"]; ?></td>
                        <td class="">
                            <a href="edit_vehicle.php?id=<?php echo $row["vehicle_id"]; ?>" class="mx-2 action-icon"><i class="fa-solid fa-pen-to-square"></i></a>

                            <button onclick="DeleteVehicle(<?php echo $row['vehicle_id']; ?>)" class="mx-2 action-icon"><i class="fa-solid fa-trash""></i></button>

                            <a href="view_vehicle.php?id=<?php echo $row["vehicle_id"]; ?>" class="mx-2 action-icon"><i class="fa-solid fa-eye"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <span id="delete_product_title"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                <form action="vehicles.php" method="post">
                    <input type="hidden" id="vehicle_id" name="vehicle_id" value="">
                    <button type="submit" class="btn btn-primary" name="btn_delete_vehicle">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>



<?php
include('../Shared/Admin/footer_include.php');
?>

<script>
    function DeleteVehicle(id)
    {
        $("#vehicle_id").attr("value", id);
        $("#deleteModal").modal("show");
    }
</script>