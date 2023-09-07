<?php
// Check if the user_role session variable is set
$role = $_SESSION['user_role'] ?? null;

require_once('api/class/orders.php'); // Replace with the correct path to your orders class
require_once('api/config/database.php'); // Replace with the correct path to your database configuration

// Assuming you have the user's role stored in the $role variable
$userRole = $role;

$database = new Database();
$db = $database->getConnection();
$orders = new Order($db); // Replace with the correct class for orders
$stmt = $orders->getOrders(); // Replace with the correct method to retrieve orders
$orderCount = $stmt->rowCount();

if ($orderCount > 0) {

    $orderArray = array();
    $orderArray["body"] = array();
    $orderArray["orderCount"] = $orderCount;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $e = array(
            "order_id" => $row['order_id'],
            // Replace with the correct column names
            "user_id" => $row['user_id'],
            // Replace with the correct column names
            "order_date" => $row['order_date'],
            // Replace with the correct column names
            "total_amount" => $row['total_amount'] // Replace with the correct column names
        );
        array_push($orderArray["body"], $e);
    }
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>All Orders</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>All Orders</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Order Date</th>
                    <th>Total Amount</th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php foreach ($orderArray["body"] as $order): ?>
                    <tr>
                        <td>
                            <?php echo isset($order['order_id']) ? $order['order_id'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($order['user_id']) ? $order['user_id'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($order['order_date']) ? $order['order_date'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($order['total_amount']) ? $order['total_amount'] : ''; ?>
                        </td>



                        <td>
                            <a href="/demo/getOrder/<?php echo isset($order['order_id']) ? $order['order_id'] : ''; ?>">See order</a>
                        </td>

                        <td><a href="/demo/editProduct/<?php echo isset($post['id']) ? $post['id'] : ''; ?>">Edit
                                order</a></td>
                        <td>
                            <form method="post"
                                action="/demo/handleDeleteProduct/<?php echo isset($post['id']) ? $post['id'] : ''; ?>">
                                <input type="hidden" name="id" value="<?php echo isset($post['id']) ? $post['id'] : ''; ?>">
                                <input type="submit" value="Delete order">
                            </form>
                        </td>



                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="/demo/index">Back</a>
    </div>
</body>

</html>