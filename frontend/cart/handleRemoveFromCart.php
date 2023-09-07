<?php
session_start();

// Check if the user is logged in and has a role of "user"
if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user') {
    // Check if a product ID was provided in the POST data for removal
    if (isset($_POST['remove_id'])) {
        $removeProductId = $_POST['remove_id'];
        
        // Check if the shopping cart session variable exists
        if (isset($_SESSION['cart'])) {
            // Check if the product exists in the cart
            if (array_key_exists($removeProductId, $_SESSION['cart'])) {
                // Decrease the quantity of the product
                $_SESSION['cart'][$removeProductId]--;
                
                // Remove the product if the quantity reaches zero
                if ($_SESSION['cart'][$removeProductId] <= 0) {
                    unset($_SESSION['cart'][$removeProductId]);
                }
            }
        }
        
        // Redirect back to the shopping cart page or display a success message
        header('Location: /demo/getProducts');
        exit();
    } else {
        echo "Invalid request. Please provide a product ID for removal.";
    }
} else {
    echo "You are not authorized to perform this action.";
}
?>
