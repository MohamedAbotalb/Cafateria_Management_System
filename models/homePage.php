<?php
class HomePage
{
    private $query;
    public function Innerjoin()
    {
        $this->query = "SELECT product.image, product.name
        FROM product
        INNER JOIN order_product ON product.id = order_product.product_id
        INNER JOIN orders ON order_product.order_id = orders.id
        INNER JOIN user ON user_id = user.id
        WHERE user.name = 'doha'
        AND orders.order_date = (
        SELECT MAX(order_date)
        FROM orders
        WHERE user_id = user.id
         )
        LIMIT 3; ";
        return $this->query;
    }
}
