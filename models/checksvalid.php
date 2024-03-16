<?php

class Checks
{
  private $query;

  public function queryChecksOrders()
  {

$this->query = "
    SELECT orders.id AS order_id, 
           orders.order_date, 
           orders.total_price, 
           user.name AS username, 
           JSON_ARRAYAGG(
               JSON_OBJECT(
                   'name', product.name,
                   'image', product.image,
                   'price', product.price,
                   'quantity', order_product.quantity
               )
           ) AS products
    FROM orders
    JOIN user ON user.id = orders.user_id
    JOIN order_product ON orders.id = order_product.order_id 
    JOIN product ON product.id = order_product.product_id 
    WHERE orders.status = 'processing' 
    GROUP BY orders.id, orders.order_date, orders.total_price, user.name
    ORDER BY orders.order_date;
";
return $this->query;
  }
}
