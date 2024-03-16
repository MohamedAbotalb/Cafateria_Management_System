<?php
require_once '../models/db.php'; 
session_start();
$db = new DB();

function validateImage($file) {
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    if (!in_array($file['type'], $allowedTypes)) {
        return false;
    }

    if ($file['size'] > 2 * 1024 * 1024) { 
        return false;
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['productImage'];
    $target = "../public/images/" . basename($image['name']);

    $productName = htmlspecialchars(trim($_POST['productName']));
    $price = htmlspecialchars(trim($_POST['productPrice']));
    $categoryName = htmlspecialchars(trim($_POST['productCategory']));
    $fails = []; 

    $existingProduct = $db->select('product', ['name'], [$productName], true);
    if ($existingProduct) {
        $_SESSION['fails'] = ["productName" => "Product already exists."];
        header("Location: ../views/addProduct.php");
        exit;
    }

    $category = $db->select('category', ['name'], [$categoryName], true);
    $categoryId = $category['id'];

    try {
        $db->insert('product', [
            'name' => $productName,
            'price' => $price,
            'category_id' => $categoryId,
            'image' => $image['name']
        ]);

        if (!move_uploaded_file($image['tmp_name'], $target)) {
            $_SESSION['fails'] = ["productImage" => "Failed to upload image."];
            header("Location: ../views/addProduct.php");
            exit;
        }

        $_SESSION['done'] = "Product added successfully!";
        header("Location: ../views/adminProducts.php");
    } catch (Exception $e) {
        $_SESSION['fails'] = ["general" => "Error adding product: " . $e->getMessage()];
        header("Location: ../views/addProduct.php");
        exit;
    }
} else {
    exit('Invalid request');
}
?>
