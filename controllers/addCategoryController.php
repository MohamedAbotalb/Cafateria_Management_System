<?php
require_once "../models/db.php";

$db = new DB();

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the category name
    $categoryName = isset($_POST["categoryName"]) ? $_POST["categoryName"] : "";
    $categoryName = trim($categoryName);

    // Check if the category name already exists
    $existingCategory = $db->select("category", ["name"], [$categoryName], true);
    if ($existingCategory) {
        echo json_encode(["success" => false, "message" => "Category already exists."]);
    } else {
        // Insert the new category into the database
        $db->insert("category", ["name" => $categoryName]);
        echo json_encode(["success" => true, "categoryName" => $categoryName]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}

?>