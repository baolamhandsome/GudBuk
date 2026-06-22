<?php
/*note : 

*/
class AuthController extends BaseController
{

    private $userModel;
    private $tokenModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->tokenModel = new tokenLogin();
    }

    /// REGISTER
    /*
        + Nếu đã tồn tại email thì đăng kí lại
        + Check pw và pw_confirm
        + Tạo user mới và đưa vào DB 
        + redirect tới trang /login

    */
    public function register()
    {
        $this->renderView('register');
    }
    public function handleRegister()
    {
        $email = $_POST['email'];
        $fullname = $_POST['name'];
        $phone = $_POST['phone'];
        // $address = $_POST['address'];
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        $haveEmail = $this->userModel->getUserByEmail($email);

        if ($haveEmail || !$fullname || !$phone || !$password || !$password_confirm || $password != $password_confirm) {
            request(false, 'Đăng kí không thành công thành công');
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'email' => $email,
            'fullname' => $fullname,
            'phone' => $phone,
            // 'address' => $address,
            'password' => $hashedPassword
        ];
        $this->userModel->createUser($data);

        request(true, 'Đăng kí thành công');
        exit;
    }

    /// LOGIN 
    public function login()
    {
        /*$this->renderView('login');*/

        $this->renderView('login', [
            'pageTitle' => 'Login',
            'error' => 'Invalid credentials'
        ]);
    }
    /*
    + Validate data : email(getOne) 
    + Manage bug (by using json_encode)
    + redirect the right way instead of using renderView() -> use href in login.js
    */
    public function handleLogin()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $have = $this->userModel->getUserByEmail($email);

        if (!$email || !$password) {
            request(false, 'Email hoặc mật khẩu không đúng');
            exit;
        }

        if ($have == null || !password_verify($password, $have['password'])) {
            request(false, 'Email hoặc mật khẩu không đúng!');
            exit;
        } else {
            $token = sha1(uniqid() . time());
            $live = 86400;

            // Tạo cookie chứa token từ phía server
            setcookie(
                'token_login',
                $token,
                [
                    'expires' => time() + 3600, // set time để sau này khi logout sử dụng
                    'path' => '/',
                    'httponly' => true,   // ← JS không thể access
                    //'secure' => true,     // ← HTTPS only
                    'samesite' => 'Strict'
                ]
            );


            //đưa token vào DB
            $data = [
                'token' => $token,
                'customerid' => $have['customerid'],
                'expires_at' => date('Y-m-d H:i:s', time() + $live),
            ];
            $this->tokenModel->insert('token_login', $data);

            //đưa token cho client
            $isAdmin = $have['customerid'] == 1;
            echo json_encode([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'token_login' => $token,
                'isAdmin' => $isAdmin
            ]);
            exit;
        }
    }

    /*
    + Xóa token_login trong DB
    + Xáo cookies
    + Sau cùng, redirect tới /login
*/
    public function logout()
    {
        $token_login = $_COOKIE['token_login'];
        if ($token_login) {
            $this->tokenModel->deleteToken($token_login);
        }

        // xóa cookie, web phân biệt cookies bằng domain và path
        setcookie(
            'token_login',
            '',
            [
                'expires' => time() - 100,
                'path' => '/',
                'httponly' => true,
                //'secure' => true,
                'samesite' => 'Strict'
            ]
        );

        redirect('http://localhost/gudbuk/login');
    }
}
