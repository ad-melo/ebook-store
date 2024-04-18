<?php

use Core\Database;
use Core\App;

$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $_SESSION['user']['email']])->find();
$currentUserId = $user['id'];

$existingCartItem = $db->query('SELECT * FROM cart WHERE ebook_id = :ebook_id AND user_id = :user_id', [
    'ebook_id' => $_POST['ebook_id'],
    'user_id' => $currentUserId
])->find();

if ($existingCartItem) {
    // Item already exists in the cart, update the quantity
    $newQuantity = $existingCartItem['quantity'] + $_POST['quantity'];

    // Update the quantity of the item in the cart
    $db->query('UPDATE cart SET quantity = :quantity WHERE ebook_id = :ebook_id AND user_id = :user_id', [
        'quantity' => $newQuantity,
        'ebook_id' => $_POST['ebook_id'],
        'user_id' => $currentUserId
    ]);
} else {
    // Item does not exist in the cart, add a new item
    $db->query('INSERT INTO cart (ebook_id, quantity, user_id) VALUES (:ebook_id, :quantity, :user_id)', [
        'ebook_id' => $_POST['ebook_id'],
        'quantity' => $_POST['quantity'],
        'user_id' => $currentUserId
    ]);
}

header('location: /ebooks');
exit();
