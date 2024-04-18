<?php

$router->get('/', 'index.php');
$router->get('/about', 'about.php');
$router->get('/contact', 'contact.php');

$router->get('/ebooks', 'ebooks/index.php');
$router->get('/ebook', 'ebooks/show.php');
$router->get('/ebooks/search', 'ebooks/search.php');

$router->post('/upload', 'upload/index.php')->only('auth');

$router->get('/cart', 'cart/index.php')->only('auth');
$router->post('/cart', 'cart/store.php')->only('auth');
$router->post('/cart/update', 'cart/update.php')->only('auth');
$router->post('/cart/remove', 'cart/remove.php')->only('auth');

$router->get('/register', 'registration/create.php')->only('guest');
$router->post('/register', 'registration/store.php')->only('guest');

$router->get('/login', 'session/create.php')->only('guest');
$router->post('/session', 'session/store.php')->only('guest');
$router->delete('/session', 'session/destroy.php')->only('auth');
