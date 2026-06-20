<?php 

class UserController extends BaseController {
    
    private $user;
    
    public function __construct() {
        $this->user = new User();
    }
    
    /**
     * Hiển thị danh sách users dành cho admin
     */
    public function index() {
        // Lấy tất cả users từ database
        $userDetail = $this->user->getAllUsers();
        
        ob_start();
        $this->renderView('profile', ['users' => $userDetail]);
        $data['content'] = ob_get_clean();
        
        //$this->renderView('layouts/mainLayout', $data);
    }
    
    /**
     * Xem profile của user hiện tại User view
     */
    public function profile() {
        // TODO: Lấy username từ session

        // thay vì dùng name đổi sang userid
        $userid = $_GET['userid'] ?? ($_SESSION['user_id'] ?? null);

        if (!$userid) {
            header('Location: /gudbuk/login');
            exit;
        }

        $userData = $this->user->getUserByUserID($userid);

        // TODO: Lấy dữ liệu từ database
        //$data = ['user' => $userData ];

        // CSRF token cho form update
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        $data = [
            'user'       => $userData,
            'csrf_token' => $_SESSION['csrf_token'],
            'errors'     => $_SESSION['profile_errors'] ?? [],
            'flash'      => $_SESSION['flash'] ?? null,
        ];

        unset($_SESSION['profile_errors'], $_SESSION['flash']);
        
        //ob_start();
        $this->renderView('profile', $data);
        //$data['content'] = ob_get_clean();
        
        //$this->renderView('mainLayout', $data);
    }
    
    /**
     * Cập nhật profile
     */
    public function updateProfile() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: /gudbuk/profile');
        exit;
    }

    // Kiểm tra CSRF
    if (
        empty($_POST['csrf_token']) ||
        empty($_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        http_response_code(403);
        exit('Invalid CSRF token');
    }

    $userid  = $_POST['customerid'] ?? null;
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');

    if (!$userid) {
        http_response_code(400);
        exit('Missing customerid');
    }

    // Validate dữ liệu
    $errors = [];
    if ($name === '') {
        $errors['name'] = 'Tên không được để trống.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email không hợp lệ.';
    } elseif ($this->user->isEmailTakenByOther($email, $userid)) {
        $errors['email'] = 'Email đã được sử dụng bởi tài khoản khác.';
    }
    if (!preg_match('/^[0-9+\-\s]{8,15}$/', $phone)) {
        $errors['phone'] = 'Số điện thoại không hợp lệ.';
    }

    if (!empty($errors)) {
        $_SESSION['profile_errors'] = $errors;
        header('Location: /gudbuk/profile?userid=' . urlencode($userid));
        exit;
    }

    // Cập nhật trong database
    $success = $this->user->updateUser($userid, [
        'name'    => $name,
        'email'   => $email,
        'phone'   => $phone,
    ]);

    $_SESSION['flash'] = $success
        ? ['type' => 'success', 'message' => 'Cập nhật thông tin thành công.']
        : ['type' => 'error',   'message' => 'Có lỗi xảy ra, vui lòng thử lại.'];

    header('Location: /gudbuk/profile?userid=' . urlencode($userid));
    exit;
    }
    
    /**
     * Xem chi tiết user (nếu cần)
     */
    public function show() {
        // TODO: Lấy user ID từ URL params
        // $userId = $_GET['id'];
        // $userData = $this->user->findById($userId);
        
        $data = [
            'user' => [] // TODO: Lấy dữ liệu từ database
        ];
        
        ob_start();
        $this->renderView('parts/user-detail', $data);
        $data['content'] = ob_get_clean();
        
        $this->renderView('layouts/mainLayout', $data);
    }
}
