<?php
$host = 'localhost';
$username = 'root'; // Change this to your MySQL username
$password = ''; // Change this to your MySQL password
$database = 'demo';

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    echo "ayo";
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully to the database!";
mysqli_close($conn);
?>