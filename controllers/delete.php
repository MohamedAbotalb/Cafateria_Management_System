<?php
// Include your DB class
require_once "../models/db.php";
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if the product ID is provided
    if (isset($_GET["id"])) {
        // Get the product ID to be deleted
        $userIdToDelete = $_GET["id"];

        // Instantiate the DB class
        $db = new DB();

        try {
            // Delete the product from the database
            $db->delete("user", ["id"], [$userIdToDelete]);

            // Prepare JSON response
            $response = [
                'success' => true,
                'message' => 'Product deleted successfully',
                'userId' => $userIdToDelete // Return the ID of the deleted product
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
            'error' => 'User ID not provided'
        ];
        echo json_encode($response);
        exit();
    }
} else {
    // If the request method is not POST, return an error response
    $response = [
        'success' => false,
        'error' => 'Invalid request method'
    ];
    echo json_encode($response);
    exit();
}
