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
				FROM customer, cart, cart_book, book
				WHERE customer.userid = $userID
				AND customer.cartid = cart.cartid
				AND cart_book.cartid = cart.cartid
				AND book.bookid = cart_book.bookid
				AND tick = 1
			";
		return $this->getAll($statement);
	}

	public function placeOrder($userID, $address)
	{
		$insertData = array(
			'userid' => $userID,
			'address' => $address,
			'date' => date('Y-m-d H:i:s')
		);
		$orderid = $this->insertReturn('orders', $insertData, 'orderid');
		$previewOrder = $this->previewOrder($userID);
		foreach ($previewOrder as $entry) {
			$insertData = array(
				'quantity' => $entry['quantity'],
				'bookid' => $entry['bookid'],
				'orderid' => $orderid
			);
			$this->insert('order_book', $insertData);

			$deleteStatement = "
					DELETE FROM cart_book
					WHERE cartbookid = {$entry['cartbookid']}
				";
			$this->update($deleteStatement);
		}
		return $orderid;
	}

	public function getOrder($orderid)
	{
		$statement = "
				SELECT * FROM order_book, book
				WHERE order_book.bookid = book.bookid AND orderid = $orderid	
			";
		return $this->getAll($statement);
	}

	public function getTotalRevenue()
	{
		$sql = "SELECT SUM(total_price) as revenue FROM orders WHERE status = 'COMPLETED'";
		return $this->getAll($sql);
	}
	public function getTotalSold()
	{
		$sql = "SELECT SUM(order_item.quantity) as sold FROM orders JOIN order_item ON orders.orderid = order_item.orderid WHERE orders.status = 'COMPLETED'";
		return $this->getAll($sql);
	}
}
