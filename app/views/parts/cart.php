<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/GudBuk/public/css/global.css">
	<link rel="stylesheet" href="/GudBuk/public/css/cart.css">
</head>
<body>
	<div class="cart-web">
		<h1 class="cart-title">My Cart</h1>
		<div class="books-container">
			<?php if ($data['empty'] == false): ?>
				<?php unset($data['empty']) ?>
				<?php foreach ($data as $entry): ?>
					<div class="book">
						<div class="book-information">
							<h1 class="book-name"><?= $entry["title"] ?></h1>
							<div class="book-author">
								<h3 class="author-display">Author: </h3> <?= $entry["author"] ?>
							</div>
							<div class="book-ISBM">
								<h3 class="ISBM-display">ISBM: </h3> <?= $entry["isbn"] ?>
							</div>
						</div>
						<div class="order-information">
							<button class="book-remove" data-cartbookid=<?= $entry["cart_item_id"] ?>>X</button>
							<div class="book-quantity">
								<button class="quantity-decrease" data-cartbookid=<?= $entry["cart_item_id"] ?>>-</button>
								<div class="quantity-display"><?= $entry["quantity"] ?></div>
								<button class="quantity-increase" data-cartbookid=<?= $entry["cart_item_id"] ?>>+</button>
							</div>
							<input class="book-tick" data-cartbookid=<?= $entry["cart_item_id"] ?> type="checkbox" <?= $entry["selected"] == 1 ? "checked" : "" ?> />
						</div>
					</div>
				<?php endforeach; ?>
				<button class="order-button" data-userid=<?= isset($entry['customerid']) ? $entry['customerid'] : "" ?>>Go to order</button>
			<?php endif; ?>
		</div>
	</div>
	<script type="text/javascript" src="/GudBuk/public/js/cart.js"></script>
</body>
</html>
