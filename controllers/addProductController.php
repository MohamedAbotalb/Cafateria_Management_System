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
    $errors = []; 

    $existingProduct = $db->select('product', ['name'], [$productName], true);
    if ($existingProduct) {
        $_SESSION['errors'] = ["productName" => "Product already exists."];
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
            $_SESSION['errors'] = ["productImage" => "Failed to upload image."];
            header("Location: ../views/addProduct.php");
            exit;
        }

        $_SESSION['success'] = "Product added successfully!";
        header("Location: ../views/addProduct.php");
    } catch (Exception $e) {
        $_SESSION['errors'] = ["general" => "Error adding product: " . $e->getMessage()];
        header("Location: ../views/addProduct.php");
        exit;
    }
} else {
    exit('Invalid request');
}
?>
