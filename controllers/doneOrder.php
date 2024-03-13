<?php

require_once "currentOrdersController.php";
session_start();

if (isset($_SESSION['delivery_order_id'])) {
  $orderId = $_SESSION['delivery_order_id'];
  $orders = new CurrentOrdersController();
  $orders->doneOrder($orderId);
  unset($_SESSION['delivery_order_id']);
}
