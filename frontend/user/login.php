<?php
session_start();

// Check if an error message is stored in session
if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];
    unset($_SESSION['error']); // Clear the error message
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>
    <?php if (isset($errorMessage)) { echo "<p style='color: red;'>$errorMessage</p>"; } ?>
    <form method="get" action="/demo/user/homeget">
        <label for="email">Email:</label>
        <input type="text" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br><br>

        <input type="submit" value="Login">
    </form>
</body>

</html>
