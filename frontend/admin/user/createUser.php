<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
</head>

<body>
    <form method="post" action="/demo/handleCreateUser">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="typeID" placeholder="Type ID" required>
        <!-- Add more input fields for other user attributes if needed -->

        <button type="submit">Create User</button>
    </form>
</body>

</html>
