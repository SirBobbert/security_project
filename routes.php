<?php

require_once __DIR__ . '/router.php';

require_once __DIR__ . '/router.php';

get('/demo/index', 'frontend/index.php');
get('/demo/items', 'views/items.php');
get('/demo/items/$id', 'views/get-item.php');
get('/demo/users/$age/$name', 'users/users.php');

get('/demo/test/$name', 'api/api.php');



get('/demo/api/config', 'api/config/database.php');




//login
get('/demo/login', 'frontend/user/login.php');

//logout
get('/demo/logout', 'frontend/user/logout.php');


//admin homepage
get('/demo/admin/home', 'frontend/admin/homepage.php');

//user homepage
get('/demo/user/homeget', 'frontend/user/home.php');
post('/demo/user/home', 'frontend/user/home.php');

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


any('/404', 'frontend/404.php');