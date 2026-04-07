# 📝 Quick Reference - TODO Items

## 🎯 AuthController.php

```
register() - Line X
├─ TODO: Call renderView('register')
│
handleRegister() - Line X
├─ TODO: Get form data from $_POST
├─ TODO: Validate input (email, password, etc.)
├─ TODO: Check if email exists
├─ TODO: Hash password
├─ TODO: Insert to database
├─ TODO: Start session
└─ TODO: Redirect to home

login() - Line X
├─ TODO: Call renderView('login')
│
handleLogin() - Line X
├─ TODO: Get form data
├─ TODO: Validate input
├─ TODO: Get user from database
├─ TODO: Verify password
├─ TODO: Start session
└─ TODO: Redirect to home

logout() - Line X
├─ TODO: session_destroy()
├─ TODO: Clear $_SESSION
└─ TODO: Redirect to home
```

---

## 🎯 User.php

```
getUserByEmail($email)
└─ TODO: Query SELECT * FROM customer WHERE email = ?

getUserById($id)
└─ TODO: Query SELECT * FROM customer WHERE id = ?

createUser($data)
├─ TODO: Insert vào database
└─ TODO: Return true/false

updateUser($id, $data)
├─ TODO: Update user record
└─ TODO: Return true/false

emailExists($email)
└─ TODO: Check if email exists
```

---

## 🎯 register.php (HTML Form)

```
Form Elements:
├─ Email input
├─ Full name input
├─ Phone input (optional)
├─ Address textarea (optional)
├─ Password input
├─ Confirm password input
├─ Terms checkbox
├─ Submit button
└─ Link to login page

TODOs:
├─ TODO: Add error/success display
├─ TODO: Add CSS styling
├─ TODO: Add client-side validation (optional)
└─ TODO: Add show/hide password toggle
```

---

## 🎯 login.php (HTML Form)

```
Form Elements:
├─ Email input
├─ Password input
├─ Remember me checkbox (optional)
├─ Submit button
└─ Links (register, forgot password)

TODOs:
├─ TODO: Add error display
├─ TODO: Add CSS styling
├─ TODO: Add client-side validation (optional)
└─ TODO: Add show/hide password toggle
```

---

## 🎯 dbcore.php (May Need Update)

```
Current methods:
├─ getAll()
├─ getOne()
├─ countRow()
├─ insert()
└─ update()

⚠️ TODO: Consider updating to support:
├─ Prepared statements (for security)
└─ Parameterized queries
```

---

## 🎯 global.css

```
CSS Classes to Add:
├─ .register-container
├─ .register-form
├─ .login-container
├─ .login-form
├─ .form-group
├─ .btn, .btn-primary
├─ input, label styling
├─ .error (red text)
├─ .success (green text)
└─ .auth-links
```

---

## ⚡ Critical TODO Items (Do These FIRST)

### 1. Database Schema
```sql
ALTER TABLE customer ADD COLUMN (
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
ALTER TABLE customer ADD UNIQUE KEY unique_email (email);
```

### 2. AuthController - Basic Methods (Simple)
- Register method (just render view)
- Login method (just render view)
- Logout method (destroy session)

### 3. User Model - Database Methods
- Need to implement getUserByEmail() first
- Need to implement emailExists()
- Then implement createUser()

### 4. AuthController - Validation Logic (Medium)
- handleRegister() 
- handleLogin()

### 5. Views & Styling (Easy)
- Add CSS for forms
- Optional: Add jQuery validation

---

## 🔐 Security Checklist

- [ ] Password ALWAYS hashed with password_hash()
- [ ] Use password_verify() to check password
- [ ] Validate email with filter_var()
- [ ] Check for SQL Injection (use prepared statements)
- [ ] Session management implemented correctly
- [ ] CSRF tokens (optional but recommended)
- [ ] Sanitize/validate all user inputs
- [ ] Consider rate limiting on login attempts
- [ ] Don't show which field (email/password) is wrong

---

## 🧪 Test Cases

### Registration Tests
- [ ] Valid registration succeeds
- [ ] Duplicate email fails
- [ ] Password mismatch fails
- [ ] Weak password fails
- [ ] Invalid email fails
- [ ] Missing fields fails
- [ ] User can login after registration

### Login Tests
- [ ] Valid credentials succeed
- [ ] Wrong password fails
- [ ] Non-existent email fails
- [ ] Empty fields fail
- [ ] Session created on successful login
- [ ] Redirect to home on success

### Logout Tests
- [ ] Session destroyed
- [ ] Redirects to home
- [ ] Cannot access protected pages after logout

---

## 📚 Related Files to Review

- `app/routes/web.php` - Routes already defined ✅
- `configs/database.php` - Check database config
- `index.php` - Check how router/sessions are initialized
- `app/cores/Router.php` - Understand routing mechanism

---

**Pro Tips:**
- Use `var_dump()` or `print_r()` to debug variables
- Test form submission with browser developer tools
- Check browser console for JavaScript errors
- Check server logs for PHP errors
- All routes are already defined in web.php - no need to add them!

