<?php
// Include necessary files
require_once('api/Class/users.php'); // Use 'users.php' for the User class
require_once('api/config/database.php');

// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    $typeID = $_POST['typeID'];
    // You can add more fields if needed

    // Validate the data (you can add more validation here)

    // Initialize the database connection
    $database = new Database();
    $db = $database->getConnection();

    // Create a new User instance
    $user = new User($db);

    // Set the user data
    $user->email = $email;
    $user->password = $password;
    $user->typeID = $typeID;
    // Set other user attributes here

    // Attempt to create the user
    if ($user->createUser()) {
        // Data inserted successfully
        echo "User created successfully";
        header("Location: http://localhost/demo/getUsers");
        exit();
    } else {
        // Error in inserting data
        echo "User creation failed";
    }
} else {
    // Handle errors or unauthorized access
    echo "Invalid request method";
}
?>
