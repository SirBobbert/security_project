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
        <h1>USER HOME</h1>
        <table class="table table-bordered">

            <tbody>
                <tr>
                    <td><a href="/demo/getOrders">Your orders</a></td>
                </tr>
                <tr>
                    <td><a href="/demo/getProducts">All products</a></td>
                </tr>
            </tbody>
        </table>
    </div>




</body>

</html>