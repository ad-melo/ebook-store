<?php

use Core\App;
use Models\Ebook;

$ebookModel = App::resolve(Ebook::class);
$ebook = $ebookModel->getEbookById($_GET['id']);

view("ebooks/show.view.php", [
    'heading' => $ebook['title'],
    'ebook' => $ebook
]);
