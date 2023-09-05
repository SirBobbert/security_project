<?php

require_once __DIR__ . '/router.php';

require_once __DIR__ . '/router.php';

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










any('/404', 'views/404.php');
