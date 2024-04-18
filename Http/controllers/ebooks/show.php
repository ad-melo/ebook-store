<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$ebook = $db->query('SELECT * FROM ebooks WHERE id = :id', [
    'id' => $_GET['id']
])->find();

view("ebooks/show.view.php", [
    'heading' => $ebook['title'],
    'ebook' => $ebook
]);
