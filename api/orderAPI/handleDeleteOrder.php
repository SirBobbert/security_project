<?php
// Include necessary files and initialize the database connection
require_once('api/class/orders.php'); // Update the class name and file name
require_once('api/config/database.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the "order_id" parameter is set in the POST data
    if (isset($_POST['order_id'])) {
        // Get the order ID from the POST data
        $order_id = $_POST['order_id'];

        // Initialize the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Create a new Order instance
        $order = new Order($db);

        // Set the order ID to delete
        $order->order_id = $order_id;

        // Attempt to delete the order
        if ($order->deleteOrder($order_id)) {
            // Order deleted successfully, redirect the user to the appropriate page
            header("Location: http://localhost/demo/getOrders");
            exit();
        } else {
            // Order deletion failed, you can handle this case (e.g., display an error message)
            echo "Order could not be deleted.";
        }
    } else {
        // Handle missing "order_id" parameter
        echo "Missing 'order_id' parameter in the request.";
    }
} else {
    // Handle errors or unauthorized access
    echo "Invalid request.";
}


?>