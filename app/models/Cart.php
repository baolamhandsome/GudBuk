<?php 
	class Cart extends dbcore {
		public function __construct() {
			parent::__construct();
		}	

		public function getCart($userID) {
			$statement = 
				"SELECT * 
				FROM cart, cart_book, book
				WHERE cart.cartID = cart_book.bookID
				AND cart_book.bookID = book.BookID
				AND cart_book.userID = $userID
				";	
			return $this->getAll($statement);
		}
	}
?>
