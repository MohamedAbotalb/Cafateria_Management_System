<?php

require_once "../models/db.php";

class UserDeleter
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function deleteUser($userId)
    {
        // Delete the user from the database
        $this->db->delete("user", ["id"], [$userId]);
    }

    public function processRequest()
    {
        // Check if the request method is GET
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Check if the user ID is provided
            if (isset($_GET["id"])) {
                // Get the user ID to be deleted
                $userIdToDelete = $_GET["id"];

                try {
                    // Delete the user
                    $this->deleteUser($userIdToDelete);

                    // Prepare JSON response
                    $response = [
                        'success' => true,
                        'message' => 'User deleted successfully',
                        'userId' => $userIdToDelete // Return the ID of the deleted user
                    ];

                    // Return the success flag and deleted user ID in JSON format
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
                // If the user ID is not provided, return an error response
                $response = [
                    'success' => false,
                    'error' => 'User ID not provided'
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

// Instantiate the UserDeleter class and process the request
$userDeleter = new UserDeleter();
$userDeleter->processRequest();
