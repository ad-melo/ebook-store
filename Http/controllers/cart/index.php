<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $_SESSION['user']['email']])->find();
$currentUserId = $user['id'];

$cart = $db->query('SELECT * FROM cart WHERE user_id = :user_id', [
    'user_id' => $currentUserId
])->get();

view("cart/create.view.php", [
    'heading' => 'Carrinho de Compras',
    'cart' => $cart
]);
