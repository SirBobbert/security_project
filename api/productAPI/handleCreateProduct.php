<?php
// Include necessary files
require_once('api/class/products.php');
require_once('api/config/database.php');

// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productDescription = $_POST['productDescription'];

    // Validate the data (you can add more validation here)

    // Initialize the database connection
    $database = new Database();
    $db = $database->getConnection();

    // Create a new Product instance
    $item = new Product($db);

    // Set the product data
    $item->name = $productName;
    $item->price = $productPrice;
    $item->description = $productDescription;

    // Attempt to create the product
    if ($item->createProduct()) {
        // Data inserted successfully
        echo "Product created successfully";
        header("Location: http://localhost/demo/getProducts");
        exit();
    } else {
        // Error in inserting data
        echo "Product creation failed";
    }
} else {
    // Handle errors or unauthorized access
    echo "Invalid request method";
}
?>