<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="/GudBuk/public/css/global.css">
	<link rel="stylesheet" href="/GudBuk/public/css/orderPreview.css">
</head>
<body>
	<div class="order-container">
		<?php if (!empty($data)): ?>
			<h1 class="order-title">Order Preview</h1>
			<div class="order-list">
				<?php foreach ($data as $entry): ?>
					<div class="book-container">
						<div class="name-container">
							<?= $entry['title'] ?>
						</div>
						<div class="price-container">
							<?= $entry['price'] * $entry['quantity'] ?>$
						</div>
					</div>
				<?php endforeach; ?>
				<input class="address-input" type="textbox" placeholder="Enter your address" />
				<div class="order-button-container">
					<?php
					$total = 0;
					foreach ($data as $entry) $total += $entry['price'] * $entry['quantity'];
					echo "<div class=\"total-price\">{$total}$</div>";
					?>
					<button class="order-button" data-userid=<?= $entry['customerid'] ?>>Order</button>
				</div>
			</div>
		<?php endif; ?>
	</div>
	<script type="text/javascript" src="/GudBuk/public/js/orderPreview.js"></script>
</body>
</html>
