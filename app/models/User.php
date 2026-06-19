<?php

class User extends Dbcore
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        return $this->getAll("SELECT * FROM customer");
    }

    public function getUserByEmail($email)
    {
        $sql = "select * from customer where email = '$email'";
        return $this->getOne($sql);
    }

    public function getUserByUsername($username)
    {
        // Escape để tránh SQL Injection
        $sql = "SELECT * FROM customer WHERE name = '$username'";
        return $this->getOne($sql);
    }

	public function getUserByToken($token) {
		$sql = "SELECT customerid FROM token_login WHERE token = '$token'";
		return $this->getOne($sql);
	}

    public function createUser($data)
    {
        $cartid = $this->insertReturn('cart', [], 'cartid');
        // Chuẩn bị dữ liệu để insert
        $insertData = array(
            'name' => $data['fullname'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'password' => $data['password'], // Hash mật khẩu
            'cartid' => $cartid
            //password_hash($data['passwword'], PASSWORD_BCRYPT),
        );

        //print_r($insertData);

        return $this->insert('customer', $insertData);
    }
}
