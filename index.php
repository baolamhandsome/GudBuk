<?php
// ===== ENTRY POINT - KHỏI ĐỘNG TOÀN BỘ ỨNG DỤNG =====

// 1. Load toàn bộ file cần thiết
require_once './app/models/dbcore.php';
require_once './app/models/user.php';
require_once './app/controllers/baseController.php';
require_once './app/controllers/authController.php';
require_once './app/controllers/userController.php';
require_once './app/cores/router.php';
require_once './app/routes/web.php';

// 2. Lấy URL từ request
$url = isset($_GET['url']) ? '/' . $_GET['url'] : '/';
$method = $_SERVER['REQUEST_METHOD'];

// 3. Khởi động router và xử lý request
$router->processURL($method, $url);