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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <a class="btn btn-primary" href="/demo/getProducts">Back</a>
</body>

</html>