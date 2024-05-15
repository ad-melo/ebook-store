<?php

use Core\App;
use Core\Container;
use Core\Database;
use Models\Cart;
use Models\Ebook;
use Models\User;

$container = new Container();

$container->bind('Core\Database', function () {
    $config = require base_path('config.php');

    return new Database($config['database']);
});

$container->bind('Models\Cart', function () {
    return new Cart();
});

$container->bind('Models\Ebook', function () {
    return new Ebook();
});

$container->bind('Models\User', function () {
    return new User();
});

App::setContainer($container);
