<?php
require_once('api/Class/products.php');
require_once('api/config/database.php');

$database = new Database();
$db = $database->getConnection();
$item = new Product($db);
$item->id = isset($id) ? $id : die();

// Fetch product details using the getSingleProduct() method
$item->getSingleProduct();

// Check if the product exists
if ($item->name != null) {
    // Product details
    $product_name = $item->name;
    $product_price = $item->price;
    $product_description = $item->description;
} else {
    // Handle the case when the product is not found
    $product_name = "Product not found";
    $product_price = "";
    $product_description = "";
}

// Close the PHP tag to start HTML
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Product Details</h1>

        <!-- Display product details -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Product Price</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $product_name; ?></td>
                    <td><?php echo number_format($product_price, 2); ?></td>
                    <td><?php echo $product_description; ?></td>
                </tr>
            </tbody>
        </table>

        <a class="btn btn-primary" href="/demo/getProducts">Back</a>
    </div>
</body>

</html>
