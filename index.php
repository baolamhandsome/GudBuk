<?php
// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
// ===== ENTRY POINT - KHỏI ĐỘNG TOÀN BỘ ỨNG DỤNG =====
// 1. Load toàn bộ file cần thiết
// MODELS
// dbcore should be first
require_once './app/models/dbcore.php';
require_once './app/models/User.php';
require_once './app/models/Cart.php';
// CONTROLLERS
// baseController should be first
require_once './app/controllers/baseController.php';
//require_once './app/controllers/AuthController.php';
require_once './app/controllers/UserController.php';
require_once './app/controllers/CartController.php';
// ROUTES/CORES
require_once './app/routes/web.php';

// 2. Lấy URL từ request
// toàn trả về '/' thôi
//$url = isset($_GET['url']) ? '/' . $_GET['url'] : '/';
$url = strtok($_SERVER['REQUEST_URI'], '?');
$basePath = '/GudBuk';
if (str_starts_with($url, $basePath)) $url = substr($url, strlen($basePath));
$method = $_SERVER['REQUEST_METHOD'];

// 3. Khởi động router và xử lý request
$router->processURL($method, $url);
?>
