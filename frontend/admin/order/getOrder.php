<?php
require_once('api/config/database.php');
require_once('api/class/orderlines.php'); // Replace with the correct path to your orderlines class

// Get the order ID from the URL parameter
$database = new Database();
$db = $database->getConnection();
$orderlines = new Orderline($db); // Replace with the correct class for orderlines
$orderlinesData = $orderlines->getOrderlinesByOrderID($id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <!-- Display the total price if available -->
        <h1 class="mt-4">Order Details</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                   
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orderlinesData)): ?>
                    <?php foreach ($orderlinesData as $orderline): ?>
                        <tr>
                            <td>
                                <?php echo $orderline['product_name']; ?>
                            </td>
                            <td>
                                <?php echo number_format($orderline['product_price'], 2); ?>
                            </td>
                            <td>
                                <?php echo $orderline['quantity']; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No order details found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h2>Total Price:
            <?php echo !empty($orderlinesData) ? $orderlinesData[0]['total_price'] : 'N/A'; ?>
        </h2>

        <?php
        // Check if the user is logged in and their role
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';

        if ($userRole === 'admin') {
            // If logged in as admin, link to /demo/getOrders
            $backLink = '/demo/getOrders';
        } elseif ($userRole === 'user') {
            // If logged in as user, link to /demo/getUserOrders
            $backLink = '/demo/getUserOrders';
        } else {
            // Default link if user role is not set or unknown
            $backLink = '/demo/getOrders'; // You can change this to the appropriate default
        }
        ?>

        <a class="btn btn-primary" href="<?php echo $backLink; ?>">Back</a>
    </div>
</body>

</html>