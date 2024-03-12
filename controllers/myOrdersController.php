<?php

require_once "../models/db.php";
require_once "../models/myOrdersModel.php";

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

        $myOrderModel = new MyOrdersModel();
        $query = $myOrderModel->queryOrdersByUserId($getStartDate, $getEndDate, $userId);
        $statement = $connection->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductsByOrderId($orderId)
    {
        $connection = $this->db->getConnection();

        $myOrderModel = new MyOrdersModel();
        $query = $myOrderModel->queryProductsByOrderId($orderId);
        $statement = $connection->query($query);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
