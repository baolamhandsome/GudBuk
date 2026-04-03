<?php

class user extends dbcore{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllUsers(){
        return $this->getAll("SELECT * FROM customer");
    }
}