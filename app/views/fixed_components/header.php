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
<body>
	<header class="header">
		<a href="/gudbuk/home" class="logo">GudBuk</a>

		<form action="/gudbuk/search" method="GET" class="search-form">
			<input type="search" name="query" id="search-box" placeholder="Find book by title, author...">

			<button type="submit" id="search-submit-btn" style="background: none; border: none; cursor: pointer;">
				<i class="fas fa-search"></i>
			</button>
		</form>
		<div class="icons">
			<a>
				<div id="cart-btn" class="fas fa-shopping-cart"> </div>
			</a>

			<a>
				<div id="order-btn" class="fas fa-basket-shopping"> </div>
			</a>

			<a href="/gudbuk/profile">
				<div id="user-btn" class="fas fa-user"></div>
			</a>

			<a href="/gudbuk/logout">
				<div id="logout-btn" class="fas fa-sign-out-alt"></div>
			</a>
		</div>

	</header>
	<script type="text/javascript" src="/GudBuk/public/js/header.js"></script>
</body>
</html>
