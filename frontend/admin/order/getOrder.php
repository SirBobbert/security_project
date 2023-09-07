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
    <!-- Display the total price if available -->

    <!-- Create an HTML table to display the orderlines -->
    <h1>Order Details</h1>
    <table>
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

    <a class="btn btn-primary" href="/demo/getOrders">Back</a>

</body>

</html>