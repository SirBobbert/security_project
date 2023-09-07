<?php
// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect or handle the case when the user is not logged in
    header("Location: /demo/login");
    exit();
}

require_once('api/class/orders.php'); // Replace with the correct path to your orders class
require_once('api/config/database.php'); // Replace with the correct path to your database configuration

$userID = $_SESSION['user_id'];

$database = new Database();
$db = $database->getConnection();
$orders = new Order($db); // Replace with the correct class for orders

$stmt = $orders->getOrdersByUserID($userID); // Replace with the correct method to retrieve orders for a specific user
$orderCount = $stmt->rowCount();

$orderArray = array(); // Initialize as an empty array

if ($orderCount > 0) {
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $e = array(
            "order_id" => $row['order_id'],
            // Replace with the correct column names
            "order_date" => $row['order_date'],
            // Replace with the correct column names
            "total_amount" => $row['total_amount'] // Replace with the correct column names
        );
        array_push($orderArray, $e);
    }
}

// HTML template to display orders
?>


<!DOCTYPE html>
<html>

<head>
    <title>Your Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Your Orders</h1>
        <?php if ($orderCount > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderArray as $order): ?>
                        <tr>
                            <td>
                                <?php echo $order['order_id']; ?>
                            </td>
                            <td>
                                <?php echo $order['order_date']; ?>
                            </td>
                            <td>
                                <?php echo $order['total_amount']; ?>
                            </td>
                            <td>
                                <a class="btn btn-primary"
                                    href="/demo/getOrder/<?php echo isset($order['order_id']) ? $order['order_id'] : ''; ?>">See
                                    order</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        <?php else: ?>
            <p>No orders found.</p>
        <?php endif; ?>

        <a class="btn btn-primary" href="/demo/user/home">Back</a>

    </div>
</body>

</html>