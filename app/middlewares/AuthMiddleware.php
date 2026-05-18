<?php

/*
    kiểm tra login : 
        + gán tokenlogin lên session (bằng hàm setSession)
        + trong header -> lấy token từ session và tìm trong table token_login 
        + nếu khớp thì cho về trang đích, ko thì cho về trang /login

*/

class AuthMiddleware
{
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
        return true;
    }
}
