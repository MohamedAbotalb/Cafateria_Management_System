<?php

require_once "../models/db.php";
require_once "../models/orderModel.php";

class MyOrdersController
{
    private $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function getOrdersByUserId($getStartDate, $getEndDate, $userId)
    {
        $connection = $this->db->getConnection();

        $orderModel = new OrderModel();
        $query = $orderModel->queryOrdersByUserId($getStartDate, $getEndDate, $userId);
        $statement = $connection->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsByOrderId($orderId)
    {
        $connection = $this->db->getConnection();

        $orderModel = new OrderModel();
        $query = $orderModel->queryProductsByOrderId($orderId);
        $statement = $connection->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
