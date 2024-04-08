<?php

require_once "../models/db.php";

class ProductStatusUpdater
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function updateStatus($productId)
    {
        // Fetch the current status of the product
        $status = $this->db->select("product", ["id"], [$productId]);

        // Check if the "available" key exists in the $status array
        if (isset($status[0]["available"])) {
            // Update the status based on the current status
            $newStatus = ($status[0]["available"] == "available") ? "unavailable" : "available";
            $this->db->update("product", ["id" => $productId], ["available" => $newStatus]);

            // Return the updated status
            return $newStatus;
        } else {
            // Handle case where the "available" key is not set
            throw new Exception("Error: Status not found");
        }
    }

    public function processRequest()
    {
        if (isset($_POST["id"])) {
            try {
                $id = $_POST["id"]; // Get the ID of the product

                // Update the status of the product
                $newStatus = $this->updateStatus($id);

                // Return the updated status as response
                echo $newStatus;
            } catch (Exception $e) {
                // Handle any exceptions
                echo "Error: " . $e->getMessage();
            }
        } else {
            // Handle case where the "id" key is not set
            echo "Error: ID not provided";
        }
    }
}

// Instantiate the ProductStatusUpdater class and process the request
$statusUpdater = new ProductStatusUpdater();
$statusUpdater->processRequest();
