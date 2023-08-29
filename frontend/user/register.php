<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container col-5 p-3 mt-5 shadow-lg rounded">
        <form>
            <!-- Email input -->
            <div class="form-outline mb-4">
                <input type="email" id="email" class="form-control" placeholder="Email" />
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control" placeholder="Password" />
            </div>

             <!-- Password validation -->
             <div class="form-outline mb-4">
                <input type="password" id="password" class="form-control" placeholder="Password" />
            </div>


            <!-- Submit button -->
            <button type="button" class="btn btn-primary btn-block mb-4">Register</button>

            <!-- Register buttons -->
            <div class="text-center">
                <p>Already a member? <a href="/demo/login">
                        Login here
                    </a></p>
            </div>

        </form>
    </div>
</body>

</html>