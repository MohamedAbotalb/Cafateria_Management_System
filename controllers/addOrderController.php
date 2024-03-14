<?php
session_start();
require_once "../models/db.php";
$db=new db();

$note=$_POST['note'];
if(isset($_POST['room'] )){
    $roomId=$_POST['room'];
}else if(!isset($_POST['room']) && $_POST['sourcePage'] === 'admin' ){
    $customer=$db->select('user',['id'],[$_POST['userID']],true);
    $roomId = $customer['room_id'] ;
}else if(!isset($_POST['room']) && $_POST['sourcePage'] === 'user' ){
    $roomId = $_SESSION['room_id'] ;
}
$invoicePrice=$_POST['invoicePrice'];
if(isset($_POST['userID'])){
    $userId=$_POST['userID'];
}else{
    $userId= $_SESSION["user_id"];
}

$db->insert("orders",["note"=>$note,"room_id"=>$roomId,"total_price"=>$invoicePrice,"user_id"=>$userId]);
$order_id = $db->getConnection()->lastInsertId();
$productDetails = json_decode($_POST['productDetails'], true);

foreach ($productDetails as $product) {
    $productId = $product['product_id'];
    $quantity = $product['quantity'];
    $amount = $product['amount'];
   $db->insert("order_product", ["order_id" => $order_id, "product_id" => $productId, "quantity" => $quantity, "amount" => $amount]);
}

// $_SESSION['order_added'] = true;
// if ($_POST['sourcePage'] === 'admin') {
//     header("location:../views/adminHome.php");
// } else {
//     header("location:../views/userHome.php");
// }
