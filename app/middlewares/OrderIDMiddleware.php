<?php

class OrderIDMiddleware
{
    private $userModel;
    public function __construct() {
        $this->userModel = new User();
    }

    public function handle($url_orderid) {
        $token_login = $_COOKIE['token_login'] ?? null;

        if (!$token_login) {
            return false;
        }

		$user = new User();
		$db_userid = $user->getUserByToken($token_login);

		$url_userid = $user->getUserByOrderID($url_orderid);
		if (empty($db_userid) || empty($url_userid) || $db_userid['customerid'] != $url_userid['customerid']) return false;
		return true;
	}
}
