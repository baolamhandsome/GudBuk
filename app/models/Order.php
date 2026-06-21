<?php
class Order extends dbcore
{
	public function __construct()
	{
		parent::__construct();
	}

	public function previewOrder($userID)
	{
		$statement = "
				SELECT *
				FROM customer, cart, cart_item, book
				WHERE customer.customerid = $userID
				AND customer.cartid = cart.cartid
				AND cart_item.cartid = cart.cartid
				AND book.bookid = cart_item.bookid
				AND selected = true
			";
		return $this->getAll($statement);
	}

	public function placeOrder($userID, $address)
	{
		$previewOrder = $this->previewOrder($userID);
		// calculate total price
		$total_price = 0;
		foreach ($previewOrder as $entry) $total_price = $total_price + $entry['quantity'] * $entry['price'];

		try {
			// BEGIN TRANSACTION
			$this->beginTransaction();
			// insert into orders table
			$insertData = array(
				'customerid' => $userID,
				'total_price' => $total_price,
				'address' => $address,
				'ordered_at' => date('Y-m-d H:i:s'),
				'status' => 'PENDING'
			);
			// insert to get orderid
			$orderid = $this->insertReturn('orders', $insertData, 'orderid');
			foreach ($previewOrder as $entry) {
				// insert into order_item
				$insertData = array(
					'unit_price' => $entry['price'],
					'quantity' => $entry['quantity'],
					'bookid' => $entry['bookid'],
					'orderid' => $orderid
				);
				$this->insert('order_item', $insertData);

				// remove ordered books from cart
				$deleteStatement = "
						DELETE FROM cart_item
						WHERE cart_item_id = {$entry['cart_item_id']}
					";
				$this->update($deleteStatement);

				// increase sold in book
				$bookid = $entry['bookid'];
				$quantity = $entry['quantity'];
				$update = "UPDATE book SET sold = sold + $quantity WHERE bookid = $bookid";
				$this->update($update);
			}
			// END TRANSACTION
			$this->commit();
		} catch (Exception $e) {
			if ($this->inTransaction()) {
				$this->rollBack();
			}
			throw $e;
		}
		return $orderid;
	}

	public function getOrder($orderid)
	{
		$statement = "
				SELECT * FROM orders, order_item, book
				WHERE orders.orderid = order_item.orderid AND order_item.bookid = book.bookid AND orders.orderid = $orderid	
			";
		return $this->getAll($statement);
	}

	public function getAllOrder($userid) {
		$statement = "
			SELECT * FROM orders WHERE customerid = $userid;
		";
		return $this->getAll($statement);
	}
	

	public function getTotalRevenue()
	{
		$sql = "SELECT SUM(total_price) FROM orders WHERE status = 'COMPLETED'";
		return $this->getAll($sql);
	}
}
