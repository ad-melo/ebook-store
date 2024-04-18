<?php

use Core\Database;
use Core\Authenticator;
use Core\Validator;
use Core\App;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valide email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least 7 characters.';
}

if (Validator::email($email)) {
    $errors['email'] = 'Please provide a valide email address.';
}

$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();

if ($user) {
    $errors['email'] = 'Email already in use try logging in.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}


if ($user) {
    header('location: /register');
    exit();
} else {
    $db->query('INSERT INTO users(email, password)  VALUES(:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    header('location: /login');
    exit();
}
