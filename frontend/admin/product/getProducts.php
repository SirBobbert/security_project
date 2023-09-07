<?php
// Start the session to access session variables

// Check if the user_role session variable is set
$role = $_SESSION['user_role'] ?? null;

require_once('api/Class/products.php');
require_once('api/config/database.php');

// Assuming you have the user's role stored in the $role variable
$userRole = $role;

$database = new Database();
$db = $database->getConnection();
$items = new Product($db);
$stmt = $items->getProducts();
$itemCount = $stmt->rowCount();

if ($itemCount > 0) {

    $productArray = array();
    $productArray["body"] = array();
    $productArray["itemCount"] = $itemCount;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $e = array(
            "id" => $row['id'],
            "name" => $row['name'],
            "price" => $row['price'],
            "description" => $row['description']
        );
        array_push($productArray["body"], $e);
    }
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>All products</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1>All products</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productArray["body"] as $post): ?>
                    <tr>
                        <td>
                            <?php echo isset($post['id']) ? $post['id'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($post['name']) ? $post['name'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($post['price']) ? $post['price'] : ''; ?>
                        </td>
                        <td>
                            <?php echo isset($post['description']) ? $post['description'] : ''; ?>
                        </td>
                        <td><a href="/demo/getProduct/<?php echo isset($post['id']) ? $post['id'] : ''; ?>">See more</a>
                        </td>

                        <?php if ($userRole === "admin"): ?>
                            <td><a href="/demo/editProduct/<?php echo isset($post['id']) ? $post['id'] : ''; ?>">Edit
                                    product</a></td>
                            <td>
                                <form method="post"
                                    action="/demo/handleDeleteProduct/<?php echo isset($post['id']) ? $post['id'] : ''; ?>">
                                    <input type="hidden" name="id" value="<?php echo isset($post['id']) ? $post['id'] : ''; ?>">
                                    <input type="submit" value="Delete product">
                                </form>
                            </td>
                        <?php endif; ?>

                        <?php if ($userRole === "user"): ?>
                            <td>
                                <form method="post" action="/demo/handleAddToCart">
                                    <input type="hidden" name="id" value="<?php echo isset($post['id']) ? $post['id'] : ''; ?>">
                                    <input type="submit" value="Add to cart">
                                </form>
                            </td>
                        <?php endif; ?>

                    </tr>
                <?php endforeach; ?>

            </tbody>
        </table>

        <a class="btn btn-primary" href="/demo/index">Back</a>

        <?php if ($userRole === "admin"): ?>
            <a class="btn btn-light" href="/demo/createProduct">
                Create product
            </a>
        <?php endif; ?>
    </div>

</body>

</html>

<!-- Add this section to display the shopping cart -->
<?php if ($userRole === "user"): ?>

    <div class="card mt-5">
        <div class="card-header">
            <h2 class="card-title">Shopping Cart</h2>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <?php
                // Check if the shopping cart session variable exists
                if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                    foreach ($_SESSION['cart'] as $productId => $quantity) {
                        // Retrieve and display product details here based on $productId
                        // You can query your database to get product information.
                        echo "<li class='list-group-item'>Product ID: $productId - Quantity: $quantity";

                        // Add a form to remove the product from the cart
                        echo "<form method='post' action='/demo/removeFromCart' class='float-right'>";
                        echo "<input type='hidden' name='remove_id' value='$productId'>";
                        echo "<button type='submit' class='btn btn-danger btn-sm'>Remove</button>";
                        echo "</form>";

                        echo "</li>";
                    }

                    // Add a form for Confirm Purchase
                    echo "<li class='list-group-item'>";
                    echo "<form method='post' action='/demo/confirm'>";
                    echo "<input type='hidden' name='user_id' value='" . (isset($post['id']) ? $post['id'] : '') . "'>";
                    echo "<button type='submit' name='confirm_purchase' class='btn btn-success'>Confirm Purchase</button>";
                    echo "</form>";
                    echo "</li>";
                } else {
                    echo "<li class='list-group-item'>Your shopping cart is empty.</li>";
                }
                ?>
            </ul>
        </div>
    </div>

<?php endif; ?>