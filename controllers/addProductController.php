<?php
require_once "../models/db.php";
session_start();

function validateImage($file) {
    if ($file['error'] === UPLOAD_ERR_NO_FILE) {
        return ['valid' => true];
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        return ['valid' => false, 'error' => 'Upload error.']; 
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($file['type'], $allowedTypes)) {
        return ['valid' => false, 'error' => 'Invalid file type.']; 
    }

    if ($file['size'] > 2 * 1024 * 1024) {
        return ['valid' => false, 'error' => 'File too large.']; 
    }

    return ['valid' => true];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new DB();

    $productName = $_POST['productName'];
    $price = $_POST['productPrice'];
    $categoryName = $_POST['productCategory'];
    $productImage = $_FILES['productImage'];

    // Validate data
    $errors = [];
    $imageValidation = validateImage($productImage);
    if (!$imageValidation['valid']) {
        $errors['productImage'] = $imageValidation['error'];
    }

    if (empty($errors)) {
        $existingProduct = $db->select('product', ['name'], [$productName], true);
        if ($existingProduct) {
            $_SESSION['errors'] = ["productName" => "Product already exists."];
            header("Location: ../views/addProduct.php");
            exit;
        }

        $category = $db->select('category', ['name'], [$categoryName], true);
        if (!$category) {
            $_SESSION['errors'] = ["productCategory" => "Category does not exist."];
            header("Location: ../views/addProduct.php");
            exit;
        }
        $categoryId = $category['id'];

        try {
            // Insert product data into the database
            $db->insert('product', [
                'name' => $productName,
                'price' => $price,
                'category_id' => $categoryId,
                'image' => $productImage['name'] 
            ]);

            move_uploaded_file($productImage['tmp_name'], "../public/images/" . $productImage['name']);

            $_SESSION['success'] = "Product added successfully!";
            header("Location: ../views/addProduct.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['errors'] = ["general" => "Error adding product: " . $e->getMessage()];
            header("Location: ../views/addProduct.php");
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors;
        header("Location: ../views/addProduct.php");
        exit;
    }
} else {
    header("Location: ../views/addProduct.php");
    exit;
}
?>
