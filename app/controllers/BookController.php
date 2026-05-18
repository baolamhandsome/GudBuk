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

        $this->renderView('book', [$bookdata]);
    }
    public function search()
    {
        $query = $_GET['query'] ?? '';
        $results = $this->bookModel->searchBooks($query);
        $this->renderView('search', ['results' => $results, 'query' => $query]);
    }
}
