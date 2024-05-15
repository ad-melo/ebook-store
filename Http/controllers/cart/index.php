<?php

use Core\App;
use Models\Cart;
use Models\User;

$userModel = App::resolve(User::class);
$currentUserId = $userModel->get_User_Id();

$cartModel = App::resolve(Cart::class);
$userCart = $cartModel->getUserCart($currentUserId);

view("cart/create.view.php", [
    'heading' => 'Carrinho de Compras',
    'cart' => $userCart
]);
