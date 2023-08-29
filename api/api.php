<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($name)) {
        header('Content-Type: application/json');
        echo json_encode(array('message' => "Hello, $name!"));
        exit();
    }
}
?>