<?php
require_once '../models/db.php';
session_start();

class ProductController
{
    private $db;

    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function validateImage($file)
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($file['type'], $allowedTypes) || $file['size'] > 2 * 1024 * 1024) {
            return false;
        }
        return true;
    }

    public function addProduct($productName, $price, $categoryName, $productImage)
    {
        $target = "../public/images/" . basename($productImage['name']);
        $fails = [];

        $existingProduct = $this->db->select('product', ['name'], [$productName], true);
        if ($existingProduct) {
            $_SESSION['fails'] = ["productName" => "Product already exists."];
            header("Location: ../views/addProduct.php");
            exit;
        }

        $category = $this->db->select('category', ['name'], [$categoryName], true);
        $categoryId = $category['id'];

        try {
            $this->db->insert('product', [
                'name' => $productName,
                'price' => $price,
                'category_id' => $categoryId,
                'image' => $productImage['name']
            ]);

            if (!move_uploaded_file($productImage['tmp_name'], $target)) {
                $_SESSION['fails'] = ["productImage" => "Failed to upload image."];
                header("Location: ../views/addProduct.php");
                exit;
            }

            $_SESSION['done'] = "Product added successfully!";
            header("Location: ../views/adminProducts.php");
            exit;
        } catch (Exception $e) {
            $_SESSION['fails'] = ["general" => $e->getMessage()];
            header("Location: ../views/addProduct.php");
            exit;
        }
    }
}

$productController = new ProductController();
$productController->addProduct(htmlspecialchars(trim($_POST['productName'])), htmlspecialchars(trim($_POST['productPrice'])), htmlspecialchars(trim($_POST['productCategory'])), $_FILES['productImage']);
