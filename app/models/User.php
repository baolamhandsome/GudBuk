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
        $sql = "SELECT * FROM customer WHERE name = '$username'";
        return $this->getOne($sql);
    }

    public function getUserByUserID($id)
    {
        $sql = "SELECT * FROM customer WHERE customerID = $id";
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

    public function isEmailTakenByOther($email, $excludeId)
    {
        $sql = "SELECT * FROM customer WHERE email = ? AND customerid != ?";
        $row = $this->getOne($sql, [$email, $excludeId]);
        return !empty($row);
    }

    public function updateUser($id, $data)
    {
        $updateData = array(
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'],
        );

        return $this->update('customer', $updateData, 'customerid = ?', [$id]);
    }

}
