<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
    <h2>Welcome</h2>
    <?php
    // Replace this with your actual database connection code
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'demo';

    $connection = mysqli_connect($host, $username, $password, $database);

    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $email = "bobbert@test.dk"; // Replace with the actual email
    $password = "1234"; // Replace with the actual password

    // Prepare the query with placeholders
    $query = "SELECT * FROM users WHERE email=? AND password=?";
    $stmt = mysqli_prepare($connection, $query);

    if ($stmt) {
        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ss", $email, $password);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) == 1) {
            // User exists
            $user = mysqli_fetch_assoc($result);
            echo "User found: ";
            echo "Email: " . $user['email'] . "<br>";
            echo "Password: " . $user['password'];
            echo "User type: " . $user['typeID'];
        } else {
            // User doesn't exist
            echo "User does not exist.";
        }

        mysqli_stmt_close($stmt);
    } else {
        // Statement preparation failed
        echo "Statement preparation error: " . mysqli_error($connection);
    }

    mysqli_close($connection);
    ?>
</body>
</html>
