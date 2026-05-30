<?php

class BaseController
{
    protected function renderView($view, $data = [])
    {
        extract($data);
        require_once "./app/views/fixed_components/header.php";
        echo '<main class="main-content">';
        require_once "./app/views/parts/$view.php";
        echo '</main>';
        require_once "./app/views/fixed_components/footer.php";
    }
}
