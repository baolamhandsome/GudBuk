<?php
$revenue = $data[0][0]['sum'];
?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/GudBuk/public/css/admin.css">
    <title>gudbuk</title>
</head>

<div class="placeholder-card">
    <p>
        Tổng doanh thu: <?php echo number_format($revenue ?? 0, 0, ',', '.'); ?> $
    </p>
</div>