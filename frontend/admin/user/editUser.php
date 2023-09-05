<?php
// Include the necessary database and user class files
require_once('api/Class/users.php');
require_once('api/config/database.php');

// Initialize $user_arr with default values
$user_arr = array(
    "id" => "",
    "email" => "",
    "password" => "",
    "typeID" => ""
);

// Check if the 'id' parameter is provided in the URL
if (isset($id)) {
    // Include the necessary database and user class files
    $database = new Database();
    $db = $database->getConnection();

    // Create a new User instance
    $user = new User($db);
    $user->id = $id;

    // Retrieve the user data based on the provided ID
    $user->getSingleUser();

    // Check if the user exists
    if ($user->email != null) {
        // User data found, update $user_arr with retrieved data
        $user_arr = array(
            "id" => $user->id,
            "email" => $user->email,
            "password" => $user->password,
            "typeID" => $user->typeID
        );
    } else {
        // User not found, handle the error (e.g., display a message)
        echo "User not found.";
    }
} else {
    // 'id' parameter not provided, handle the error (e.g., display a message)
    echo "User ID not provided.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit User</title>
</head>

<body>
    <h2>Edit User</h2>
    <form method="post" action="/demo/handleEditUser/<?php echo $user_arr['id']; ?>">

        <input type="hidden" name="id" value="<?php echo $user_arr['id']; ?>">

        <label for="email">Email:</label>
        <input type="text" id="email" name="email" value="<?php echo $user_arr['email']; ?>"><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $user_arr['password']; ?>"><br>

        <label for="typeID">Type ID:</label>
        <input type="text" id="typeID" name="typeID" value="<?php echo $user_arr['typeID']; ?>"><br>

        <input type="submit" value="Update User">
    </form>

</body>

</html>
