<?php
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   header("Access-Control-Allow-Methods: POST");
   header("Access-Control-Max-Age: 3600");
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Include the necessary database and Order class files here
    require_once('api/Class/orders.php');
    require_once('api/config/database.php'); 
    $database = new Database();
    $db = $database->getConnection();
    
    // Get the order ID from the query string
    $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
    
    if ($order_id !== null) {
        // Create an instance of the Order class
        $order = new Order($db); // Assuming $db is your database connection
        
        // Call the getOrderById function and pass the order_id
        $result = $order->getOrderById($order_id);
        
        // Return the result as a JSON response
        echo json_encode($result);
    } else {
        // If order_id is missing, return an error message
        echo json_encode("Missing order_id parameter.");
    }
} else {
    // If it's not a GET request, return an error message
    echo json_encode("Invalid request method.");
}
?>
