<?php

namespace Models;

use Core\App;
use Core\Database;

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function findByEmail($email)
    {
        return $this->db->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();
    }

    public function create($email, $password)
    {
        return $this->db->query('INSERT INTO users (email, password) VALUES (:email, :password)', [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
    }

    public function get_User_Id()
    {
        $user = $this->db->query('SELECT * FROM users WHERE email = :email', ['email' => $_SESSION['user']['email']])->find();

        return $user['id'];
    }
}
