<?php
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php if (isset($errorMessage)) {
        echo "<p style='color: red;'>$errorMessage</p>";
    } ?>
    <div class="container p-5">
        <h2 class="text-center">Login</h2>
        <form method="POST" action="/demo/validate">

            <label for="email" class="form-label">Email:</label>
            <input type="text" name="email" class="form-control mb-2" required>

            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control mb-4" required>

            <input type="submit" value="Login" class="btn btn-primary btn-block">
        </form>
    </div>

</body>

</html>