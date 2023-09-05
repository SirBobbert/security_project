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

    //users
    get('/demo/createUser', 'frontend/admin/user/createUser.php');
    post('/demo/handleCreateUser', 'api/userAPI/handleCreateUser.php');

    get('/demo/getUsers', 'frontend/admin/user/getUsers.php');
    get('/demo/getUser/$id', 'frontend/admin/user/getUser.php');

    get('/demo/editUser/$id', 'frontend/admin/user/editUser.php');
    post('/demo/handleEditUser/$id', 'api/userAPI/handleEditUser.php');

    post('/demo/handleDeleteUser/$id', 'api/userAPI/handleDeleteUser.php');

    //products
    get('/demo/createProduct', 'frontend/admin/product/createProduct.php');
    post('/demo/handleCreateProduct', 'api/productAPI/handleCreateProduct.php');

    get('/demo/getProducts', 'frontend/admin/product/getProducts.php');
    get('/demo/getProduct/$id', 'frontend/admin/product/getProduct.php');

    get('/demo/editProduct/$id', 'frontend/admin/product/editProduct.php');
    post('/demo/handleEditProduct/$id', 'api/productAPI/handleEditProduct.php');

    post('/demo/handleDeleteProduct/$id', 'api/productAPI/handleDeleteProduct.php');



    //todo
    get('/demo/register', 'frontend/user/register.php');


    //get users api
    get('/demo/read', 'api/userAPI/read.php');
    get('/demo/single_read', 'api/userAPI/single_read.php');
    post('/demo/create', 'api/userAPI/create.php');
    put('/demo/update', 'api/userAPI/update.php');
    //delete('/demo/delete', 'api/userAPI/delete.php');



    //orders
    get('/demo/getOrders', 'frontend/admin/order/getOrders.php');
    get('/demo/getOrder/$id', 'frontend/admin/order/getOrder.php');
    get('/demo/editOrder/$id', 'frontend/admin/order/editOrder.php');
    get('/demo/deleteOrder/$id', 'frontend/admin/order/deleteOrder.php');
    get('/demo/createOrder', 'frontend/admin/order/createOrder.php');

    //API



    // products api
    post('/demo/createProduct', 'api/productAPI/createProduct.php');
    delete('/demo/deleteProduct', 'api/productAPI/deleteProduct.php');

    // orders api
    get('/demo/readOrders', 'api/orderAPI/readOrders.php');
    get('/demo/getSingleOrder', 'api/orderAPI/getSingleOrder.php');
    delete('/demo/deleteOrder', 'api/orderAPI/deleteOrder.php');
    put('/demo/updateOrder', 'api/orderAPI/updateOrder.php');

}

// User routes
if ($role === 'user') {
    get('/demo/user/home', 'frontend/user/homepage.php');

    // orders api
    post('/demo/createOrder', 'api/orderAPI/createOrder.php');
}

// Common routes that require login
if ($role === 'user' || $role === 'admin') {
    //products api

}

// can be accessed without being logged in
get('/demo/index', 'frontend/index.php');
get('/demo/login', 'frontend/login/login.php');
post('/demo/validate', 'frontend/login/validate.php');
post('/demo/logout', 'frontend/login/logout.php');

get('/demo/testpls', 'api/api.php');

any('/404', 'frontend/404.php');