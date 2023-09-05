<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    require_once('api/Class/products.php');
    require_once('api/config/database.php'); 
    
    $database = new Database();
    $db = $database->getConnection();
    
    $item = new Product($db);
    
    $data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode("Missing 'id' field in the request.");
} else {
    $item->id = $data->id;
    
    if ($item->deleteProduct()) {
        echo json_encode("Product deleted.");
    } else {
        echo json_encode("Product could not be deleted");
    }
}
?>