<?php
require_once "../models/db.php";

// Check if the "id" key is set in the $_POST array
if (isset($_POST["id"])) {
    $id = $_POST["id"]; // Get the ID of the product

    // Instantiate DB class
    $db = new DB();

    // Fetch the current status of the product
    $status = $db->select("product", ["id"], [$id]);

    // Check if the "available" key exists in the $status array
    if (isset($status[0]["available"])) {
        // Update the status based on the current status
        $newStatus = ($status[0]["available"] == "available") ? "unavailable" : "available";
        $db->update("product", ["id" => $id], ["available" => $newStatus]);

        // Return the updated status as response
        echo $newStatus;
    } else {
        // Handle case where the "available" key is not set
        echo "Error: Status not found";
        // var_dump($status[0]["available"]);
    }
} else {
    // Handle case where the "id" key is not set
    echo "Error: ID not provided";
}
