<?php

class MyOrdersModel
{
  private $query;

  public function queryOrdersByUserId($getStartDate, $getEndDate, $userId)
  {
    if ($getStartDate == '' || $getEndDate == '') {
       $this->query = "SELECT * FROM orders
      WHERE user_id = $userId
      ORDER BY order_date DESC ";
    } else {
       $this->query = "SELECT * FROM orders
      WHERE user_id = $userId  AND (order_date >= '$getStartDate' AND order_date <= '$getEndDate')
      ORDER BY order_date DESC ";
    }

    return $this->query;
  }

  public function queryProductsByOrderId($orderId)
  {

    $this->query = "SELECT * FROM order_product oP join product p on p.id = oP.product_id
    WHERE oP.order_id = $orderId";

    return $this->query;
  }
}
