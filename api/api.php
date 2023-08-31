<?php
// Replace these with your actual database connection details
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'demo';

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Email and password to insert
$email = 'test@test.dk';
$password = '1234';

// Hash the password using crypt() with a salt
$salt = uniqid(mt_rand(), true); // Generate a random salt
$hashedPassword = crypt($password, '$2a$12$' . $salt);

// Insert the user into the database
$query = "INSERT INTO users (email, password) VALUES (?, ?)";
$stmt = mysqli_prepare($connection, $query);

if ($stmt) {
    // Bind parameters and execute the statement
    mysqli_stmt_bind_param($stmt, "ss", $email, $hashedPassword);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "User inserted successfully.";
    } else {
        echo "User insertion failed: " . mysqli_error($connection);
    }

    mysqli_stmt_close($stmt);
} else {
    echo "Statement preparation error: " . mysqli_error($connection);
}

mysqli_close($connection);
?>
