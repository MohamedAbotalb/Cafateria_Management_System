<?php

require_once "../models/db.php";
require_once "../models/allProducts&usersModel.php";

// Check if the form is submitted via POST 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get the form data 
        $productId = $_POST["productId"];
        $productName = $_POST["productName"];
        $productPrice = $_POST["productPrice"];
        $categoryId = $_POST["productCategory"];

        // Instantiate the DB class 
        $db = new DB();
        $db2 = new UsersandProducts();
        // Handle file upload 
        if ($_FILES['productImage']['error'] === UPLOAD_ERR_OK) {
            $tempFile = $_FILES['productImage']['tmp_name'];
            $targetPath = '../public/images/';
            $newFileName = uniqid() . '_' . $_FILES['productImage']['name'];
            // Generate unique file name to avoid conflicts 
            $targetFile = $targetPath . $newFileName;
            if (move_uploaded_file($tempFile, $targetFile)) {
                // File uploaded successfully, update database record with the new image file name
                $updateData['image'] = $newFileName;
            } else { // File upload failed, handle error accordingly 
                throw new Exception('File upload failed');
            }
        }

        // Update product data in the database
        $updateData["name"] = $productName;
        $updateData["price"] = $productPrice;
        $updateData["category_id"] = $categoryId; // Update category ID

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
