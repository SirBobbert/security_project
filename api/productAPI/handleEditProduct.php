<?php
// Include necessary files and initialize the database connection
require_once('api/class/products.php');
require_once('api/config/database.php');

// Check if the "_method" parameter is set to "PUT"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated data from the form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Initialize the database connection
    $database = new Database();
    $db = $database->getConnection();

    // Create a new Product instance
    $item = new Product($db);
    $item->id = $id;

    // Update the product data
    $item->name = $name;
    $item->price = $price;
    $item->description = $description;

    // Check if the product was successfully updated
    if ($item->updateProduct()) {
        // Product data updated successfully, redirect the user to the "getProducts" page
        header("Location: http://localhost/demo/getProducts");
        exit();
    } else {
        // Product update failed, you can handle this case (e.g., display an error message)
        echo "Product could not be updated.";
    }

} else {
    // Handle errors or unauthorized access
    echo "Invalid request.";
}
?>