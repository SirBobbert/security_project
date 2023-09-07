<?php
// Initialize the session
session_start();

// Unset cart data (assuming 'cart' is the session variable storing cart data)
unset($_SESSION['cart']);

// Unset all of the other session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to the login page
header("Location: /demo/login");
exit;
?>
