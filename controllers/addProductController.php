<?php
require_once '../models/db.php'; 
session_start();
$db = new DB();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $image = $_FILES['productImage']['name'];
    $target = "../public/images/" . basename($image);

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
            'image' => $image
        ]);

        if (!move_uploaded_file($_FILES['productImage']['tmp_name'], $target)) {
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
