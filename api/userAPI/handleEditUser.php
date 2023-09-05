<?php
// Include necessary files and initialize the database connection
require_once('api/Class/users.php'); // Use 'users.php' for the User class
require_once('api/config/database.php');

// Check if the "_method" parameter is set to "PUT"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the updated data from the form
    $id = $_POST['id'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $typeID = $_POST['typeID']; // Add any other fields you want to update

    // Initialize the database connection
    $database = new Database();
    $db = $database->getConnection();

    // Create a new User instance
    $user = new User($db);
    $user->id = $id;

    // Update the user data
    $user->email = $email;
    $user->password = $password;
    $user->typeID = $typeID;

    // Check if the user was successfully updated
    if ($user->updateUser()) {
        // User data updated successfully, redirect the user to a user details page
        header("Location: http://localhost/demo/getUsers"); // Redirect to the user details page
        exit();
    } else {
        // User update failed, you can handle this case (e.g., display an error message)
        echo "User could not be updated.";
    }
} else {
    // Handle errors or unauthorized access
    echo "Invalid request.";
}
?>
