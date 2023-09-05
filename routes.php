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
    get('/demo/getUsers', 'frontend/admin/user/getUsers.php');
    get('/demo/getUser/$id', 'frontend/admin/user/getUser.php');

    //users
    get('/demo/getUsers', 'frontend/admin/user/getUsers.php');
    get('/demo/getUser/$id', 'frontend/admin/user/getUser.php');
    get('/demo/editUser/$id', 'frontend/admin/user/getUser.php');
    get('/demo/deleteUser/$id', 'frontend/admin/user/getUser.php');
    get('/demo/register', 'frontend/user/register.php');

    //products
    get('/demo/getProducts', 'frontend/admin/product/getProducts.php');
    get('/demo/getProduct/$id', 'frontend/admin/product/getProduct.php');
    get('/demo/editProduct/$id', 'frontend/admin/product/editProduct.php');
    get('/demo/deleteProduct/$id', 'frontend/admin/product/deleteProduct.php');
    get('/demo/createProduct', 'frontend/admin/product/createProduct.php');

    //orders
    get('/demo/getOrders', 'frontend/admin/order/getOrders.php');
    get('/demo/getOrder/$id', 'frontend/admin/order/getOrder.php');
    get('/demo/editOrder/$id', 'frontend/admin/order/editOrder.php');
    get('/demo/deleteOrder/$id', 'frontend/admin/order/deleteOrder.php');
    get('/demo/createOrder', 'frontend/admin/order/createOrder.php');
}

// User routes
if ($role === 'user') {
    get('/demo/user/home', 'frontend/user/homepage.php');
}

get('/demo/index', 'frontend/index.php');
get('/demo/login', 'frontend/login/login.php');
post('/demo/validate', 'frontend/login/validate.php');
post('/demo/logout', 'frontend/login/logout.php');

get('/demo/testpls', 'api/api.php');







// Mathias branch
get('/demo/index', 'views/index.php');
get('/demo/items', 'views/items.php');
// CRUD
get('/demo/products', 'api/get_products.php');
get('/demo/getUser', 'api/get_user_by_id.php');

//get users api
get('/demo/read', 'api/userAPI/read.php');
get('/demo/single_read', 'api/userAPI/single_read.php');
post('/demo/create', 'api/userAPI/create.php');
put('/demo/update', 'api/userAPI/update.php');
delete('/demo/delete', 'api/userAPI/delete.php');


// products api
get('/demo/getProducts', 'api/productAPI/getProducts.php');
get('/demo/getSingleProducts', 'api/productAPI/single_read_product.php');
post('/demo/createProduct', 'api/productAPI/createProduct.php');
put('/demo/updateProduct', 'api/productAPI/updateProduct.php');
delete('/demo/deleteProduct', 'api/productAPI/deleteProduct.php');

//Order Api
get('/demo/readOrders', 'api/orderAPI/readOrders.php');
post('/demo/createOrder', 'api/orderAPI/createOrder.php');
get('/demo/getSingleOrder', 'api/orderAPI/getSingleOrder.php');
delete('/demo/deleteOrder', 'api/orderAPI/deleteOrder.php');
put('/demo/updateOrder', 'api/orderAPI/updateOrder.php');

any('/404', 'frontend/404.php');