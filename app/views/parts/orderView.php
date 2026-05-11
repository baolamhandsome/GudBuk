<?php 
//var_dump($data);
$total = 0;
foreach ($data as $entry) {
	$total += $entry['price'] * $entry['quantity'];
}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/GudBuk/public/css/global.css">
		<link rel="stylesheet" href="/GudBuk/public/css/orderView.css">
	</head>
	<body>
		<div class="order-container">
			<div class="order-list">
				<?php foreach ($data as $entry): ?>
					<div class="book-container">
						<div class="name-author-container">
							<div class="name">
								<?= $entry['name'] ?>
							</div>
							<div class="author">
								<?= $entry['author'] ?>
							</div>
						</div>
						<div class="quantity-price-container">
							<div class="quantity">
								<?= $entry['quantity'] ?> books
							</div>
							<div class="price">
								<?= $entry['price'] * $entry['quantity'] ?>$
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<div class="total-price-container">
					<?= $total ?>
				</div>
			</div>
		</div>
	</body>
</html>


