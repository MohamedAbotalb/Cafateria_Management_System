<?php

require_once "../models/db.php";
require_once "../models/currentOrders.php";

class CurrentOrdersController
{
  private $db;

  public function __construct()
  {
    $this->db = new DB();
  }

  public function getCurrentOrders()
  {
    $connection = $this->db->getConnection();

    $currentOrders = new CurrentOrders();
    $query = $currentOrders->queryCurrentOrders();
    $statement = $connection->query($query);

    return $statement->fetchAll(PDO::FETCH_ASSOC);
  }

  public function deliverOrder($id)
  {
    $updates = ["status" => "out for delivery"];
    $condition = ["id" => "$id"];
    $this->db->update('orders', $condition, $updates);
  }

  public function doneOrder($id)
  {
    $updates = ["status" => "done"];
    $condition = ["id" => "$id"];
    $this->db->update('orders', $condition, $updates);
  }
}
