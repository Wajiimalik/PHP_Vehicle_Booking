<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_vehicles_booking";

    date_default_timezone_set("Etc/GMT-5");

    try
    {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // echo "success";
    }
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
        $conn = null;
        exit;
    }
?>