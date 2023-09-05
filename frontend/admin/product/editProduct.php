<?php
// Include the necessary database and product class files
require_once('api/Class/products.php');
require_once('api/config/database.php');

// Initialize $product_arr with default values
$product_arr = array(
    "id" => "",
    "name" => "",
    "price" => "",
    "description" => ""
);

// Check if the 'id' parameter is provided in the URL
if (isset($id)) {
    // Include the necessary database and product class files
    $database = new Database();
    $db = $database->getConnection();

    // Create a new Product instance
    $item = new Product($db);
    $item->id = $id;

    // Retrieve the product data based on the provided ID
    $item->getSingleProduct();

    // Check if the product exists
    if ($item->name != null) {
        // Product data found, update $product_arr with retrieved data
        $product_arr = array(
            "id" => $item->id,
            "name" => $item->name,
            "price" => $item->price,
            "description" => $item->description
        );
    } else {
        // Product not found, handle the error (e.g., display a message)
        echo "Product not found.";
    }
} else {
    // 'id' parameter not provided, handle the error (e.g., display a message)
    echo "Product ID not provided.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Product</title>
</head>

<body>
    <h2>Edit Product</h2>
    <form method="post" action="/demo/handleEditProduct/<?php echo $product_arr['id']; ?>">

        <input type="hidden" name="id" value="<?php echo $product_arr['id']; ?>">

        <label for="name">Product Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $product_arr['name']; ?>"><br>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo $product_arr['price']; ?>"><br>

        <label for="description">Description:</label><br>
        <textarea id="description" name="description"><?php echo $product_arr['description']; ?></textarea><br>

        <input type="submit" value="Update Product">
    </form>

</body>

</html>