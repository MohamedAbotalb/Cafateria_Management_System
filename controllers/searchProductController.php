<?php

require_once "../models/db.php";
require_once "../models/orderModel.php";

$db = DB::getInstance();
$connection = $db->getConnection();
$orderModel = new OrderModel();
$p = isset($_GET["p"]) ? $_GET["p"] : "";

$result = [];
if (!empty($p)) {
    $query = $orderModel->searchProduct($p);
    $data = $connection->query($query);
    $result = $data->fetchAll(PDO::FETCH_ASSOC);
} else {
    $result = $db->select('product');
}
header('Content-Type: application/json');
echo json_encode($result);
