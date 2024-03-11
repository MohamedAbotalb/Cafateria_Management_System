<?php

require_once "../models/db.php";
require_once "../models/currentOrders.php";

class CurrentOrdersController
{
  private $orders = array();

  public function getCurrentOrders()
  {
    $db = new DB();
    $connection = $db->getConnection();

    $currentOrders = new CurrentOrders();
    $query = $currentOrders->queryCurrentOrders();
    $statement = $connection->query($query);

    $this->orders = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $this->orders;
  }
}
