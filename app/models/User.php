<?php

class User extends dbcore{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers(){
        return $this->getAll("SELECT * FROM customer");
    }

    // ============ REGISTRATION & LOGIN METHODS ============
    
    /**
     * Get user by email
     * TODO: Implement method to find user by email address
     * @param string $email - User email
     * @return array|null - User data or null if not found
     */
    public function getUserByEmail($email){
        // TODO: Use $this->getOne() to fetch user from database
        // TODO: Query example: "SELECT * FROM customer WHERE email = '$email'"
        // TODO: Remember to use parameterized queries for security!
    }

    /**
     * Get user by username
     * @param string $username - User username
     * @return array|null - User data or null if not found
     */
    public function getUserByUsername($username){
        // Escape để tránh SQL Injection
        $username = addslashes($username);
        $sql = "SELECT * FROM customer WHERE name = '$username'";
        return $this->getOne($sql);
    }   

    /**
     * Create a new user (Register)
     * TODO: Implement method to insert new user into database
     * @param array $data - User data (email, password, full_name, etc.)
     * @return bool - True if successful, false otherwise
     */
    public function createUser($data){
		$cartid = $this->insertReturn('cart', [], 'cartid');
        // Chuẩn bị dữ liệu để insert
        $insertData = array(
            'name' => $data['name'],
			'password' =>  $data['password'], // Hash mật khẩu
			'cartid' => $cartid
            //password_hash($data['passwword'], PASSWORD_BCRYPT),
            //'email' => $data['email']
        );
        print_r($insertData);
        // Sử dụng phương thức insert với parameterized queries để tránh SQL injection
        return $this->insert('customer', $insertData);
    }

    /**
     * Update user profile
     * TODO: Implement method to update user information
     * @param int $id - User ID
     * @param array $data - Fields to update
     * @return bool - True if successful
     */
    public function updateUser($id, $data){
        // TODO: Use $this->update() to modify user record
        // TODO: Can update: full_name, phone, address, etc. (but NOT email/password without verification)
    }

    /**
     * Check if email already exists
     * TODO: Implement method to check email uniqueness
     * @param string $email - Email to check
     * @return bool - True if exists, false if not
     */
    public function emailExists($email){
        // TODO: Use $this->getOne() or $this->countRow() to check if email exists
        // TODO: Return true/false
    }
}
