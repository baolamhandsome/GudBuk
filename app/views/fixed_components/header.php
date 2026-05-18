<?php

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewpoint" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="/GudBuk/public/css/header.css">
    <title>gudbuk</title>
</head>
<header class="header">
    <a href="/gudbuk/home" class="logo">gudbuk.</a>

    <form action="/gudbuk/search" class="search-form">
        <input type="search" id="search-box" placeholder="Find book by tile, author...">
        <label for="search-box" class="fas fa-search"></label>
    </form>
    <div class="icons">
        <a href="/gudbuk/cart" id="cart-btn" class="fas fa-shopping-cart"></a>
        <div id="search-btn" class="fas fa-search"></div>
        <a href="/gudbuk/profile" id="user-btn" class="fas fa-user"></a>
        <div class="fas fa-sign-out">
            <a href="/gudbuk/logout"></a>
        </div>
    </div>

</header>

</html>