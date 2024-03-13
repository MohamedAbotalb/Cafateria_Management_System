<?php

require_once "../models/db.php"; // Adjust the path as needed to include the DB class

// Function to validate and sanitize input
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check if a file is an image and meets the size requirements
function isImageValid($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxSize = 2 * 1024 * 1024; // 2MB
    $isImage = in_array($file['type'], $allowedTypes);
    $isSizeValid = $file['size'] <= $maxSize;
    return $isImage && $isSizeValid;
}

// Initialize DB connection
$db = new DB();

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validating and sanitizing form input
    $productName = sanitizeInput($_POST["productName"]);
    $productPrice = filter_var($_POST["productPrice"], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $productCategory = sanitizeInput($_POST["productCategory"]);
    $productImage = $_FILES["productImage"];

    // Check if product name already exists
    $existingProduct = $db->select("product", ["name"], [$productName], true);
    if ($existingProduct) {
        echo "<script>alert('Product name already exists.'); window.location.href='../views/addProduct.php';</script>";
    } elseif (isImageValid($productImage)) {
        // Prepare image for upload
        $imageFileName = uniqid() . "_" . basename($productImage["name"]);
        $imagePath = "../public/images/" . $imageFileName;
        if (move_uploaded_file($productImage["tmp_name"], $imagePath)) {
            // Get the category ID for the selected category name
            $category = $db->select("category", ["id"], ["name" => $productCategory], true);
            if ($category) {
                // Inserting product details into the database
                $db->insert("product", [
                    "name" => $productName,
                    "price" => $productPrice,
                    "image" => $imagePath
                ]);
                echo "<script>alert('Product added successfully!'); window.location.href='../views/addProduct.php';</script>";
            } else {
                echo "<script>alert('Selected category does not exist.'); window.location.href='../views/addProduct.php';</script>";
            }
        } else {
            echo "<script>alert('Failed to upload image.'); window.location.href='../views/addProduct.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid image type or size (Max size: 2MB, Allowed types: JPG, PNG).'); window.location.href='../views/addProduct.php';</script>";
    }
}
?>
