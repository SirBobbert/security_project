<?php
require_once('api/Class/products.php');
require_once('api/config/database.php');

$database = new Database();
$db = $database->getConnection();
$item = new Product($db);
$item->id = isset($id) ? $id : die();

$item->getSingleProduct();
if ($item->name != null) {
    $product_arr = array(
        "id" => $item->id,
        "name" => $item->name,
        "price" => $item->price,
        "description" => $item->description
    );

    http_response_code(200);
    echo json_encode($product_arr);
} else {
    http_response_code(404);
    echo json_encode("Product not found.");
}
?>






<!-- 
<?php
require_once('api/Class/products.php');
require_once('api/config/database.php');

$database = new Database();
$db = $database->getConnection();
$item = new Product($db);
$item->id = isset($id) ? $id : die();

$item->getSingleProduct();
if ($item->name != null) {
    $product_arr = array(
        "id" => $item->id,
        "name" => $item->name,
        "price" => $item->price,
        "description" => $item->description
    );

    http_response_code(200);
    echo json_encode($product_arr);
} else {
    http_response_code(404);
    echo json_encode("Product not found.");
}
?>