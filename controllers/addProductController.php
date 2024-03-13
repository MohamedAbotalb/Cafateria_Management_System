<?php
require_once "db.php";

$db = new DB();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate product name
    // $productName = $_POST["productName"];
    // if (empty($productName)) {

    //     header("Location: addProductForm.php?error=productNameEmpty");
    //     exit();
    // }

    // Check if product name already exists
    $existingProduct = $db->select("product", ["name"], [$productName], true);
    if ($existingProduct) {

        header("Location: ../views/ ?error=productNameExists");
        exit();
    }

    // Validate product price
    // $productPrice = $_POST["productPrice"];
    // if (!is_numeric($productPrice) || $productPrice <= 0) {

         // header("Location: ../views/ ?error=productPriceInvalid");
    //     exit();
    // }

    // Validate product image
    if ($_FILES["productImage"]["error"] !== UPLOAD_ERR_OK) {
 
        header("Location: ../views/ ?error=productImageUploadError");
        exit();
    }

    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxFileSize = 2 * 1024 * 1024; // 2MB

    if (!in_array($_FILES["productImage"]["type"], $allowedTypes) || $_FILES["productImage"]["size"] > $maxFileSize) {

        header("Location: ../views/ ?error=productImageInvalid");
        exit();
    }

    $uploadDir = "../public/images/";
    $uploadFile = $uploadDir . basename($_FILES["productImage"]["name"]);
    if (!move_uploaded_file($_FILES["productImage"]["tmp_name"], $uploadFile)) {

        header("Location: ../views/ ?error=productImageMoveError");
        exit();
    }

    $productData = [
        "name" => $productName,
        "price" => $productPrice,
        "image" => $uploadFile
    ];
    $db->insert("product", $productData);
    // header("Location: ../views/ ?success=productAdded");
    exit();
}

// Handle modal form submission 
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["newCategoryName"])) {
    $newCategoryName = $_POST["newCategoryName"];

    // Check if category name already exists
    $existingCategory = $db->select("category", ["name"], [$newCategoryName], true);
    if ($existingCategory) {
        header("Location: addProduct.php?error=categoryExists");
        exit();
    }

    // Insert new category into the database
    $categoryData = [
        "name" => $newCategoryName
    ];
    $db->insert("category", $categoryData);

    // header("Location: ../views/ ?success=categoryAdded");
    exit();
}

?>