<?php

use Core\App;
use Core\Validator;
use Models\User;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least 7 characters.';
}

$userModel = App::resolve(User::class);
$userEmail = $userModel->findByEmail($email);

if ($userEmail) {
    $errors['email'] = 'Email already in use. Try logging in.';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$userModel->create($email, $password);

header('Location: /login');
exit();
