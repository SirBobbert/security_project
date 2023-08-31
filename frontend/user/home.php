<?php
session_start();

// Replace this with your actual database connection code
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'demo';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get email and password from the URL parameters
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Prepare the query with placeholders
$query = "SELECT * FROM users WHERE email=? AND password=?";
$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "ss", $email, $password);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        // User exists
        $user = mysqli_fetch_assoc($result);
        echo "User found: ";
        echo "Email: " . $user['email'] . "<br>";
        echo "Password: " . $user['password'];
        echo "User type: " . $user['typeID'];


        // Check user's type and redirect accordingly
        if ($user['typeID'] == 1) {
            header("Location: /demo/admin/home");
        } elseif ($user['typeID'] == 2) {
            header("Location: /demo/user/home");
        } else {
            $_SESSION['error'] = "Invalid user type.";
            header("Location: http://localhost/demo/login");
        }
        exit();




    } else {
        // User doesn't exist
        $_SESSION['error'] = "User doesn't exist.";
        header("Location: http://localhost/demo/login");
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    // Statement preparation failed
    echo "Statement preparation error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>