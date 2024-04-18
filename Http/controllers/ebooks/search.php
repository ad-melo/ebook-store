<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

if (isset($_GET['query'])) {
    $searchQuery = '%' . $_GET['query'] . '%';
    // Perform the search query
    $results = $db->query('SELECT * FROM ebooks WHERE title LIKE :query OR author LIKE :query', ['query' => $searchQuery])->get();

    // Display search results
    echo '<ul>';
    foreach ($results as $result) {
        echo '<li><a href="/ebook?id=' . $result['id'] . '">' . htmlspecialchars($result['title']) . '</a></li>';
    }
    echo '</ul>';
}
