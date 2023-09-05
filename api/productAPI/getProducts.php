<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    
    
    require_once('api/Class/products.php');
    require_once('api/config/database.php'); 
  
    $database = new Database();
    $db = $database->getConnection();
    $items = new Product($db);
    $stmt = $items->getProducts();
    $itemCount = $stmt->rowCount();

    echo json_encode($itemCount);
    if($itemCount > 0){

        $productArray = array();
        $productArray["body"] = array();
        $productArray["itemCount"] = $itemCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $e = array(
                "id" => $row['id'],
                "name" => $row['name'],
                "price" => $row['price'],
                "description" => $row['description']
            );
            array_push($productArray["body"], $e);
        }
        echo json_encode($productArray);
    }
    else{
        http_response_code(404);
        echo json_encode(
            array("message" => "No record found.")
        );
    }
?>