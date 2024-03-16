<?php

require_once "../models/db.php";
require_once "../models/allProducts&usersModel.php";
// session_start();

function validateImage($file)
{
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($file['type'], $allowedTypes)) {
        return false;
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        return false;
    }

    return true;
}
function handleFileUpload($file)
{
    if ($file['error'] === UPLOAD_ERR_OK) {
        // Validate the uploaded image
        if (!validateImage($file)) {
            // Handle image validation error
            throw new Exception('Only PNG, JPEG, and JPG files with size less than 2 MB are allowed.');
        }
        $tempFile = $file['tmp_name'];
        $targetPath = '../public/images/';
        $newFileName = uniqid() . '_' . $file['name'];
        // Generate unique file name to avoid conflicts 
        $targetFile = $targetPath . $newFileName;
        if (move_uploaded_file($tempFile, $targetFile)) {
            // File uploaded successfully, return the new file name
            return $newFileName;
        } else { // File upload failed, handle error accordingly 
            throw new Exception('File upload failed');
        }
    } else {
        // No file uploaded or upload error occurred
        return null;
    }
}
// Function to validate data
function validateData($data)
{
    $data = trim($data);
    $data = addslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted via POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get the form data 
        $productId = validateData($_POST["productId"]);
        $productName = validateData($_POST["productName"]);
        $productPrice = validateData($_POST["productPrice"]);
        $categoryId = validateData($_POST["productCategory"]);

        // Instantiate the DB class 
        $db = new DB();
        $db2 = new UsersandProducts();
        // Handle file upload 
        $uploadedFileName = handleFileUpload($_FILES['productImage']);

        // Update product data in the database
        $updateData["name"] = $productName;
        $updateData["price"] = $productPrice;
        $updateData["category_id"] = $categoryId; // Update category ID
        // If file uploaded successfully, update the database record with the new image file name
        if ($uploadedFileName !== null) {
            $updateData['image'] = $uploadedFileName;
        }
        // Attempt to update the product record
        $db->update("product", ["id" => $productId], $updateData);

        // Fetch the updated product record
        $updateProduct = $db->select("product", ["id"], [$productId]);

        // Prepare the response data
        $response = [
            'success' => true,
            'message' => 'Product updated successfully',
            'updateProduct' => $updateProduct
        ];
    } catch (Exception $e) {
        // Error occurred, handle it
        $response = [
            'success' => false,
            'message' => $e->getMessage(),
        ];
    }

    // Return the response in JSON format
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// If the script reaches this point, it's not a POST request or there was an error during processing
echo json_encode(['success' => false, 'message' => 'Invalid request']);
exit();
