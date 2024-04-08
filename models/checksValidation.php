<?php
class Checks
{

    public function getUsersWithTotalAmount()
    {
        $query = "SELECT user.id, user.name, SUM(orders.total_price) AS total_amount
                  FROM user
                  INNER JOIN orders ON user.id = orders.user_id 
                  GROUP BY user.id, user.name";
        return $query;
    }

    public function getOrdersByUserId($userId)
    {
        $query = "SELECT * 
                  FROM user 
                  INNER JOIN orders ON user.id = orders.user_id 
                  WHERE orders.status='done' AND user.id=$userId";

        return $query;
    }
    public function getProducts($orderId)
    {
        $query = "SELECT * 
        FROM product 
        INNER JOIN order_product ON product.id = order_product.product_id
        INNER JOIN orders ON orders.id = order_product.order_id where orders.id = $orderId";

        return $query;
    }
}