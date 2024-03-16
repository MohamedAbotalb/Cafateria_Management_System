<?php 
require_once "../models/db.php";
require_once "order.php";

$OrderController = new OrderController();

$id=$_GET['id'];

$OrderController->cancelOrder($id);


?>