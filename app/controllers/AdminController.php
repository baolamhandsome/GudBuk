<?php
class AdminController extends baseController
{
    private $bookModel;
    private $userModel;
    private $orderModel;
    private $tokenModel;
    private $bookperpage;
    private $catModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->bookModel = new Book();
        $this->orderModel = new Order();
        $this->tokenModel = new tokenLogin();
        $this->catModel = new Category();
        $this->bookperpage = 9;
    }
    /*
        + tổng doanh thu 
        + lượng khách truy cập hôm nay
        + tổng số đơn đã bán 
    */
    public function overview()
    {
        $revenue = $this->orderModel->getTotalRevenue();
        $traffic = $this->tokenModel->getTotalTraffic();
        $sold  = $this->orderModel->getTotalSold();
        $this->renderViewAdmin('overview', [$revenue, $traffic, $sold]);
    }
    /*
        + Xóa / sửa thông tin của một cuốn sách (về tác giả, giá, không được sửa các trường khác)
        + Thêm sách 
    */
    public function showStore()
    {
        $maxBook = $this->bookModel->getTotalBook();

        $maxpage = ceil($maxBook / $this->bookperpage);
        $curpage = $_GET['curpage'] ?? 1;

        if ($curpage < 1) $curpage = 1;
        if ($curpage > $maxpage) $curpage = $maxpage;

        $offset = ($curpage - 1) * $this->bookperpage;
        $bestBook = $this->bookModel->getBookHome($this->bookperpage, $curpage, $offset);

        $this->renderViewAdmin('store', [$bestBook, $curpage, $maxpage]);
    }
    public function showEditBook()
    {
        $bookid = $_GET['bookid'];
        $dataBook = $this->bookModel->getOneBook($bookid);
        $allCategory = $this->catModel->getAllCat();
        $bookCategories = $this->catModel->getBookCat($bookid);
        $this->renderViewAdmin('editBook', [$dataBook, $allCategory, $bookCategories]);
    }
    public function editBook()
    {
        $this->bookModel->editBook();
        echo json_encode([
            'success' => true,
            'bookid' => $_POST['bookid'],
        ]);
    }

    public function deleteBook()
    {
        $bookid = $_POST['bookid'];
        $this->bookModel->deleteBook($bookid);
    }
    public function showAddBook()
    {
        $allCategory = $this->catModel->getAllCat();
        $this->renderViewAdmin('addBook', [$allCategory]);
    }
    public function addBook()
    {
        $this->bookModel->addBook();
        echo json_encode([
            'success' => true
        ]);
    }

    public function showCustomer()
    {
        $customerperpage = 9;

        $maxUser = $this->userModel->getTotalUser();

        $maxpage = ceil($maxUser / $customerperpage);
        $curpage = $_GET['curpage'] ?? 1;

        if ($curpage < 1) $curpage = 1;
        if ($curpage > $maxpage) $curpage = $maxpage;

        $offset = ($curpage - 1) * $customerperpage;
        $customers = $this->userModel->getUserAdmin($customerperpage, $curpage, $offset);

        $dataUser = $this->userModel->getAllUsers();
        $this->renderViewAdmin('customer', [$customers, $curpage, $maxpage]);
    }
    public function deleteCustomer() {}
}
