<?php
require_once 'config.php';

class Database
{

    private static $conn;

    public static function connectPDO()
    {
        try {
            if (class_exists('PDO')) {
                $options = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //đẩy lỗi ra ngoại lệ
                );

                $dsn = _DRIVER . ':host=' . _HOST . '; dbname=' . _DB . ';port=' . _PORT;
                self::$conn = new PDO($dsn, _USER, _PASS, $options);
            }
        } catch (Exception $ex) {
            echo 'error 404 : config/database.php' . $ex->getMessage();
            die();
        }
        return self::$conn;
    }
}
