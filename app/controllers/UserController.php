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
        // TODO: Lấy user_id từ session
        //$userId = $_SESSION['user_id'];
        $userId = 1;
        $userData = $this->user->findById($userId);

        // TODO: Lấy dữ liệu từ database
        $data = ['user' => $userData ];
        
        //ob_start();
        $this->renderView('profile', $data);
        //$data['content'] = ob_get_clean();
        
        //$this->renderView('mainLayout', $data);
    }
    
    /**
     * Cập nhật profile
     */
    public function updateProfile() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // TODO: Validate dữ liệu từ $_POST
            // TODO: Cập nhật trong database
            
            header('Location: /profile');
            exit;
        }
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
