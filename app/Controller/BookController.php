<?php

namespace MyApp\Controller;
require_once '../../vendor/autoload.php';

class BookController
{
    private $bookModel;

    public function __construct($bookModel)
    {
        $this->bookModel = $bookModel;
    }

    public function index()
    {
        return $this->bookModel->getAllBooks();
    }

}

