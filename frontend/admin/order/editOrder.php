<?php
// Include the necessary database and order class files
require_once('api/Class/orders.php');
require_once('api/Class/OrderLines.php'); // Note the capitalization here
require_once('api/config/database.php');

// Rest of your code...

$order_arr = array(
    "order_id" => "",
    "user_id" => "",
    "order_date" => "",
    "total_amount" => ""
);

if (isset($id)) {
    $database = new Database();
    $db = $database->getConnection();

    $order = new Order($db);
    $order->order_id = $id;

    // Retrieve the order data based on the provided order_id
    if ($order->getOrderById($id)) {
        $order_arr = array(
            "order_id" => $order->order_id,
            "user_id" => $order->user_id,
            "order_date" => $order->order_date,
            "total_amount" => $order->total_amount
        );

        $orderlines = new OrderLine($db);

        // Retrieve associated order lines for this order
        $order_lines = $orderlines->getOrderlinesByOrderID($id);
    } else {
        echo "Order not found.";
    }
} else {
    echo "Order ID not provided.";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Order</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Edit Order</h2>
        <form method="post" action="/demo/handleEditOrder/<?php echo $order_arr['order_id']; ?>">
            <input type="hidden" name="order_id" value="<?php echo $order_arr['order_id']; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Hidden input for id parameter -->

            <div class="form-group">
                <label for="user_id">User ID:</label>
                <p>
                    <?php echo $order_arr['user_id']; ?>
                </p>
            </div>

            <div class="form-group">
                <label for="order_date">Order Date:</label>
                <p>
                    <?php echo $order_arr['order_date']; ?>
                </p>
            </div>

            <div class="form-group">
                <label for="total_amount">Total Amount:</label>
                <p>
                    <?php echo $order_arr['total_amount']; ?>
                </p>
            </div>

            <!-- Rest of your code... -->

            <?php

            echo $id;
            echo $id;
            echo $id;

            $totalOrderPrice = 0; // Initialize total order price
            if (!empty($order_lines)):
                ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Orderline ID</th>
                            <th>Product ID</th>
                            <th>Quantity</th>
                            <th>Product Price</th>
                            <th>Total Price</th>
                            <th>Action</th> <!-- Add a column for actions -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($order_lines as $order_line): ?>
                            <tr>
                                <td>
                                    <?php echo isset($order_line['orderline_id']) ? $order_line['orderline_id'] : ''; ?>
                                </td>
                                <td>
                                    <?php echo isset($order_line['product_id']) ? $order_line['product_id'] : ''; ?>
                                </td>
                                <td>
                                    <form method="post"
                                        action="/demo/updateOrderLine/<?php echo $order_line['orderline_id']; ?>">
                                        <input type="number" name="quantity"
                                            value="<?php echo isset($order_line['quantity']) ? $order_line['quantity'] : ''; ?>">
                                        <input type="submit" value="Update">
                                    </form>
                                </td>
                                <td>
                                    <?php echo isset($order_line['product_price']) ? $order_line['product_price'] : ''; ?>
                                </td>
                                <td>
                                    <?php
                                    if (isset($order_line['product_price']) && isset($order_line['quantity'])) {
                                        $totalPrice = $order_line['product_price'] * $order_line['quantity'];
                                        echo $totalPrice;
                                        $totalOrderPrice += $totalPrice; // Add to total order price
                                    }
                                    ?>
                                </td>
                                <td>
                                    <!-- Modify the form action to include the order ID -->
                                    <form method="post"
                                        action="/demo/handleDeleteOrderline/<?php echo $order_line['orderline_id']; ?>">
                                        <input type="hidden" name="orderline_id"
                                            value="<?php echo isset($order_line['orderline_id']) ? $order_line['orderline_id'] : ''; ?>">
                                        <!-- Add a hidden input for the 'id' parameter -->
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                        <input type="submit" value="Delete">
                                    </form>




                                </td>


                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No order lines found for this order.</p>
            <?php endif; ?>



            <!-- Display total order price at the bottom -->
            <div class="mt-3">
                <h4>Total Order Price:</h4>
                <p>
                    <?php echo $totalOrderPrice; ?>
                </p>
            </div>

            <button type="submit" class="btn btn-primary">Update Order</button>
        </form>

        <a class="btn btn-secondary mt-3" href="/demo/getOrders">Back</a>
    </div>
</body>

</html>