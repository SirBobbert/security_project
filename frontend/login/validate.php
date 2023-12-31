<?php

require_once('api/class/log.php');


// Replace this with your actual database connection code
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'demo';



$connection = mysqli_connect($host, $username, $password, $database);

$log = new log($connection);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get email and password from the URL parameters
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Prepare the query with placeholders
$query = "SELECT * FROM users WHERE email=?";
$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
    // Bind the parameters
    mysqli_stmt_bind_param($stmt, "s", $email);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) == 1) {
        // User exists
        $user = mysqli_fetch_assoc($result);
        
        // Retrieve the stored hashed password from the user data
        $stored_hashed_password = $user['password'];

        // Verify the provided password against the stored hash
        if (password_verify($password, $stored_hashed_password)) {
            // Password is correct

            // Set the user ID in the session
            $_SESSION['user_id'] = $user['ID']; // Assuming 'id' is the column name for the user ID

            // Check user's type and redirect accordingly
            if ($user['typeID'] == 1) {
                $_SESSION['user_role'] = 'admin';
                header("Location: /demo/index");
            } elseif ($user['typeID'] == 2) {
                $_SESSION['user_role'] = 'user';
                header("Location: /demo/index");
            } else {
                $log->timestamp = date("Y-m-d H:i:s");
                $log->event = "Error";
                $log->source = "User Login";
                $log->message = "Invalid user type.";
                $log->createLog();

                $_SESSION['error'] = "Invalid user type.";
                header("Location: /demo/login");
            }
            exit();
        } else {
            // Password is incorrect
            $log->timestamp = date("Y-m-d H:i:s");
            $log->event = "Error";
            $log->source = "User Login";
            $log->message = "Incorrect password.";
            $log->createLog();

            $_SESSION['error'] = "Incorrect password.";
            header("Location: http://localhost/demo/login");
            exit();
        }
    } else {
        // User doesn't exist
        $log->timestamp = date("Y-m-d H:i:s");
        $log->event = "Error";
        $log->source = "User Login";
        $log->message = "User doesn't exist.";
        $log->createLog();

        $_SESSION['error'] = "User doesn't exist.";
        header("Location: http://localhost/demo/login");
        exit();
    }

    mysqli_stmt_close($stmt);
} else {
    // Statement preparation failed
    $log->timestamp = date("Y-m-d H:i:s");
    $log->event = "Error";
    $log->source = "User Login";
    $log->message = "Statement preparation error: " . mysqli_error($connection);
    $log->createLog();

    echo "Statement preparation error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
