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
    $item->name = $data->name;
    $item->price = $data->price;
    $item->description = $data->description;


    if($item->createProduct()){
        echo 'Employee created successfully.';
    } else{
        echo 'Employee could not be created.';
    }
    ?>