<?php
$viewFromRender = $view ?? null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/GudBuk/public/css/admin.css">
    <title>gudbuk</title>
</head>

<body>
    <?php require_once "./app/views/admin/header.php"; ?>

    <div class="layout">
        <aside class="sidebar">
            <?php require_once "./app/views/admin/sidebar.php"; ?>
        </aside>

        <main class="main">
            <?php require_once "./app/views/admin/$viewFromRender.php"; ?>
        </main>
    </div>

</body>