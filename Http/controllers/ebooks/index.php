<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$ebooks = $db->query('SELECT * FROM ebooks ORDER BY title ASC;')->get();

view("ebooks/index.view.php", [
    'heading' => 'Ebooks',
    'ebooks' => $ebooks
]);
