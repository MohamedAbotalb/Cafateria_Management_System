<?php
require_once "db.php";
$db = new DB();
$connection = $db->getConnection();

try {
    // Set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get all users and their total amounts
    $query = "SELECT user.id, user.name, SUM(orders.total_price) AS total_amount
              FROM user
              INNER JOIN orders ON user.id = orders.user_id
              GROUP BY user.id, user.name";
    $usersResult = $connection->query($query);
    $users = $usersResult->fetchAll(PDO::FETCH_ASSOC);

    // Check if a specific user is clicked
    if (isset($_GET['user_id'])) {
        $selectedUser = $_GET['user_id'];

        // Get the order dates and amounts for the selected user
        $query = "SELECT orders.order_date, order_product.amount
                  FROM orders
                  INNER JOIN order_product ON orders.id = order_product.order_id
                  WHERE orders.user_id = :user_id";
        $stmt = $connection->prepare($query);
        $stmt->execute([
            'user_id' => $selectedUser
        ]);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Check if date range is submitted
    if (isset($_POST['startDate']) && isset($_POST['endDate'])) {
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];

        // Get users who placed orders within the specified date range
        $query = "SELECT user.id, user.name, SUM(orders.total_price) AS total_amount
                  FROM user
                  INNER JOIN orders ON user.id = orders.user_id
                  WHERE orders.order_date BETWEEN :start_date AND :end_date
                  GROUP BY user.id, user.name";
                  
        $stmt = $connection->prepare($query);
        $stmt->execute([
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}
?>

   