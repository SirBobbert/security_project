<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container col-5 p-3 mt-5 shadow-lg rounded">
        <form method="post" action="/demo/handleRegisterUser">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                    required />
            </div>

            <!-- Hidden input for typeID -->
            <input type="hidden" name="typeID" value="2">

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary btn-block mb-4">Register User</button>

            <!-- Login link -->
            <div class="text-center">
                <p>Already a member? <a href="/demo/login">Login here</a></p>
            </div>
        </form>
    </div>
</body>

</html>