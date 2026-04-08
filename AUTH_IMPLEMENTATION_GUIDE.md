# Hướng Dẫn Xây Dựng Tính Năng Đăng Ký & Đăng Nhập

## 📋 Tổng Quan
Các file đã được cập nhật với các TODO comments chi tiết. Dưới đây là hướng dẫn hoàn chỉnh để bạn tự xây dựng.

---

## 1️⃣ Database Schema (Cơ sở dữ liệu)

### Bảng `customer` (cần thêm các cột)

```sql
ALTER TABLE customer ADD COLUMN (
    password VARCHAR(255) NOT NULL COMMENT 'hashed password',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tạo UNIQUE constraint cho email để tránh trùng lặp
ALTER TABLE customer ADD UNIQUE KEY unique_email (email);
```

Cấu trúc đầy đủ nên có:
- `id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `email` (VARCHAR(255), UNIQUE)
- `password` (VARCHAR(255)) - **lưu password đã hash**
- `full_name` (VARCHAR(255))
- `phone` (VARCHAR(20), OPTIONAL)
- `address` (TEXT, OPTIONAL)
- `created_at` (TIMESTAMP)
- `updated_at` (TIMESTAMP)

---

## 2️⃣ Các Files Cần Thực Hiện

### 📄 **AuthController.php** - Xử lý Logic
**Đã có TODO comments chi tiết. Cần hoàn thành:**
1. `register()` - Hiển thị form đăng ký
2. `handleRegister()` - Xử lý form đăng ký
3. `login()` - Hiển thị form đăng nhập
4. `handleLogin()` - Xử lý form đăng nhập
5. `logout()` - Đăng xuất

**Quy trình Register:**
```
Form Submit → Validate → Check Email Exists → Hash Password → Insert DB → Start Session → Redirect
```

**Quy trình Login:**
```
Form Submit → Validate → Find User → Verify Password → Start Session → Redirect
```

### 📄 **User.php** - Model Database
**Cần hoàn thành các methods:**
- `getUserByEmail($email)` - Tìm user bằng email
- `getUserById($id)` - Tìm user bằng ID
- `createUser($data)` - Tạo user mới
- `updateUser($id, $data)` - Cập nhật user
- `emailExists($email)` - Kiểm tra email đã tồn tại

### 📄 **register.php** - Form HTML
**Đã có template với TODO. Cần:**
- Thêm CSS styling
- Thêm client-side validation (optional nhưng nên có)

### 📄 **login.php** - Form HTML
**Đã được tạo. Cần:**
- Thêm CSS styling
- Thêm client-side validation

---

## 3️⃣ Security Best Practices ⚠️

### Password Hashing
```php
// Khi đăng ký - hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Khi đăng nhập - verify password
if (password_verify($password, $stored_hash)) {
    // Mật khẩu đúng
}
```

### Input Validation
```php
// Kiểm tra email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Email không hợp lệ
}

// Kiểm tra password mạnh
if (strlen($password) < 6) {
    // Mật khẩu quá ngắn
}
```

### Session Management
```php
// Bắt đầu session
session_start();
$_SESSION['user_id'] = $user['id'];
$_SESSION['email'] = $user['email'];
$_SESSION['full_name'] = $user['full_name'];

// Kiểm tra user đã login
if (!isset($_SESSION['user_id'])) {
    // Chưa login - redirect to /login
}

// Đăng xuất
session_destroy();
```

### SQL Injection Prevention
```php
// ❌ KHÔNG dùng cách này:
$sql = "SELECT * FROM customer WHERE email = '$email'";

// ✅ Dùng cách này (Parameterized Queries):
// Cần cập nhật dbcore.php để hỗ trợ prepared statements
```

---

## 4️⃣ Quy Trình Chi Tiết

### 🔹 ĐĂNG KÝ

**Bước 1: User truy cập GET /register**
- AuthController.register() được gọi
- Render register.php form

**Bước 2: User submit form POST /register**
- AuthController.handleRegister() được gọi
- Validate dữ liệu:
  - Email phải hợp lệ
  - Password >= 6 ký tự
  - Confirm password phải trùng
  - Các field bắt buộc phải có
- Kiểm tra email đã tồn tại (User.emailExists)
- Hash password
- Insert vào database (User.createUser)
- Tạo session
- Redirect to home page

### 🔹 ĐĂNG NHẬP

**Bước 1: User truy cập GET /login**
- AuthController.login() được gọi
- Render login.php form

**Bước 2: User submit form POST /login**
- AuthController.handleLogin() được gọi
- Validate dữ liệu:
  - Email không được trống
  - Password không được trống
- Tìm user bằng email (User.getUserByEmail)
- Nếu không tìm thấy → show error
- Verify password (password_verify)
- Nếu sai → show error
- Nếu đúng → tạo session
- Redirect to home page

---

## 5️⃣ Cận Đích Chi Tiết cho Từng File

### 📄 **AuthController.php - register() method**

```php
public function register(){
    // 1. Render the register view
    $this->renderView('register');
}
```

### 📄 **AuthController.php - handleRegister() method**

```php
public function handleRegister(){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';
    $full_name = $_POST['full_name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $address = $_POST['address'] ?? '';
    
    // Validate
    if (empty($email) || empty($password) || empty($password_confirm) || empty($full_name)) {
        $error = 'Vui lòng điền đầy đủ thông tin!';
        $this->renderView('register', ['error' => $error]);
        return;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email không hợp lệ!';
        $this->renderView('register', ['error' => $error]);
        return;
    }
    
    if (strlen($password) < 6) {
        $error = 'Mật khẩu phải có ít nhất 6 ký tự!';
        $this->renderView('register', ['error' => $error]);
        return;
    }
    
    if ($password !== $password_confirm) {
        $error = 'Mật khẩu không trùng khớp!';
        $this->renderView('register', ['error' => $error]);
        return;
    }
    
    // Check email exists
    if ($this->userModel->emailExists($email)) {
        $error = 'Email đã được đăng ký!';
        $this->renderView('register', ['error' => $error]);
        return;
    }
    
    // Hash password and create user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $user_data = [
        'email' => $email,
        'password' => $hashed_password,
        'full_name' => $full_name,
        'phone' => $phone,
        'address' => $address
    ];
    
    $this->userModel->createUser($user_data);
    
    // Start session
    session_start();
    $user = $this->userModel->getUserByEmail($email);
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['full_name'] = $user['full_name'];
    
    // Redirect to home
    header('Location: /');
}
```

### 📄 **AuthController.php - login() method**

```php
public function login(){
    $this->renderView('login');
}
```

### 📄 **AuthController.php - handleLogin() method**

```php
public function handleLogin(){
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $error = 'Vui lòng nhập email và mật khẩu!';
        $this->renderView('login', ['error' => $error]);
        return;
    }
    
    // Find user by email
    $user = $this->userModel->getUserByEmail($email);
    
    if (!$user) {
        $error = 'Email hoặc mật khẩu không đúng!';
        $this->renderView('login', ['error' => $error]);
        return;
    }
    
    // Verify password
    if (!password_verify($password, $user['password'])) {
        $error = 'Email hoặc mật khẩu không đúng!';
        $this->renderView('login', ['error' => $error]);
        return;
    }
    
    // Start session
    session_start();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['full_name'] = $user['full_name'];
    
    // Redirect to home
    header('Location: /');
}
```

### 📄 **AuthController.php - logout() method**

```php
public function logout(){
    session_start();
    session_destroy();
    $_SESSION = [];
    header('Location: /');
}
```

---

## 6️⃣ User.php - Model Methods

Cần cập nhật dbcore.php trước để hỗ trợ prepared statements, sau đó hoàn thành các methods này.

---

## 7️⃣ Testing Checklist ✅

- [ ] Database bảng customer có các cột đúng
- [ ] Truy cập /register hiển thị form
- [ ] Truy cập /login hiển thị form
- [ ] Đăng ký thành công với email chưa tồn tại
- [ ] Đăng ký thất bại nếu email đã tồn tại
- [ ] Đăng ký thất bại nếu password không trùng
- [ ] Đăng nhập thành công với email + password đúng
- [ ] Đăng nhập thất bại nếu email không tồn tại
- [ ] Đăng nhập thất bại nếu password sai
- [ ] Session được tạo sau khi đăng nhập
- [ ] Logout xóa session

---

## 8️⃣ Tối Ưu Hóa Tiếp Theo (Optional)

- [ ] Thêm CSRF token để bảo vệ form
- [ ] Thêm rate limiting cho form login
- [ ] Thêm email verification
- [ ] Thêm forgot password feature
- [ ] Thêm remember me functionality
- [ ] Hash email trong session cho bảo mật

---

**Chúc bạn thực hiện thành công! 🚀**
