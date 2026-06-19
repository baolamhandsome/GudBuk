<?php
class AdminController extends baseController
{
    private $bookModel;
    private $userModel;
    private $orderModel;
    public function __construct()
    {
        $this->userModel = new User();
        $this->bookModel = new Book();
        $this->orderModel = new Order();
    }

    /*
        + tổng doanh thu 
        + lượng khách truy cập hôm nay
        + tổng số đơn đã bán 
    */
    public function overview()
    {
        $data = $this->orderModel->getTotalRevenue();
        $this->renderViewAdmin('overview', [$data]);
    }
    public function showStore()
    {
        $this->renderViewAdmin('store', []);
    }
    public function showCustomer()
    {
        $this->renderViewAdmin('customer', []);
    }
    public function showFinancial()
    {
        $this->renderViewAdmin('financial', []);
    }
}
