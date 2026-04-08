<?php

class AuthController extends BaseController{

    private $userModel;
    
    public function __construct()
    {
        // TODO: Initialize the User model for database operations
        $this->userModel = new User();
    }
    // ============ REGISTRATION FEATURE ============
    /**
     * Show registration form (GET /register)
     * TODO: Render the register.php view with the registration form
     */
    public function register(){
        // TODO: Call renderView to show register form
        $this->renderView('register');
        // Example: $this->renderView('register');
    }

    /**
     * Handle registration form submission (POST /register)
     * TODO: Process user registration
     */
    public function handleRegister(){
        // TODO: 1. Get form data from $_POST (email, password, password_confirm, full_name, etc.)

        print_r($_POST);
        
        // TODO: 2. Validate input data:
        //   - Check if email is valid format
        //   - Check if passwords match
        //   - Check if password is strong enough (min 6 characters)
        //   - Check if all required fields are filled
        // TODO: 3. Check if email already exists using $this->userModel->getUserByEmail($email)
        $username = $_POST['name'];

        $have = $this->userModel->getUserByUsername($username);

        if($have == NULL){
            $this->userModel->createUser($_POST);
            echo 'đăng kí thành công';
        }
        else{
            echo "tên người dùng đã tồn tại";
            $this->renderView('register');
        } 
        // TODO: 6. Start session and set user info

        // TODO: 7. Redirect to home page or show success message
    }

    // ============ LOGIN FEATURE ============
    /**
     * Show login form (GET /login)
     * TODO: Render the login.php view with the login form
     */
    public function login(){
        // TODO: Call renderView to show login form

        $this->renderView('login');
        // Example: $this->renderView('login');

    }

    /**
     * Handle login form submission (POST /login)
     * TODO: Process user login
     */
    public function handleLogin(){
        // TODO: 1. Get form data from $_POST (email and password)

        //echo "<pre>";
        //print_r($_POST);
        //echo "</pre>";

        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $have = $this->userModel->getUserByUserName($username);
        
        if($have == NULL){
            echo "tên đăng nhập hoặc mật khẩu không đúng";
            $this->renderView('login');
        }
        else{
            if($password != $have['password']){
                echo "tên đăng nhập hoặc mật khẩu không đúng";
                $this->renderView('login');
            }
            else{
                echo "dang nhap thanh cong";
                $token = sha1(uniqid() . time());
                // Tính thời gian hết hạn token (24 giờ sau)
                $data = [
                    'token' => $token,
                    'userid' => $have['userid'],
                    'expires_at' => date('Y-m-d H:i:s', time() + 86400),
                    // 'created_at' và 'last_used_at' được database tự xử lý với DEFAULT CURRENT_TIMESTAMP
                ];
                $this->userModel->insert('token_login',$data);
            }
        }
        // TODO: 7. If password correct, start session and set user info ($_SESSION['user_id'], $_SESSION['email'], etc.)
        
        $this->redirect('/home');
    }

    // ============ LOGOUT FEATURE ============
    /**
     * Handle logout (GET /logout)
     * TODO: Destroy user session
     */
    public function logout(){
        // TODO: 1. Destroy the session using session_destroy()
        // TODO: 2. Clear $_SESSION array
        // TODO: 3. Redirect to home page
    }

}