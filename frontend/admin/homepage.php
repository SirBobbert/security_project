<!DOCTYPE html>
<html>

<head>
    <title>All Users</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<?php
echo "User Role: " . $_SESSION['user_role'];
?>

<body>

    <div class="container">
        <h1>ADMIN HOME</h1>
        <table class="table table-bordered">

            <tbody>
                <tr>
                    <td><a href="/demo/getOrders">All orders</a></td>
                </tr>
                <tr>
                    <td><a href="/demo/getProducts">All products</a></td>
                </tr>
                <tr>
                    <td><a href="/demo/getUsers">All users</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="container">
        <form action="/demo/logout" method="post">
            <input type="submit" value="Logout" class="btn btn-primary btn-block">
        </form>
    </div>



</body>

</html>