<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the necessary database and Order class files here
    require_once('api/Class/orders.php');
    require_once('api/config/database.php'); 
    $database = new Database();
    $db = $database->getConnection();
    // Get data from the POST request
    $data = json_decode(file_get_contents("php://input"));

    // Check if all required fields are present
    if (
        isset($data->employee_id) &&
        isset($data->total_amount) &&
        isset($data->payment_status) &&
        isset($data->shipping_address) &&
        isset($data->order_details)
    ) {
        // Create an instance of the Order class
        $order = new Order($db); // Assuming $db is your database connection
        
        // Call the createOrder function and pass the data
        $result = $order->createOrder(
            $data->employee_id,
            $data->total_amount,
            $data->payment_status,
            $data->shipping_address,
            $data->order_details
        );
        
        // Return the result as a JSON response
        echo json_encode($result);
    } else {
        // If required fields are missing, return an error message
        echo json_encode("Missing required fields.");
    }
} else {
    // If it's not a POST request, return an error message
    echo json_encode("Invalid request method.");
}
?>
