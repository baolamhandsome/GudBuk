<?php
// error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// hàm tạo mới session tạo mới phiên / chạy tiếp phiên cũ nếu tồn tại
session_start();

// ===== ENTRY POINT - KHỏI ĐỘNG TOÀN BỘ ỨNG DỤNG =====
// 1. Load toàn bộ file cần thiết
// MODELS
// dbcore should be first
require_once './app/models/Dbcore.php';
require_once './app/models/User.php';
require_once './app/models/Cart.php';
require_once './app/models/tokenLogin.php';
require_once './app/models/Book.php';
require_once './app/models/Order.php';
require_once './app/models/Category.php';
// CONTROLLERS
require_once './app/controllers/baseController.php';
require_once './app/controllers/AuthController.php';
require_once './app/controllers/UserController.php';
require_once './app/controllers/CartController.php';
require_once './app/controllers/OrderController.php';
require_once './app/controllers/BookController.php';
require_once './app/controllers/HomeController.php';
require_once './app/controllers/AdminController.php';
// ROUTES/CORES
require_once './app/routes/web.php';

require_once './app/cores/Function.php';

// 2. Lấy URL từ request
// toàn trả về '/' thôi
//$url = isset($_GET['url']) ? '/' . $_GET['url'] : '/';

$url = strtok($_SERVER['REQUEST_URI'], '?');
$basePath1 = '/gudbuk';
$basePath2 = '/GudBuk';
if (str_starts_with($url, $basePath1)) $url = substr($url, strlen($basePath1));
if (str_starts_with($url, $basePath2)) $url = substr($url, strlen($basePath2));
$method = $_SERVER['REQUEST_METHOD'];

//DEBUG : 
// Dòng này không nên bật khi đang code cart do sẽ làm khóa view ??
// echo "$method $url \n";
// echo '<pre>';
// print_r($_GET);
// echo '</pre>';

$router->processURL($method, $url);
