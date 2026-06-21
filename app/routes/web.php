<?php
require_once __DIR__ . "/../cores/router.php";
// Tạo một mảng 2 chiều get,post để lưu URL + function(behavior ra cho người dùng)
// Nhìn chung t vẫn chưa tới đoạn để parse_URL để xử lí query
$router = new Router();

$basePath = '/gudbuk';
$router->get('/admin-dashboard', 'AdminController@overview', ['AuthMiddleware']);

$router->get('/admin-dashboard/store', 'AdminController@showStore', ['AuthMiddleware']);
$router->get('/admin-dashboard/store/edit', 'AdminController@showEditBook', ['AuthMiddleware']);
$router->post('/admin-dashboard/store/edit', 'AdminController@editBook', ['AuthMiddleware']);
$router->post('/admin-dashboard/store/delete', 'AdminController@deleteBook', ['AuthMiddleware']);

$router->get('/admin-dashboard/customer', 'AdminController@showCustomer', ['AuthMiddleware']);
$router->get('/admin-dashboard/customer/delete', 'AdminController@deleteCustomer', ['AuthMiddleware']);

$router->get('/admin-dashboard/financial', 'AdminController@showFinancial', ['AuthMiddleware']);

// Get customerid based on token_login
$router->get('/user', 'UserController@getCurrentUser');

//thành phần thứ 2 trong hàm get() - là $action:  là cách chúng ta quy ước chức năng của url
$router->get('/', 'HomeController@index');
$router->get('/home', 'HomeController@index'); // xử lí phân trang bằng tham số (?curpage=)

$router->post('/home', 'HomeController');
//====book
$router->get('/search', 'BookController@search', []);    // Tìm kiếm sách (với ?query=...)
$router->get('/book', 'BookController@show', []);        // Xem chi tiết sách (với ?bookid=...)

// ===== AUTHENTICATION ROUTES =====
$router->get('/login', 'AuthController@login', []);      // Hiển thị form login
$router->post('/login', 'AuthController@handleLogin', []); // Xử lý login

$router->get('/register', 'AuthController@register', []);     // Hiển thị form register
$router->post('/register', 'AuthController@handleRegister', []); // Xử lý register

$router->get('/logout', 'AuthController@logout', []);    // Đăng xuất

// ===== USER ROUTES =====
$router->get('/profile', 'UserController@profile', ['AuthMiddleware']);         // Xem profile của user hiện tại
$router->post('/profile', 'UserController@updateProfile', ['AuthMiddleware']);  // Cập nhật profile

// ===== SHOPPING CART ROUTES =====
$router->get('/cart', 'CartController@index', ['AuthMiddleware', 'UserIDMiddleware']);       // Xem giỏ hàng
$router->post('/cart/add', 'CartController@add', ['AuthMiddleware']);    // Thêm sách vào giỏ
$router->post('/cart/remove', 'CartController@remove', ['AuthMiddleware']); // Xóa sách khỏi giỏ
$router->post('/cart/modify', 'CartController@modify', ['AuthMiddleware']);   // Cập nhật số lượng
$router->post('/cart/check', 'CartController@check', ['AuthMiddleware']);   // Chọn/bỏ chọn sách để order

// ===== ORDER ROUTES =====
$router->get('/orderPreview', 'OrderController@orderPreview', ['AuthMiddleware', 'UserIDMiddleware']); // preview đơn hàng sắp đặt
$router->post('/placeOrder', 'OrderController@placeOrder'); // Đặt hàng
$router->get('/orderView', 'OrderController@viewOrder', ['AuthMiddleware', 'OrderIDMiddleware']);    // coi đơn hàng
$router->get('/orderList', 'OrderController@viewOrderList', ['AuthMiddleware', 'UserIDMiddleware']); // coi danh sách đơn hàng
$router->get('/order', 'OrderController@index');     // Xem trang đặt hàng
$router->post('/order', 'OrderController@store');    // Xử lý đặt hàng
$router->get('/order/history', 'OrderController@history'); // Xem lịch sử đơn hàng
$router->get('/order/:id', 'OrderController@detail');     // Xem chi tiết đơn hàng
