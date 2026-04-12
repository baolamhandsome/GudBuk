<?php 
	class Cart extends dbcore {
		public function __construct() {
			parent::__construct();
		}	

		public function getCart($userID) {
			$statement = "
				SELECT book.name, book.author, book.isbm, cartbookid, quantity, tick
				FROM customer, cart, cart_book, book
				WHERE customer.cartid = cart.cartid 
				AND cart.cartid = cart_book.cartid 
				AND book.bookid = cart_book.bookid
				AND userid = $userID";	
			return $this->getAll($statement);
		}

		public function modifyQuantity($cart_book_id, $quantity) {
			$statement = 
				"UPDATE cart_book
				SET quantity = $quantity
				WHERE cartbookid=$cart_book_id 
				";
			$this->update($statement);
		}

		public function modifyTick($cart_book_id, $checked) {
			$statement = 
				"UPDATE cart_book
				SET tick = $checked
				WHERE cartbookid=$cart_book_id
				";
			$this->update($statement);
		}
		public function removeBook($cart_book_id) {
			$statement =
				"DELETE FROM cart_book
				WHERE cartbookid=$cart_book_id
				";
			$this->update($statement);
		}
	}
?>
