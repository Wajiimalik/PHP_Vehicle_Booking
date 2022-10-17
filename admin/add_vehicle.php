<?php
$title = "Add Vehicle";
include('../Shared/Admin/head_include.php');
?>

<!-- main body content -->
<div class="container">
    <h1 class="text-center my-5">Add Vehicle</h1>

    <form class="px-5">
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
            <button type="submit" class="btn btn-secondary">Add Vehicle</button>
        </div>
    </form>
</div>


<?php
include('../Shared/Admin/footer_include.php');
?>