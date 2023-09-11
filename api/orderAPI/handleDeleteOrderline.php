<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the "orderline_id" parameter is set in the POST data
    if (isset($_POST['orderline_id']) && isset($_POST['id'])) {
        // Get the order line ID and order ID from the POST data
        $orderline_id = $_POST['orderline_id'];
        $order_id = $_POST['id'];

        // Debug: Output the received orderline_id and order_id for testing
        echo "Received orderline_id: " . $orderline_id;
        echo "Received order_id: " . $order_id;

        // Initialize the database connection
        require_once('api/config/database.php'); // Adjust the path as needed
        $database = new Database();
        $db = $database->getConnection();

        // Create a new OrderLine instance
        require_once('api/Class/OrderLines.php'); // Adjust the path as needed
        $orderline = new OrderLine($db); // Update the class name

        // Set the order line ID to delete
        $orderline->orderline_id = $orderline_id;

        // Get the price of the deleted order line
        $deletedOrderLinePrice = $orderline->getOrderLinePrice($orderline_id);

        // Attempt to delete the order line
        if ($orderline->deleteOrderLine($orderline_id)) {
            // Update the total_amount in the Orders table
            require_once('api/Class/orders.php');
            $order = new Order($db);
            $currentTotalAmount = $order->getTotalAmount($order_id);
            $newTotalAmount = $currentTotalAmount - $deletedOrderLinePrice;
            if ($order->updateTotalAmount($order_id, $newTotalAmount)) {
                // Order line deleted successfully, redirect the user to the appropriate page
                header("Location: http://localhost/demo/editOrder/" . $order_id); // Update the URL accordingly
                exit();
            } else {
                // Handle total_amount update failure
                echo "Total amount could not be updated.";
            }
        } else {
            // Order line deletion failed, you can handle this case (e.g., display an error message)
            echo "Order line could not be deleted.";
        }
    } else {
        // Handle missing "orderline_id" or "id" parameter
        echo "Missing 'orderline_id' or 'id' parameter in the request.";
    }
} else {
    // Handle errors or unauthorized access
    echo "Invalid request.";
}
?>
