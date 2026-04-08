<?php

class BaseController{
    protected function renderView($view, $data = []){
        extract($data);//truyền data vài cho view
        require_once "./app/views/parts/$view.php";
    }
    //hàm điều hướng người dùng tới ...
    protected function redirect($url){
        
    }
}
