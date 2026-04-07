# Tóm Tắt Công Việc - Cần Hoàn Thành

## ✅ Đã Được Cập Nhật

### 1. **AuthController.php** 
   - ✨ Thêm 5 methods cần hoàn thành: `register()`, `handleRegister()`, `login()`, `handleLogin()`, `logout()`
   - 📝 Mỗi method có TODO comments chi tiết hướng dẫn từng bước
   - 🎯 Tất cả các bước cần làm đã được ghi chú rõ ràng

### 2. **User.php**
   - ✨ Thêm 5 new methods liên quan đến database:
     - `getUserByEmail($email)` - Tìm user bằng email
     - `getUserById($id)` - Tìm user bằng ID  
     - `createUser($data)` - Tạo user mới
     - `updateUser($id, $data)` - Cập nhật user
     - `emailExists($email)` - Kiểm tra email có tồn tại
   - 📝 Mỗi method có TODO comments chi tiết

### 3. **register.php** (View HTML)
   - ✨ Tạo form đăng ký hoàn chỉnh
   - 📝 Có TODO comments cho CSS, validation, và functionality
   - 🎯 Form có tất cả các fields cần thiết

### 4. **login.php** (View HTML)  
   - ✨ Tạo form đăng nhập hoàn chỉnh
   - 📝 Có TODO comments cho CSS và functionality
   - 🎯 Form có fields email + password

---

## 📋 Công Việc Cần Làm - Ước Lượng Thứ Tự

### 🔴 **ĐỀ XUẤT THỨ TỰ THỰC HIỆN:**

#### **Phase 1: Cơ Sở Dữ Liệu** (💪 Dễ)
1. ✅ Kiểm tra/Tạo bảng `customer` với các cột:
   - id, email, password, full_name, phone, address, created_at, updated_at
2. ✅ Thêm UNIQUE constraint cho email

**Công việc:** Xem `AUTH_IMPLEMENTATION_GUIDE.md` - mục "Database Schema"

---

#### **Phase 2: Model Layer** (💪 Trung bình)
1. ⚠️ **Cần cập nhật `dbcore.php` trước!**
   - Thêm hỗ trợ Prepared Statements (để tránh SQL Injection)
   - Cần thêm method để execute với parameters
   
2. ✅ Hoàn thành 5 methods trong `User.php`:
   - `getUserByEmail()` - Query cơ bản
   - `getUserById()` - Query cơ bản
   - `emailExists()` - Check đơn giản
   - `createUser()` - Insert statement
   - `updateUser()` - Update statement

**Công việc:** Xem `AUTH_IMPLEMENTATION_GUIDE.md` - mục "Quy Trình Chi Tiết"

---

#### **Phase 3: Controller Layer** (💪 Trung bình)
1. ✅ `AuthController.register()` - Đơn giản (1 dòng)
2. ✅ `AuthController.login()` - Đơn giản (1 dòng)
3. ✅ `AuthController.handleRegister()` - Logic phức tạp
   - Validate dữ liệu
   - Check email tồn tại
   - Hash password
   - Create user
   - Session management
   
4. ✅ `AuthController.handleLogin()` - Logic phức tạp
   - Validate dữ liệu
   - Find user
   - Verify password
   - Session management

5. ✅ `AuthController.logout()` - Đơn giản

**Công việc:** Xem `AUTH_IMPLEMENTATION_GUIDE.md` - mục "Cận Đích Chi Tiết"

---

#### **Phase 4: Views & Styling** (💪 Dễ)
1. ✅ CSS styling cho register.php (xem TODO comments)
2. ✅ CSS styling cho login.php (xem TODO comments)
3. ✅ (Optional) Client-side validation với JavaScript

**Công việc:** Thêm CSS vào `public/css/global.css`

---

## 📂 Files Cần Xem/Sửa

| File | Trạng Thái | Độ Khó | Ưu Tiên |
|------|-----------|--------|--------|
| `app/models/dbcore.php` | 📋 Cần review | ⭐⭐ | 🔴 **1** |
| `app/models/User.php` | ✨ Đã add TODO | ⭐⭐ | 🔴 **2** |
| `app/controllers/AuthController.php` | ✨ Đã add TODO | ⭐⭐⭐ | 🟠 **3** |
| `app/views/parts/register.php` | ✨ Đã tạo | ⭐ | 🟡 **4** |
| `app/views/parts/login.php` | ✨ Đã tạo | ⭐ | 🟡 **4** |
| `public/css/global.css` | 📝 Cần add | ⭐ | 🟡 **4** |

---

## 💡 Gợi Ý Thêm

1. **Đọc phần "Security Best Practices"** trong `AUTH_IMPLEMENTATION_GUIDE.md` trước khi code
2. **Sử dụng prepared statements** để tránh SQL Injection (cần sửa dbcore.php)
3. **Hash password LUÔN LUÔN** sử dụng `password_hash()` - KHÔNG bao giờ lưu plaintext
4. **Test từng tính năng** khi hoàn thành (xem Testing Checklist)
5. **Validate ở cả phía client và server** để an toàn tốt nhất

---

## 🚀 Bắt Đầu Ngay Bây Giờ

1. Mở file: `AUTH_IMPLEMENTATION_GUIDE.md` để có hướng dẫn chi tiết
2. TODO comments đã được thêm vào tất cả files cần code
3. Follow theo thứ tự ưu tiên được đề xuất ở trên

**Chúc bạn thành công!** 💪
