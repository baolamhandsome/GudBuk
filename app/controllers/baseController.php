<?php

class BaseController
{
    protected function renderView($view, $data = [])
    {
        extract($data);
        require_once "./app/views/fixed_components/header.php";
        require_once "./app/views/parts/$view.php";
        require_once "./app/views/fixed_components/footer.php";
    }
}
