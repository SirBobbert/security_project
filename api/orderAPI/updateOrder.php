<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Include the necessary database and Order class files here
    require_once('api/Class/orders.php');
    require_once('api/config/database.php'); 
    $database = new Database();
    $db = $database->getConnection();
    // Get the order ID from the query string
    $order_id = isset($_GET['order_id']) ? $_GET['order_id'] : null;
    
    if ($order_id !== null) {
        // Get data from the PUT request body
        $data = json_decode(file_get_contents("php://input"));
        
        // Check if all required fields are present in the request body
        if (
            isset($data->employee_id) &&
            isset($data->total_amount) &&
            isset($data->payment_status) &&
            isset($data->shipping_address) &&
            isset($data->order_details)
        ) {
            // Create an instance of the Order class
            $order = new Order($db); // Assuming $db is your database connection
            
            // Call the updateOrder function and pass the data
            $result = $order->updateOrder(
                $order_id,
                $data->employee_id,
                $data->total_amount,
                $data->payment_status,
                $data->shipping_address,
                $data->order_details
            );
            
            // Return the result as a JSON response
            echo json_encode($result);
        } else {
            // If required fields are missing in the request body, return an error message
            echo json_encode("Missing required fields.");
        }
    } else {
        // If order_id is missing, return an error message
        echo json_encode("Missing order_id parameter.");
    }
} else {
    // If it's not a PUT request, return an error message
    echo json_encode("Invalid request method.");
}
?>
