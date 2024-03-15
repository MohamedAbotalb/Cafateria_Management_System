<?php
// Instantiate the DB class
require_once "../models/db.php";
$db = new DB();

// Fetch products based on the requested page
$rowsPerPage = 3;
$page = isset($_GET["page"]) ? $_GET["page"] : 1;
$start = ($page - 1) * $rowsPerPage;
$products = $db->select1("SELECT p.*, c.name AS category_name FROM product p INNER JOIN category c ON p.category_id = c.id LIMIT $start, $rowsPerPage");

// Output products
foreach ($products as $product) {
    // Output each product as per your HTML structure
    echo "<tr id='productRow{$product['id']}'>
            <td>{$product['name']}</td>
            <td>{$product['price']}</td>
            <td><img src='../public/images/{$product['image']}' alt='Product Image' style='max-width: 50px; max-height: 50px;'></td>
            <td><a class='btn btn-success fs-5'>{$product['available']}</a></td>
            <td class='text-center'>
                <!-- Your action buttons here -->
            </td>
          </tr>";
}
