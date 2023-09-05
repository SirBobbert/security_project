<!DOCTYPE html>
<html>

<head>
    <title>All Users</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    require_once('api/Class/users.php');
    require_once('api/config/database.php');

    $database = new Database();
    $db = $database->getConnection();
    $users = new User($db);
    $stmt = $users->getUsers();
    $userCount = $stmt->rowCount();

    if ($userCount > 0) {
        $userArray = array();
        $userArray["body"] = array();
        $userArray["userCount"] = $userCount;
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = array(
                "id" => $row['id'],
                "email" => $row['email'],
                "password" => $row['password'],
                "typeID" => $row['typeID']
            );
            array_push($userArray["body"], $user);
        }
    } else {
        http_response_code(404);
        echo json_encode(
            array("message" => "No users found.")
        );
    }
    ?>

    <div class="container">
        <h1>All Users</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Type ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($userArray["body"] as $user): ?>
                    <tr>
                        <td>
                            <?php echo isset($user['id']) ? $user['id'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($user['email']) ? $user['email'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($user['password']) ? $user['password'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($user['typeID']) ? $user['typeID'] : ''; ?>
                        </td>
                        <!-- Add more columns if needed -->

                        <!-- Add links or actions for each user -->
                        <td><a href="/demo/getUser/<?php echo isset($user['id']) ? $user['id'] : ''; ?>">See more</a>
                        </td>
                        <td><a href="/demo/editUser/<?php echo isset($user['id']) ? $user['id'] : ''; ?>">Edit User</a>
                        </td>
                        <td>
                            <form method="post"
                                action="/demo/handleDeleteUser/<?php echo isset($user['id']) ? $user['id'] : ''; ?>">
                                <input type="hidden" name="id" value="<?php echo isset($user['id']) ? $user['id'] : ''; ?>">
                                <input type="submit" value="Delete User">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a class="btn btn-light" href="/demo/createUser">
            Create User
        </a>
    </div>
</body>

</html>
