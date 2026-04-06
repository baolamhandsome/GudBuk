# Hướng Dẫn Thiết Kế Router - GudBuk

## 📌 Cấu Trúc Router Cải Tiến

Tôi đã sửa lại toàn bộ hệ thống router của bạn để tuân theo các best practices:

---

## 🔄 Quy Trình Hoạt Động

```
User Request
    ↓
index.php (Entry Point)
    ↓
Lấy URL + Method từ request
    ↓
Router->processURL($method, $url)
    ↓
Tìm route trong web.php
    ↓
Load Controller + Gọi Function
    ↓
Render View
```

---

## 📋 Cách Sử Dụng Router

### 1. **Đăng ký Route trong `web.php`**

```php
// GET request - để hiển thị form
$router->get('/login', 'AuthController@login');

// POST request - để xử lý form
$router->post('/login', 'AuthController@handleLogin');

// Same route, different action
$router->get('/profile', 'UserController@profile');      // Hiển thị
$router->post('/profile', 'UserController@updateProfile'); // Cập nhật
```

---

## 🎯 Các Route Hiện Tại

| Method | Route | Controller | Hành Động |
|--------|-------|-----------|-----------|
| GET | `/` | HomeController | Trang chủ |
| GET | `/login` | AuthController | Hiển thị form login |
| POST | `/login` | AuthController | Xử lý login |
| GET | `/register` | AuthController | Hiển thị form register |
| POST | `/register` | AuthController | Xử lý register |
| GET | `/logout` | AuthController | Đăng xuất |
| GET | `/users` | UserController | Danh sách users |
| GET | `/profile` | UserController | Xem profile |
| POST | `/profile` | UserController | Cập nhật profile |

---

## ✅ Những Cải Tiến Được Thực Hiện

### 1. **index.php**
- ✅ Load tất cả file cần thiết
- ✅ Lấy URL từ `$_GET['url']`
- ✅ Gọi `router->processURL()`

### 2. **Router.php**
- ✅ Chuẩn hóa URL (loại bỏ trailing slash, query string)
- ✅ Hỗ trợ multiple HTTP methods
- ✅ Kiểm tra method tồn tại trong controller
- ✅ HTTP response codes (404, 500)

### 3. **web.php**
- ✅ Tách riêng GET và POST
- ✅ Tạm dụng `@handleLogin` và `@handleRegister` cho POST
- ✅ Thêm route `/users` và `/profile`
- ✅ Có comment rõ ràng

### 4. **Controllers**
- ✅ AuthController: Hoàn thiện login, register, logout
- ✅ UserController: Hoàn thiện index, profile, updateProfile
- ✅ HomeController: Tạo mới

---

## 🚀 Cách Thêm Route Mới

### Ví dụ 1: Thêm route Admin
```php
// web.php
$router->get('/admin', 'AdminController@dashboard');
$router->post('/admin/users', 'AdminController@storeUser');
```

### Ví dụ 2: Thêm route API
```php
$router->get('/api/users', 'ApiController@users');
$router->post('/api/users', 'ApiController@createUser');
```

### Ví dụ 3: Thêm route Delete/Update
```php
$router->post('/user/delete', 'UserController@delete');
$router->post('/user/update', 'UserController@update');
```

---

## ⚠️ Lưu Ý Quan Trọng

### 1. **URL trong form phải khớp với route**
```php
<!-- form trong view -->
<form method="POST" action="/login">
    <!-- Route phải là POST /login -->
</form>
```

### 2. **Method name phải exact match**
```php
// web.php
$router->post('/login', 'AuthController@handleLogin');

// AuthController.php
public function handleLogin() { ... } // ✅ Đúng

public function handlelogin() { } // ❌ Sai (case-sensitive)
```

### 3. **Luôn có constructor trong controller nếu cần**
```php
class UserController extends BaseController {
    private $user;
    
    public function __construct() {
        $this->user = new User(); // Khởi tạo model
    }
}
```

### 4. **Sử dụng ob_start/ob_get_clean để buffer output**
```php
ob_start();
$this->renderView('parts/login', $data);
$data['content'] = ob_get_clean();
$this->renderView('layouts/mainLayout', $data);
```

---

## 🔧 Để Sử Dụng URL Rewriting (Optional)

Nếu muốn sạch hơn không cần `?url=login`:

### Cập nhật `.htaccess` (Apache)
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteBase /GudBuk/
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php?url=$1 [QSA,L]
</IfModule>
```

### Cập nhật `index.php`
```php
$url = $_SERVER['REQUEST_URI'];
// Loại bỏ base path
$basePath = '/GudBuk';
$url = str_replace($basePath, '', $url);
```

---

## 📝 Checklist Khi Thêm Feature Mới

- [ ] Thêm route trong `web.php`
- [ ] Tạo/Cập nhật controller method
- [ ] Tạo/Cập nhật view file
- [ ] Test form action khớp với route
- [ ] Test method name exact match
- [ ] Test HTTP method (GET/POST) đúng

---

## 💡 Tips

1. **Luôn phân tách GET và POST**: GET để hiển thị, POST để xử lý
2. **Dùng action name descriptive**: `handleLogin` thay vì `login`
3. **Kiểm tra `$_SERVER['REQUEST_METHOD']`** nếu xử lý cả 2 trong 1 method
4. **Sử dụng session** cho authentication

---

## ❓ Câu Hỏi Thường Gặp

**Q: Làm sao để truyền parameter trong URL?**  
A: Hiện tại cần dùng `$_GET` hoặc `$_POST`. Dynamic routes như `/user/:id` cần cập nhật router.

**Q: Cách tạo API routes?**  
A: Tạo API controller và đăng ký routes bình thường. Return JSON thay vì render view.

**Q: Middleware/Authorization?**  
A: Thêm vào BaseController hoặc tạo file middleware riêng, gọi từ controller __construct.
