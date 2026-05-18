<?php
class HomeController extends BaseController
{
    private $bookModel;
    private int $bookperpage;
    public function __construct()
    {
        $this->bookModel = new Book();
        $this->bookperpage = 9; // set up manually

    }
    public function index()
    {
        $maxBook = $this->bookModel->getAllBook();

        $maxpage = ceil($maxBook / $this->bookperpage);
        $curpage = $_GET['curpage'] ?? 1;

        if ($curpage < 1) $curpage = 1;
        if ($curpage > $maxpage) $curpage = $maxpage;

        $offset = ($curpage - 1) * $this->bookperpage;
        $bestBook = $this->bookModel->getBookHome($this->bookperpage, $curpage, $offset);

        $this->renderView('home', [$bestBook, $curpage, $maxpage]);
    }
}
