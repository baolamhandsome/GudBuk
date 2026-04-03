<?php 

// Thao tác với DB để lấy dữ liệu -> view -> user
class userController extends baseController{
    public function index(){
        $user = new user();
        $userDetail = $user->getAllUsers();
        $this->renderView('user',$userDetail);
    }
}