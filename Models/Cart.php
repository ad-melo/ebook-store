<?php

namespace Models;

use Core\App;
use Core\Database;

class Cart
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function getUserCart($userId)
    {
        return $this->db->query('SELECT * FROM cart WHERE user_id = :user_id', ['user_id' => $userId])->get();
    }

    public function addToCart($userId, $ebookId, $quantity)
    {
        $existingCartItem = $this->db->query('SELECT * FROM cart WHERE ebook_id = :ebook_id AND user_id = :user_id', [
            'ebook_id' => $ebookId,
            'user_id' => $userId
        ])->find();

        if ($existingCartItem) {
            // Item already exists in the cart, update the quantity
            $newQuantity = $existingCartItem['quantity'] + $quantity;

            // Update the quantity of the item in the cart
            $this->db->query('UPDATE cart SET quantity = :quantity WHERE ebook_id = :ebook_id AND user_id = :user_id', [
                'quantity' => $newQuantity,
                'ebook_id' => $ebookId,
                'user_id' => $userId
            ]);
        } else {
            // Item does not exist in the cart, add a new item
            $this->db->query('INSERT INTO cart (ebook_id, quantity, user_id) VALUES (:ebook_id, :quantity, :user_id)', [
                'ebook_id' => $ebookId,
                'quantity' => $quantity,
                'user_id' => $userId
            ]);
        }
    }

    public function removeFromCart($userId, $ebookId)
    {
        $this->db->query('DELETE FROM cart WHERE ebook_id = :ebook_id AND user_id = :user_id', [
            'ebook_id' => $ebookId,
            'user_id' => $userId
        ]);
    }

    public function updateCartItemQuantity($userId, $ebookId, $quantity)
    {
        $this->db->query('UPDATE cart SET quantity = :quantity WHERE ebook_id = :ebook_id AND user_id = :user_id', [
            'quantity' => $quantity,
            'ebook_id' => $ebookId,
            'user_id' => $userId
        ]);
    }

    public function getCartQuantity($email)
    {
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', ['email' => $email])->find();
        $currentUserId = $user['id'];

        $result = $this->db->query('SELECT SUM(quantity) AS total_quantity FROM cart WHERE user_id = :user_id', [
            'user_id' => $currentUserId
        ])->get();

        if (!empty($result) && isset($result[0]['total_quantity'])) {
            return (int)$result[0]['total_quantity'];
        }

        return 0;
    }
}
