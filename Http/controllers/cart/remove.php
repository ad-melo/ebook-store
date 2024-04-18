<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $_SESSION['user']['email']])->find();
$currentUserId = $user['id'];

$db->query('DELETE FROM cart WHERE ebook_id =:ebook_id AND user_id = :user_id', [
    'ebook_id' => $_POST['ebook_id'],
    'user_id' => $currentUserId
]);

header('location: /cart');
exit();
