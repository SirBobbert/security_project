<?php
session_start();

$role = $_SESSION['user_role'] ?? null;

require_once __DIR__ . '/router.php';

function checkAccess($requiredRole)
{
    if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $requiredRole) {
        header("Location: http://localhost/demo/login");
        exit();
    }
}

// Admin routes
if ($role === 'admin') {
    get('/demo/admin/home', 'frontend/admin/homepage.php');

    //users create
    get('/demo/createUser', 'frontend/admin/user/createUser.php');
    post('/demo/handleCreateUser', 'api/userAPI/handleCreateUser.php');
    // users read
    get('/demo/getUsers', 'frontend/admin/user/getUsers.php');
    get('/demo/getUser/$id', 'frontend/admin/user/getUser.php');
    // users update
    get('/demo/editUser/$id', 'frontend/admin/user/editUser.php');
    post('/demo/handleEditUser/$id', 'api/userAPI/handleEditUser.php');
    // users delete
    post('/demo/handleDeleteUser/$id', 'api/userAPI/handleDeleteUser.php');

    // product create 
    get('/demo/createProduct', 'frontend/admin/product/createProduct.php');
    post('/demo/handleCreateProduct', 'api/productAPI/handleCreateProduct.php');

    // product update
    get('/demo/editProduct/$id', 'frontend/admin/product/editProduct.php');
    post('/demo/handleEditProduct/$id', 'api/productAPI/handleEditProduct.php');
    // product delete
    post('/demo/handleDeleteProduct/$id', 'api/productAPI/handleDeleteProduct.php');

    //TODO:
    // orders create
    get('/demo/createOrder', 'frontend/admin/order/createOrder.php');
    // orders read
    get('/demo/getOrders', 'frontend/admin/order/getOrders.php');
    get('/demo/getOrder/$id', 'frontend/admin/order/getOrder.php');
    // orders update
    get('/demo/editOrder/$id', 'frontend/admin/order/editOrder.php');
    // orders delete
    get('/demo/deleteOrder/$id', 'frontend/admin/order/deleteOrder.php');
}

// User routes
if ($role === 'user') {
    get('/demo/user/home', 'frontend/user/homepage.php');

    post('/demo/handleAddToCart', 'frontend/cart/handleAddToCart.php');
    post('/demo/removeFromCart', 'frontend/cart/handleRemoveFromCart.php');
    post('/demo/confirm', 'frontend/cart/handleConfirmPurchase.php');


}

// Common routes that require login
if ($role === 'user' || $role === 'admin') {
    //products api
// product read
    get('/demo/getProducts', 'frontend/admin/product/getProducts.php');
    get('/demo/getProduct/$id', 'frontend/admin/product/getProduct.php');
}

// can be accessed without being logged in
get('/demo/index', 'frontend/index.php');
get('/demo/login', 'frontend/login/login.php');
post('/demo/validate', 'frontend/login/validate.php');
post('/demo/logout', 'frontend/login/logout.php');

get('/demo/register', 'frontend/login/register.php');
post('/demo/handleRegisterUser', 'api/userAPI/handleRegisterUser.php');

get('/demo/testpls', 'api/api.php');

any('/404', 'frontend/404.php');