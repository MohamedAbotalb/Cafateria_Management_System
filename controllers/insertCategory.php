<?php

// Include the database connection file
require_once "../models/db.php";

// Check if the form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //delete this check*****
    // Get the form data
    $newCategoryName = trim($_POST["newCategoryName"]);

    // Validate the new category name
    if (empty($newCategoryName)) {
        // If the category name is empty, return an error message
        echo json_encode(['success' => false, 'message' => 'Category name cannot be empty']);
        exit();
    }
    // Check if the category name contains any numeric characters
    if (preg_match('/[0-9]/', $newCategoryName)) {
        // If the category name contains numeric characters, return an error message
        echo json_encode(['success' => false, 'message' => 'Category name cannot contain numbers']);
        exit();
    }
    $db = new DB();

    // Check if the category already exists
    $existingCategory = $db->select("category ", ["name"], [$newCategoryName]);

    // If the category already exists, return an error message
    if ($existingCategory) {
        echo json_encode(['success' => false, 'message' => 'Category already exists']);
        exit();
    }

    // Insert the new category into the database
    $db->insert("category", ["name" => $newCategoryName]);
    $insertedCategory = $db->select("category ", ["name"], [$newCategoryName]);
    // Prepare the response
    $response = [
        'success' => true,
        'message' => 'Category added successfully',
        'insertedCategory' => $insertedCategory
    ];

    // Return the response in JSON format
    echo json_encode($response);
    exit();
}

//  it's not a POST request or there was an error during processing
echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
