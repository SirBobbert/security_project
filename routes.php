<?php

require_once __DIR__ . '/router.php';

require_once __DIR__ . '/router.php';

get('/demo/index', 'views/index.php');
get('/demo/items', 'views/items.php');
get('/demo/items/$id', 'views/get-item.php');
get('/demo/users/$age/$name', 'users/users.php');

get('/demo/test/$name', 'api/api.php');

any('/404', 'views/404.php');
