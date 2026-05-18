<?php
class BookController extends baseController
{
    private $bookModel;

    public function __construct()
    {
        $this->bookModel = new Book();
    }
    public function show()
    {
        $bookid = $_GET['bookid'];
        $bookdata = $this->bookModel->getOneBook($bookid);
    }
}
