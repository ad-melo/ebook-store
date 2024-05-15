<?php

use Core\App;
use Models\Cart;
use Models\User;

$userModel = App::resolve(User::class);
$currentUserId = $userModel->get_User_Id();

$cartModel = App::resolve(Cart::class);
$cartModel->updateCartItemQuantity($currentUserId, $_POST['ebook_id'], $_POST['quantity']);

header('location: /cart');
exit();
