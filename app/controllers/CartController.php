<?php
	class CartController extends baseController {

		public function index() {
			$userid = $_GET['userid'] ?? null;
			if (isset($userid)) {
				$cart = new Cart();	
				$cartDetail = $cart->getCart($userid);
				//var_dump($cartDetail);
				$this->renderView('cart', $cartDetail);
			} else {
				echo '404';
			}
		}	

		public function modify() {
			$cart_book_id = $_POST['cart_book_id'] ?? null;
			$quantity = $_POST['quantity'] ?? null;
			if (isset($cart_book_id) and isset($quantity)) {
				$cart = new Cart();
				$result = $cart->modifyQuantity($cart_book_id, $quantity);
				echo json_encode("ok");
			} else {
				echo json_encode('404');
			}
		}

		public function check() {
			$cart_book_id = $_POST['cart_book_id'] ?? null;
			$checked = $_POST['checked'] ?? null;
			if (isset($cart_book_id) and isset($checked)) {
				$cart = new Cart();
				$result = $cart->modifyTick($cart_book_id, $checked);
				echo json_encode("ok");
			} else {
				echo json_encode('404');
			}
		}

		public function remove() {
			$cart_book_id = $_POST['cart_book_id'] ?? null;
			if (isset($cart_book_id)) {
				$cart = new Cart();
				$result = $cart->removeBook($cart_book_id);
				echo json_encode("ok");
			} else {
				echo json_encode("404");
			}
		}
	}
?>
