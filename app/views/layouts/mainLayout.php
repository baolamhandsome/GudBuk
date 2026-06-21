<?php
$viewFromRender = $view ?? null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <link rel="stylesheet" href="/GudBuk/public/css/home.css"> -->
    <title>gudbuk</title>
</head>

<body>
    <?php require_once "./app/views/fixed_components/header.php"; ?>

    <div class="layout">
        <main class="main">
            <?php require_once "./app/views/parts/$viewFromRender.php"; ?>
        </main>
    </div>
    <?php require_once "./app/views/fixed_components/footer.php"; ?>

</body>