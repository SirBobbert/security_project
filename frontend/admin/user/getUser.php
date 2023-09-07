<?php
require_once('api/Class/users.php'); // Use 'users.php' for the User class
require_once('api/config/database.php');

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$user->id = isset($id) ? $id : die();

$user->getSingleUser();
if ($user->email != null) {
    $user_arr = array(
        "id" => $user->id,
        "email" => $user->email,
        "password" => $user->password,
        "typeID" => $user->typeID
    );

    http_response_code(200);
    echo json_encode($user_arr);
} else {
    http_response_code(404);
    echo json_encode("User not found.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <a class="btn btn-primary" href="/demo/getUsers">Back</a>
</body>

</html>