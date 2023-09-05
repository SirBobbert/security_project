<?php
// Include necessary files and initialize the database connection
require_once('api/class/products.php');
require_once('api/config/database.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the "id" parameter is set in the POST data
    if (isset($_POST['id'])) {
        // Get the ID from the POST data
        $id = $_POST['id'];

        // Initialize the database connection
        $database = new Database();
        $db = $database->getConnection();

        // Create a new Product instance
        $item = new Product($db);
        $item->id = $id;

        // Attempt to delete the product
        if ($item->deleteProduct()) {
            // Product deleted successfully, you can redirect the user to the "getProducts" page
            header("Location: http://localhost/demo/getProducts");
            exit();
        } else {
            // Product deletion failed, you can handle this case (e.g., display an error message)
            echo "Product could not be deleted.";
        }
    } else {
        // Handle missing "id" parameter
        echo "Missing 'id' parameter in the request.";
    }
} else {
    // Handle errors or unauthorized access
    echo "Invalid request.";
}
?>
