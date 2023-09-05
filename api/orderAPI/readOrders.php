<?php
   header("Access-Control-Allow-Origin: *");
   header("Content-Type: application/json; charset=UTF-8");
   
    require_once('api/Class/orders.php');
    require_once('api/config/database.php'); 
$database = new Database();
$db = $database->getConnection();

$order = new Order($db);
$orders = $order->getListOfOrders();

if ($orders->rowCount() > 0) {
    // Fetch the results as an associative array or other preferred format
    $orderList = $orders->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($orderList);
} else {
    echo json_encode("No orders found.");
}

?>