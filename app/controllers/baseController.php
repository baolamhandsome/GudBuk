<?php

class BaseController
{
    protected function renderView($view, $data = [])
    {
        extract($data); //truyền data vài cho view
        require_once "./app/views/parts/$view.php";
    }
    public function redirect($path)
    {
        header("Location : $path");
    }
}
