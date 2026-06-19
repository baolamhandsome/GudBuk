<!DOCTYPE html>
<html>

<head>
	<link rel="stylesheet" href="/GudBuk/public/css/global.css">
	<link rel="stylesheet" href="/GudBuk/public/css/orderList.css">
</head>

<body>
	<div class="order-list-container">
		<?php if ($data['illegal'] == false): ?>
			<?php unset($data['illegal']) ?>
			<?php unset($data['empty']) ?>
			<?php foreach($data as $index => $entry): ?>
				<button class="order-container" data-orderid=<?php echo $entry['orderid']?> >
					<div class="order-number">
						#<?php echo $index ?>
					</div>
					<div class="ordered-time">
						<div class="ordered-time-label">Ordered on:</div>
						<div><?php echo $entry['ordered_at'] ?></div>
					</div>
					<div class="total-price">
						<div class="total-price-label">Total price:</div>
						<div><?php echo $entry['total_price'] ?>$</div>
					</div>
					<div class="address">
						<div class="address-label">Address:</div>
						<div><?php echo $entry['address'] ?></div>
					</div>
				</button>	
			<?php endforeach; ?>
		<?php else: ?>
			<div class="incorrect">
				<div class="incorrect-label">
					Sorry, this is not your order list!
				</div>	
			</div>
		<?php endif; ?>
	</div>
	<script type="text/javascript" src="/GudBuk/public/js/orderList.js"></script>
</body>

</html>
