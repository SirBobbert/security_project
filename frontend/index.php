<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php

$role = $_SESSION['user_role'] ?? null;


if ($role === 'admin') {
    echo "Logged in as Admin.";
    include 'admin/homepage.php';
} elseif ($role === 'user') {
    echo "Logged in as User.";
    include 'user/homepage.php';
}
?>

<body>
    <div class="container">
        <form action="/demo/logout" method="post">
            <input type="submit" value="Logout" class="btn btn-primary btn-block">
        </form>
    </div>
</body>

</html>