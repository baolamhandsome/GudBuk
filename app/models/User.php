<?php

class User extends Dbcore
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers()
    {
        return $this->getAll("SELECT * FROM customer WHERE rolename != 'ADMIN' AND is_active = true");
    }
    public function getTotalUser()
    {
        return $this->countRow("SELECT * FROM customer WHERE rolename != 'ADMIN' AND is_active = true");
    }
    public function getUserAdmin($customerperpage, $curpage, $offset)
    {
        /*
        truyền data vào cho render()
        */
        $sql = "SELECT * FROM customer WHERE is_active = TRUE AND rolename != 'ADMIN' LIMIT $customerperpage OFFSET $offset";
        $result = $this->getAll($sql);
        return $result;
    }

    public function getUserByEmail($email)
    {
        $sql = "SELECT * from customer where email = '$email' AND is_active = true";
        return $this->getOne($sql);
    }

    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM customer WHERE name = '$username' AND is_active = true";
        return $this->getOne($sql);
    }

    public function getUserByToken($token)
    {
        $sql = "SELECT customerid FROM token_login WHERE token = '$token'  AND is_active = true";
        return $this->getOne($sql);
    }

    public function getUserByUserID($id)
    {
        $sql = "SELECT * FROM customer WHERE customerID = $id  AND is_active = true ";
        return $this->getOne($sql);
    }

    public function getUserByOrderID($id)
    {
        $sql = "SELECT customerid FROM orders WHERE orderid = $id  AND is_active = true ";
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

    public function isEmailTakenByOther($email, $customerid)
    {
        $sql = "SELECT * FROM customer WHERE email = '$email' AND customerid != $customerid  AND is_active = true";
        $row = $this->getOne($sql);
        return !empty($row);
    }

    public function updateUser($customerid, $name, $email, $phone)
    {

        $sql = "UPDATE customer
        SET 
            name    = '$name',
            email   = '$email',
            phone   = '$phone'
        WHERE 
            customerid = '$customerid';
        ";

        return $this->update($sql);
    }
}
