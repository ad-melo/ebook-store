<?php

namespace Models;

use Core\App;
use Core\Database;

class Ebook
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function getAllEbooks()
    {
        return $this->db->query('SELECT * FROM ebooks ORDER BY title ASC')->get();
    }

    public function searchEbooks($query)
    {
        $searchQuery = '%' . $query . '%';
        return $this->db->query('SELECT * FROM ebooks WHERE title LIKE :query OR author LIKE :query', ['query' => $searchQuery])->get();
    }

    public function getEbookById($id)
    {
        return $this->db->query('SELECT * FROM ebooks WHERE id = :id', ['id' => $id])->find();
    }
}
