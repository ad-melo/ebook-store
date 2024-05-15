<?php

use Core\App;
use Models\Ebook;

$ebookModel = App::resolve(Ebook::class);
$ebooks = $ebookModel->getAllEbooks();

view("ebooks/index.view.php", [
    'heading' => 'Ebooks',
    'ebooks' => $ebooks
]);
