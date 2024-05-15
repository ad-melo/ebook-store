<?php

use Core\App;
use Models\Ebook;

if (isset($_GET['query'])) {
    $ebookModel = App::resolve(Ebook::class);
    $results = $ebookModel->searchEbooks($_GET['query']);

    echo '<ul>';
    foreach ($results as $result) {
        echo '<li><a href="/ebook?id=' . $result['id'] . '">' . htmlspecialchars($result['title']) . '</a></li>';
    }
    echo '</ul>';
}
