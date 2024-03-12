<?php

require_once "currentOrdersController.php";

if (isset($_GET['id'])) {
  $orderId = $_GET['id'];
  $orders = new CurrentOrdersController();
  $orders->deliverOrder($orderId);
  header('Location:../views/currentOrders.php');
}
