<?php
require_once('api/class/orders.php');
require_once('api/class/orderlines.php');
require_once('api/config/database.php');

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get data from the POST request
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';

    // Calculate the total amount based on the cart contents and include shipping cost
    $total_amount = calculateTotalAmount($db, $_SESSION['cart']);

    // Create a new order
    $order = new Order($db);
    $order_date = date('Y-m-d H:i:s');
    $order_id = $order->createOrder($user_id, $order_date, $total_amount);

    // Create order lines for each product in the cart
    $orderLine = new OrderLine($db);

    foreach ($_SESSION['cart'] as $product_id => $cart_item) {
        $quantity = $_SESSION['cart'][$product_id]; // Use $product_id here

        // Fetch the product price from the database based on $product_id
        $product_price = getProductPriceById($db, $product_id);

        // Create an order line for each product with quantity
        $orderLine->createOrderLine($product_id, $product_price, $order_id, $quantity);
    }

    // Clear the shopping cart
    unset($_SESSION['cart']);

    header('Location: /demo/getProducts');
    exit();
}

function calculateTotalAmount($db, $cart)
{
    $totalAmount = 0;

    foreach ($cart as $product_id => $cart_item) {
        $quantity = $_SESSION['cart'][$product_id];

        // Fetch the product price from the database based on $product_id
        $productPrice = getProductPriceById($db, $product_id);

        if ($productPrice !== false) {
            $totalAmount += $productPrice * $quantity;
        }
    }
    return $totalAmount;
}


function getProductPriceById($db, $productId)
{
    $query = "SELECT price FROM products WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        return $row['price'];
    }

    return false;
}

?>