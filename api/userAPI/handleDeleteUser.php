<?php
// Include necessary files and initialize the database connection
require_once('api/Class/users.php');
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

        // Create a new User instance
        $user = new User($db);
        $user->id = $id;

        // Attempt to delete the user
        if ($user->deleteUser()) {
            // User deleted successfully, you can redirect the user to the "getUsers" page
            header("Location: http://localhost/demo/getUsers");
            exit();
        } else {
            // User deletion failed, you can handle this case (e.g., display an error message)
            echo "User could not be deleted.";
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
