<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once './app/models/dbcore.php';
require_once './app/controllers/baseController.php';
require_once './app/controllers/userController.php';
require_once './app/models/user.php';

$a = new userController();

$a->index();
?>
