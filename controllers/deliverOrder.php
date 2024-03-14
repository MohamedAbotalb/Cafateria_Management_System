<?php

require_once "currentOrdersController.php";
require_once "doneOrder.php";
session_start();

if (isset($_GET['id'])) {
  $orderId = $_GET['id'];
  $orders = new CurrentOrdersController();
  $orders->deliverOrder($orderId);
  $_SESSION['delivery_order_id'] = $orderId;
  header('Location:../views/currentOrders.php');
}

?>