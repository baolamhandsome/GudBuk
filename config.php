<?php
function getConnection() {
    $host     = "localhost";
    $port     = "17240";
    $dbname   = "gudbuk";
    $username = "postgres";
    $password = "090206";

    try {
        $dsn ="pgsql:host=$host;port=$port;dbname=$dbname";
        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Kết nối thất bại: " . $e->getMessage());
    }
}