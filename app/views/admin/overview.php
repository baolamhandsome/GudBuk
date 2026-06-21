<?php
// echo '<pre>';
// print_r($data);
// echo '</pre>';
$revenue = $data[0][0]['revenue'];
$traffic = $data[1][0]['traffic'];
$sold = $data[2][0]['sold'];
?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/GudBuk/public/css/admin.css">
    <title>gudbuk</title>
</head>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Tổng doanh thu</h3>
        <p class="value"> <?php echo $revenue; ?></p>
    </div>
    <div class="stat-card">
        <h3>Lượng truy cập</h3>
        <p class="value"><?php echo $traffic; ?></p>
    </div>
    <div class="stat-card">
        <h3>Tổng số đơn đã bán</h3>
        <p class="value"><?php echo $sold; ?></p>
    </div>

</div>