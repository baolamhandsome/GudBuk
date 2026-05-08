<?php

class BaseController
{
    protected function renderView($view, $data = [])
    {
        extract($data);
        require_once "./app/views/parts/$view.php";
    }
    public function redirect($path)
    {
        header("Location : $path");
    }
}
