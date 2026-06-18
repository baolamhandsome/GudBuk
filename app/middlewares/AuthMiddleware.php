<?php

/*
    kiểm tra login : 
        + gán tokenlogin lên session (bằng hàm setSession)
        + trong header -> lấy token từ session và tìm trong table token_login 
        + nếu khớp thì cho về trang đích, ko thì cho về trang /login

*/

class AuthMiddleware
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }
    public function handle()
    {
        $token_login = $_COOKIE['token_login'] ?? null;

        if (!$token_login) {
            return false;
        }

        $tokenTable = new tokenLogin();
        $tokenData = $tokenTable->getToken($token_login);
        if (!$tokenData) {
            // ko tồn tại hoặc hết hạn
            return false;
        }
        if ($tokenData['customerid'] == 1) {
            return "ADMIN";
        }
        return "USER";
    }
}
