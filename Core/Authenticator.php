<?php

namespace Core;

use Core\App;
use Models\User;

class Authenticator
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = App::resolve(User::class);
    }

    public function attempt($email, $password)
    {
        $user = $this->userModel->findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $this->login([
                'email' => $email
            ]);

            return true;
        }

        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];
        session_regenerate_id(true);
    }

    public function logout()
    {
        Session::destroy();
    }
}
