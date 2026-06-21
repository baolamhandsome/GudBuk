<?php
class Cart extends dbcore
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getCart($userID)
	{
		$statement = "
				SELECT customerid, book.title, book.author, book.isbn, cart_item_id, quantity, price, selected
				FROM customer, cart, cart_item, book
				WHERE customer.cartid = cart.cartid 
				AND cart.cartid = cart_item.cartid 
				AND book.bookid = cart_item.bookid
				AND customerid = $userID
				AND book.is_active = true"; return $this->getAll($statement);
	}

	public function modifyQuantity($cart_book_id, $quantity)
	{
		$statement =
			"UPDATE cart_item
				SET quantity = $quantity
				WHERE cart_item_id=$cart_book_id 
				";
		$this->update($statement);
	}

	public function modifyTick($cart_book_id, $checked)
	{
		$selected = $checked ? "true" : "false";
		$statement =
			"UPDATE cart_item
				SET selected = $selected
				WHERE cart_item_id=$cart_book_id
				";
		$this->update($statement);
	}
	public function removeBook($cart_book_id)
	{
		$statement =
			"DELETE FROM cart_item
				WHERE cart_item_id=$cart_book_id";
		$this->update($statement);
	}

	public function addBook($bookid, $customerid) {
		// get cartid from customerid
		$statement = "SELECT cartid FROM customer WHERE customerid = $customerid";
		$cartid = $this->getOne($statement)['cartid'];
		// check if bookid already exists
		$statement = "
			SELECT * FROM cart_item
			WHERE bookid = $bookid AND cartid = $cartid";
		$result = $this->getAll($statement);
		if (empty($result)) {
			// book doesn't exist in cart yet
			$insertData = array(
				'bookid' => $bookid,
				'cartid' => $cartid,
				'quantity' => '1',
				'selected' => 'false'
			);
			$this->insert('cart_item', $insertData);
		} else {
			// increase quantity by 1
			$update = "
				UPDATE cart_item 
				SET quantity = quantity + 1
				WHERE bookid = $bookid 
				AND cartid = $cartid";
			$this->update($update);
		}
	}
}
