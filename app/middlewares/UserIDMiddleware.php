<?php

class UserIDMiddleware
{
    private $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function handle($url_userid)
    {
        $token_login = $_COOKIE['token_login'] ?? null;

        if (!$token_login) {
            return false;
        }

        $user = new User();
        $db_userid = $user->getUserByToken($token_login);
        if (empty($db_userid) || $db_userid['customerid'] != $url_userid) return false;
        return true;
    }
}
