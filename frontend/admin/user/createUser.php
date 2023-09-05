<!DOCTYPE html>
<html>

<head>
    <title>Create User</title>
</head>

<body>
    <form method="post" action="/demo/handleCreateUser">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <label for="typeID">User Type:</label>
        <select name="typeID" id="typeID" required>
            <option value="1">1 - admin</option>
            <option value="2">2 - user</option>
        </select>
        <!-- Add more input fields for other user attributes if needed -->

        <button type="submit">Create User</button>
    </form>
</body>

</html>
