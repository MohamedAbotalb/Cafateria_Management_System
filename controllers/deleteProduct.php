<?php

require_once "../models/db.php";

class ProductDeleter
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function deleteProduct($productId)
    {
        // Delete the product from the database
        $this->db->delete("product", ["id"], [$productId]);
    }

    public function processRequest()
    {
        // Check if the request method is GET
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Check if the product ID is provided
            if (isset($_GET["id"])) {
                // Get the product ID to be deleted
                $productIdToDelete = $_GET["id"];

                try {
                    // Delete the product
                    $this->deleteProduct($productIdToDelete);

                    // Prepare JSON response
                    $response = [
                        'success' => true,
                        'message' => 'Product deleted successfully',
                        'productId' => $productIdToDelete  // Return the ID of the deleted product
                    ];

                    // Return the success flag and deleted product ID in JSON format
                    echo json_encode($response);
                    exit(); // No need to redirect or output anything else
                } catch (Exception $e) {
                    // Handle any exceptions
                    $response = [
                        'success' => false,
                        'error' => $e->getMessage()
                    ];
                    echo json_encode($response);
                    exit();
                }
            } else {
                // If the product ID is not provided, return an error response
                $response = [
                    'success' => false,
                    'error' => 'Product ID not provided'
                ];
                echo json_encode($response);
                exit();
            }
        } else {
            // If the request method is not GET, return an error response
            $response = [
                'success' => false,
                'error' => 'Invalid request method'
            ];
            echo json_encode($response);
            exit();
        }
    }
}

// Instantiate the ProductDeleter class and process the request
$productDeleter = new ProductDeleter();
$productDeleter->processRequest();
