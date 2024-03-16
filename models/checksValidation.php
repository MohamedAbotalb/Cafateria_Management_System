<?php
require_once "db.php";
$db = new DB();
$connection = $db->getConnection();

$getStartDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$getEndDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
$getUserId = isset($_GET['user_id']) ? $_GET['user_id'] : '';

try {
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT user.id, user.name, SUM(orders.total_price) AS total_amount
              FROM user
              INNER JOIN orders ON user.id = orders.user_id";

    $query .= " GROUP BY user.id, user.name";

    $stmt = $connection->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['user_id'])) {
        $selectedUser = $_GET['user_id'];

        $query = "
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
        WHERE orders.status = 'done'
        AND user.id = :user_id";

        if ($getStartDate != '' && $getEndDate != '') {
            $query .= " AND (orders.order_date >= :start_date AND orders.order_date <= :end_date)";
        }

        $query .= " GROUP BY orders.id, orders.order_date, orders.total_price, user.name";

        $stmt = $connection->prepare($query);
        $stmt->bindValue(':user_id', $selectedUser);

        if ($getStartDate != '' && $getEndDate != '') {
            $stmt->bindValue(':start_date', $getStartDate);
            $stmt->bindValue(':end_date', $getEndDate);
        }

        $stmt->execute();
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>

<!-- Display list of users and their total amounts -->
<!-- <h2 class="text-center">List of Users and Total Amounts</h2>
<div class="container">
    <table class="table text-center">
        <thead>
            <th>Name</th>
            <th>Total Amount</th>
        </thead>
        <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <td><a href="?user_id=<?php echo $user['id']; ?>&startDate=<?php echo $getStartDate; ?>&endDate=<?php echo $getEndDate; ?>">
                    <span>+ </span><?php echo $user['name']; ?>
                </a></td>
                <td><?php echo $user['total_amount']; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div> -->




<!-- <div class="container">
    <table class="table text-center">
        <thead>
            <th>Name</th>
            <th>Total Amount</th>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td>
                        <a href="?user_id=<?php echo $user['id']; ?>&startDate=<?php echo $getStartDate; ?>&endDate=<?php echo $getEndDate; ?>">
                            <span>+ </span><?php echo $user['name']; ?>
                        </a>
                    </td>
                    <td><?php echo $user['total_amount']; ?></td>
                </tr>
                <?php if (isset($_GET['user_id']) && $_GET['user_id'] == $user['id']) : ?>
                    <tr>
                        <td colspan="2">
                            <div class="products-container">
                                <h3>Products</h3>
                                <ul>
                                    <?php foreach ($orders as $order) : ?>
                                        <?php if ($order['user_id'] == $user['id']) : ?>
                                            <li>
                                                <span><?php echo $order['order_date']; ?></span>
                                                <ul>
                                                    <?php $products = json_decode($order['products'], true); ?>
                                                    <?php foreach ($products as $product) : ?>
                                                        <li><?php echo $product['name']; ?></li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div> -->