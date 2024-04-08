<?php

require_once "../models/db.php";
require_once "../models/orderModel.php";

class OrderController
{
  private $db;
  private $connection;
  private $orderModel;

  public function __construct()
  {
    $this->db = DB::getInstance();
    $this->connection = $this->db->getConnection();
    $this->orderModel = new OrderModel();
  }

  private function insertOrderProducts($orderId, $productDetails)
  {
    foreach ($productDetails as $product) {
      $productId = $product['product_id'] ?? '';
      $quantity = $product['quantity'] ?? '';
      $amount = $product['amount'] ?? '';
      $data = ["order_id" => $orderId, "product_id" => $productId, "quantity" => $quantity, "amount" => $amount];
      $this->db->insert("order_product", $data);
    }
  }

  private function insertOrder($note, $roomId, $invoicePrice, $userId)
  {
    $data = ["note" => $note, "room_id" => $roomId, "total_price" => $invoicePrice, "user_id" => $userId];
    $this->db->insert("orders", $data);
  }

  private function getRoomIdForAdmin()
  {
    $customer = $this->db->select('user', ['id'], [$_POST['userID']], true);
    return $customer['room_id'];
  }

  private function getRoomIdForUser()
  {
    return $_SESSION['user']['room_id'];
  }

  private function getUserId()
  {
    return $_POST['userID'] ?? $_SESSION['user']['id'];
  }

  private function redirectToPage($page)
  {
    header("Location: $page");
  }

  private function updateOrderStatus($orderId, $status)
  {
    $updates = ["status" => $status];
    $condition = ["id" => $orderId];
    $this->db->update('orders', $condition, $updates);
  }

  public function addOrder($note, $invoicePrice, $currentPage, $roomId = null, $userId = null, $productDetails = [])
  {
    session_start();

    $roomId = $roomId ?? ($currentPage === 'admin' ? $this->getRoomIdForAdmin() : $this->getRoomIdForUser());
    $userId = $userId ?? $this->getUserId();

    $this->insertOrder($note, $roomId, $invoicePrice, $userId);

    $orderId = $this->connection->lastInsertId();
    $this->insertOrderProducts($orderId, $productDetails);

    $_SESSION['order_added'] = true;
    $redirectLocation = ($currentPage === 'admin') ? "../views/adminHome.php" : "../views/userHome.php";
    header("location: $redirectLocation");
  }

  public function deliverOrder($orderId)
  {
    $this->updateOrderStatus($orderId, "out for delivery");
    $this->redirectToPage("../views/manualOrders.php");
  }

  public function doneOrder($orderId)
  {
    $this->updateOrderStatus($orderId, "done");
  }

  public function cancelOrder($orderId)
  {
    $this->db->delete('orders', ['id'], [$orderId]);
    $this->redirectToPage("../views/myOrders.php");
  }

  public function getCurrentOrders()
  {
    $query = $this->orderModel->queryCurrentOrders();
    $statement = $this->connection->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getOrdersByUserId($getStartDate, $getEndDate, $userId)
  {
    $query = $this->orderModel->queryOrdersByUserId($getStartDate, $getEndDate, $userId);
    $statement = $this->connection->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getProductsByOrderId($orderId)
  {
    $query = $this->orderModel->queryProductsByOrderId($orderId);
    $statement = $this->connection->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }
}

$orderController = new OrderController();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["sourcePage"])) {
  // Handling order addition
  $note = $_POST['note'] ?? '';
  $invoicePrice = $_POST['invoicePrice'] ?? '';
  $currentPage = $_POST['sourcePage'] ?? '';
  $roomId = $_POST['room'] ?? null;
  $userId = $_POST['userID'] ?? null;
  $productDetails = json_decode($_POST['productDetails'] ?? '', true);
  $orderController->addOrder($note, $invoicePrice, $currentPage, $roomId, $userId, $productDetails);
} elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
  // Handling delivery or cancellation
  session_start();
  $orderId = $_GET["id"];
  $action = $_GET["action"] ?? '';

  if ($action === 'deliver') {
    $previousOrderId = isset($_SESSION['delivery_order_id']) ? $_SESSION['delivery_order_id'] : null;

    if ($previousOrderId) {
      $orderController->doneOrder($previousOrderId);
    }

    $orderController->deliverOrder($orderId);
    $_SESSION['delivery_order_id'] = $orderId;
  } elseif ($action === 'cancel') {
    $orderController->cancelOrder($orderId);
  }
}
