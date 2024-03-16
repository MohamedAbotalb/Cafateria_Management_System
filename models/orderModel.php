<?php

require_once "../models/db.php";

class OrderModel
{
    private $db;
    private $query;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function latestOrder($user)
    {
        $this->query = "SELECT product.image, product.name
            FROM product
            INNER JOIN order_product ON product.id = order_product.product_id
            INNER JOIN orders ON order_product.order_id = orders.id
            INNER JOIN user ON user_id = user.id
            WHERE user.name = '$user'
            AND orders.order_date = (
            SELECT MAX(order_date)
            FROM orders
            WHERE user_id = user.id
            )
            LIMIT 3; ";

        return $this->query;
    }

    public function searchProduct($productName)
    {
        $this->query =  "SELECT * FROM product WHERE name LIKE '$productName%'";
        
        return $this->query;
    }

    public function queryOrdersByUserId($getStartDate, $getEndDate, $userId)
    {
        if ($getStartDate == '' || $getEndDate == '') {
            $this->query =  "SELECT * FROM orders
                WHERE user_id = $userId
                ORDER BY order_date DESC ";
        } else {
            $this->query  = "SELECT * FROM orders
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

    public function queryCurrentOrders()
    {
        $this->query =  "SELECT orders.id AS order_id, 
                orders.order_date, 
                orders.total_price, 
                orders.room_id AS room_num,
                user.name AS username, 
                (SELECT ext FROM room WHERE room.id = orders.room_id) AS ext,
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
                GROUP BY orders.id, orders.order_date, orders.total_price, user.name, user.room_id
                ORDER BY orders.order_date";

        return $this->query;
    }

    
}

?>
