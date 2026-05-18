<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="/GudBuk/public/css/global.css">
	<link rel="stylesheet" href="/GudBuk/public/css/cart.css">
</head>

<body>
	<div class="cart-web">
		<div class="books-container">
			<?php foreach ($data as $entry): ?>
				<div class="book">
					<div class="book-information">
						<h1 class="book-name"><?= $entry["name"] ?></h1>
						<div class="book-author">
							<h3 class="author-display">Author: </h3> <?= $entry["author"] ?>
						</div>
						<div class="book-ISBM">
							<h3 class="ISBM-display">ISBM: </h3> <?= $entry["isbm"] ?>
						</div>
					</div>
					<div class="order-information">
						<button class="book-remove" data-cartbookid=<?= $entry["cartbookid"] ?>>X</button>
						<div class="book-quantity">
							<button class="quantity-decrease" data-cartbookid=<?= $entry["cartbookid"] ?>>-</button>
							<div class="quantity-display"><?= $entry["quantity"] ?></div>
							<button class="quantity-increase" data-cartbookid=<?= $entry["cartbookid"] ?>>+</button>
						</div>
						<input class="book-tick" data-cartbookid=<?= $entry["cartbookid"] ?> type="checkbox" <?= $entry["tick"] == 1 ? "checked" : "" ?> />
					</div>
				</div>
			<?php endforeach; ?>
			<button class="order-button" data-userid=<?= $entry['userid'] ?>>Go to order</button>
		</div>
	</div>
	<script type="text/javascript" src="/GudBuk/public/js/cart.js"></script>
</body>

</html>