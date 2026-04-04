<?php

require_once '../../config.php';

$conn = getConnection();

$userid = 1;

$stmt = $conn->prepare("SELECT userid, name, gmail FROM customer WHERE userid = :id");
$stmt->execute([':id' => $userid]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Không tìm thấy user!");
}

echo "User ID : " . $user['userid'] . "\n";
echo "Họ tên  : " . $user['name']   . "\n";
echo "Email   : " . $user['gmail']  . "\n";