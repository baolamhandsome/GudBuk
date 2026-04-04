<?php
class database
{
    private $host = "localhost";
    private $port = '17240';
    private $dbname = 'gudbuk'; // Tên cơ sở dữ liệu
    private $username = 'postgres'; //
    private $password = '..';

    public function getConnection(){
        $dsn = "pgsql:host=$this->host;dbname=$this->dbname;port=$this->port";

        $pdo = new PDO($dsn,$this->username,$this->password);

        return $pdo;
    }

}

