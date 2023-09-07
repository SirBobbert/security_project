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
    <title>User Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">User Details</h1>

        <!-- Display user details -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Type ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php echo $user_arr['id']; ?>
                    </td>
                    <td>
                        <?php echo $user_arr['email']; ?>
                    </td>
                    <td>
                        <?php echo $user_arr['password']; ?>
                    </td>
                    <td>
                        <?php echo $user_arr['typeID']; ?>
                    </td>
                </tr>
            </tbody>
        </table>

        <a class="btn btn-primary" href="/demo/getUsers">Back</a>
    </div>
</body>

</html>