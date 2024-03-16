<?php
require_once "db.php";
$db = new DB();
$connection = $db->getConnection();

$getStartDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$getEndDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
$getUserId = isset($_GET['user_id']) ? $_GET['user_id'] : '';

try {
    // Set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Build the query to get all users and their total amounts
    $query = "SELECT user.id, user.name, SUM(orders.total_price) AS total_amount
              FROM user
              INNER JOIN orders ON user.id = orders.user_id";

    // Add conditions based on provided filters
    if ($getUserId != '') {
        $query .= " WHERE user.id = :user_id";
    }

    $query .= " GROUP BY user.id, user.name";

    // Prepare and execute the query
    $stmt = $connection->prepare($query);

    if ($getUserId != '') {
        $stmt->bindValue(':user_id', $getUserId);
    }

    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check if a specific user is clicked
    if (isset($_GET['user_id'])) {
        $selectedUser = $_GET['user_id'];

        // Build the query to get the order details for the selected user
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
        WHERE orders.status = 'done'";

        if ($getStartDate != '' && $getEndDate != '') {
            $query .= " AND (order_date >= :start_date AND order_date <= :end_date)";
        }

        $query .= " AND user.id = :user_id"; 

        $query .= " GROUP BY orders.order_date"; 

        // Prepare and execute the query
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
<!-- <h2>List of Users and Total Amounts</h2> -->
<!-- <ul> -->
    <?php //foreach ($users as $user) : ?>
        <!-- <li> -->
            <!-- <a href="?user_id=<?php //echo $user['id']; ?>"> -->
                <?php //echo $user['name']; ?>
            <!-- </a> -->
            <!-- - Total Amount: <?php //echo $user['total_amount']; ?> -->
        <!-- </li> -->
    <?php //endforeach; ?>
<!-- </ul> -->

<?php /*if (isset($_GET['user_id'])) : ?>
    <!-- Display order details for the selected user -->
    <h2>Order Details</h2>
    <ul>
        <?php foreach ($orders as $order) : ?>
            <li>
                Order Date: <?php echo $order['order_date']; ?>
                - Total Amount: <?php echo $order['total_price']; ?> <!-- Change to 'total_price' -->
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif;*/ ?>
