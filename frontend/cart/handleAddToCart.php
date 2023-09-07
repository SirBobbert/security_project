<?php
session_start();

// Check if a product ID was provided in the POST data
if (isset($_POST['id'])) {
    $productId = $_POST['id'];

    // Check if the shopping cart session variable exists
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Check if the product is already in the cart
    if (array_key_exists($productId, $_SESSION['cart'])) {
        // Retrieve the quantity of the product from the cart
        $quantity = $_SESSION['cart'][$productId];

        // Now, you have the quantity of the product in the $quantity variable
        echo "Quantity of Product ID $productId: $quantity";

        // Increment the quantity if needed
        $_SESSION['cart'][$productId]++;
    } else {
        // Add the product to the cart with a quantity of 1 if it doesn't exist
        $_SESSION['cart'][$productId] = 1;
        $quantity = 1;
    }
    // Redirect back to the product list page or display a success message
    header('Location: /demo/getProducts');
    exit();
} else {
    echo "Invalid request. Please provide a product ID.";
}

?>