<?php

class tokenLogin extends Dbcore
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getToken($token)
    {
        $sql = "SELECT * FROM token_login WHERE token = '$token' AND expires_at > NOW()";
        return $this->getOne($sql);
    }

    // tạm thời sử dụng hàm ntn
    public function deleteToken($token)
    {
        $sql = "DELETE FROM token_login WHERE token = ?";
        return $this->query($sql, [$token]);
    }
}
