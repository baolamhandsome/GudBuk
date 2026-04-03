<?php
require_once './app/models/dbcore.php';
require_once './app/controllers/baseController.php';
require_once './app/controllers/userController.php';
require_once './app/models/user.php';
$a = new userController();

$a->index();