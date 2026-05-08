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

    /*
+ Validate data : email(getOne) 
+ Manage bug (by using json_encode)
+ redirect the right way instead of using renderView() -> use href in login.js
*/
    public function handleLogin()
    {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';

        $email = $_POST['email'];
        $password = $_POST['password'];

        $have = $this->userModel->getUserByEmail($email);

        if (!$email || !$password) {
            echo json_encode([
                'success' => false,
                'message' => 'Email hoặc mật khẩu không đúng'
            ]);
        } else {
            if ($have == null || ($have && $have['password'] != $password)) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Email hoặc mật khẩu không đúng!'
                ]);
            } else {
                $token = sha1(uniqid() . time());
                $live = 86400;
                setcookie(
                    'token',
                    $token,
                    [
                        'expires' => time() + $live,
                        'path' => '/',
                        'httponly' => true,  // ← JS không thể access
                        'secure' => true,    // ← Chỉ gửi qua HTTPS
                        'samesite' => 'Strict'  // ← Chống CSRF
                    ]
                );
                $data = [
                    'tokenid' => $token,
                    'userid' => $have['userid'],
                    'expires_at' => date('Y-m-d H:i:s', time() + $live),
                ];
                $this->userModel->insert('token_login', $data);

                echo json_encode([
                    'success' => true,
                    'message' => 'Đăng nhập thành công',
                ]);
            }
        }
    }
}
