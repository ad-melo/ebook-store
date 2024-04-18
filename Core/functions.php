<?php

use Core\Response;
use Core\App;
use Core\Database;

function dd($value)
{
    echo "
<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function urlIs($value)
{
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN)
{
    if (!$condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);

    require base_path('views/' . $path);
}

function redirect($path)
{
    header("location: {$path}");
    exit();
}

function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

function cart_quantity()
{
    $db = App::resolve(Database::class);
    $user = $db->query('SELECT * FROM users WHERE email = :email', ['email' => $_SESSION['user']['email']])->find();
    $currentUserId = $user['id'];

    $result = $db->query('SELECT SUM(quantity) AS total_quantity FROM cart WHERE user_id = :user_id', [
        'user_id' => $currentUserId
    ])->get();

    if (!empty($result) && isset($result[0]['total_quantity'])) {
        return (int)$result[0]['total_quantity'];
    }

    return 0;
}
