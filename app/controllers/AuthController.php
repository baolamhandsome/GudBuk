<?php
/*note : 

*/
class AuthController extends BaseController
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
    }

    public function register()
    {
        // TODO: Call renderView to show register form
        $this->renderView('register');
        // Example: $this->renderView('register');
    }
    public function handleRegister()
    {

        $email = $_POST['email'];
        $have = $this->userModel->getUserByEmail($email);
    }

    public function login()
    {
        $this->renderView('login');
    }

    public function handleLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $have = $this->userModel->getUserByEmail($email);

        if ($have == NULL) {
            echo "Email hoặc mật khẩu không đúng";
            $this->renderView('login');
        } else {
            if ($password != $have['password']) {
                echo "Eamil hoặc mật khẩu không đúng";
                $this->renderView('login');
            } else {
                echo "dang nhap thanh cong";
                $token = sha1(uniqid() . time());
                // Tính thời gian hết hạn token (24 giờ sau)
                $data = [
                    'token' => $token,
                    'userid' => $have['userid'],
                    'expires_at' => date('Y-m-d H:i:s', time() + 86400),
                    // 'created_at' và 'last_used_at' được database tự xử lý với DEFAULT CURRENT_TIMESTAMP
                ];
                $this->userModel->insert('token_login', $data);
            }
        }
    }

    public function logout()
    {
        // TODO: 1. Destroy the session using session_destroy()
        // TODO: 2. Clear $_SESSION array
        // TODO: 3. Redirect to home page
    }
}
