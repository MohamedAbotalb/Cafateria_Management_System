<?php

require_once "../models/db.php";
require_once "../models/orderModel.php";

class OrderController
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function addOrder($note, $invoicePrice, $currentPage, $roomId, $userId, $productDetails)
    {
        session_start();
        if (!$roomId) {
            $roomId = $currentPage === 'admin' ? $this->getRoomIdForAdmin() : $this->getRoomIdForUser();
        }

        if (!$userId) {
            $userId = $this->getUserId();
        }

        $this->db->insert("orders", ["note" => $note, "room_id" => $roomId, "total_price" => $invoicePrice, "user_id" => $userId]);
        $orderId = $this->db->getConnection()->lastInsertId();

        foreach ($productDetails as $product) {
            $productId = $product['product_id'] ?? '';
            $quantity = $product['quantity'] ?? '';
            $amount = $product['amount'] ?? '';
            $this->db->insert("order_product", ["order_id" => $orderId, "product_id" => $productId, "quantity" => $quantity, "amount" => $amount]);
        }

        $_SESSION['order_added'] = true;
        $redirectLocation = ($currentPage === 'admin') ? "../views/adminHome.php" : "../views/userHome.php";
        header("location: $redirectLocation");
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
        return isset ($_POST['userID']) ? $_POST['userID'] : $_SESSION['user']['id'];
    }

    public function deleteOrder($orderId)
    {
        $this->db->delete('orders', ['id'], [$orderId]);
        header("Location:../views/myOrders.php");
    }

    public function deliverOrder($orderId)
    {
        $this->updateOrderStatus($orderId, "out for delivery");
    }

    public function doneOrder($orderId)
    {
        $this->updateOrderStatus($orderId, "done");
    }

    private function updateOrderStatus($orderId, $status)
    {
        $updates = ["status" => $status];
        $condition = ["id" => $orderId];
        $this->db->update('orders', $condition, $updates);
    }

    public function getCurrentOrders()
    {
        $orderModel = new OrderModel();
        $query = $orderModel->queryCurrentOrders();
        $statement = $this->db->getConnection()->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrdersByUserId($getStartDate, $getEndDate, $userId)
    {

        $orderModel = new OrderModel();
        $query = $orderModel->queryOrdersByUserId($getStartDate, $getEndDate, $userId);
        $statement = $this->db->getConnection()->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsByOrderId($orderId)
    {
        $orderModel = new OrderModel();
        $query = $orderModel->queryProductsByOrderId($orderId);
        $statement = $this->db->getConnection()->query($query);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}

$orderController = new OrderController();

if (isset ($_POST["sourcePage"])) {
    $note = $_POST['note'] ?? '';
    $invoicePrice = $_POST['invoicePrice'] ?? '';
    $currentPage = $_POST['sourcePage'] ?? '';
    $roomId = $_POST['room'] ?? null;
    $userId = $_POST['userID'] ?? null;
    $productDetails = json_decode($_POST['productDetails'] ?? '', true);
    $orderController->addOrder($note, $invoicePrice, $currentPage, $roomId, $userId, $productDetails);
} else if (isset ($_GET["id"])) {
    $orderController->deliverOrder($_GET["id"]);
    header('Location:../views/manualOrders.php');

}

?>