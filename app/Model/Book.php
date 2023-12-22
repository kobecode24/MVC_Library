<?php

namespace MyApp\Model;
require_once __DIR__ . '/../Config/DbConnection.php';
use PDO;


class Book
{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    public function getAllBooks()
    {
        $query = "SELECT * FROM Book";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}


