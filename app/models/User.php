<?php

class User extends dbcore{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers(){
        return $this->getAll("SELECT * FROM customer");
    }

    public function findById($userID){
        return $this->getOne("SELECT * FROM customer WHERE customer.UserID = '$userID'");
    }
}