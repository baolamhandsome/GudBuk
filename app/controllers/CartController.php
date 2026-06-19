<?php
	class CartController extends baseController {

		public function index() {
			$userid = $_GET['userid'] ?? null;
			// check if userid is in url
			if (isset($userid)) {

				// check if userid in token_login is the same as the userid in url
				$token_login = $_COOKIE['token_login'] ?? null;
				if (!$token_login) {
					$this->renderView('cart', ['illegal' => true]);
				}
				$tokenTable = new tokenLogin();
				$tokenData = $tokenTable->getToken($token_login);
				if ($userid != $tokenData['customerid']) {
					$this->renderView('cart', ['illegal' => true]);
				}

				$cart = new Cart();	
				$cartDetail = $cart->getCart($userid);
				//var_dump($cartDetail);
				if (empty($cartDetail)) $cartDetail['empty'] = true;
				else $cartDetail['empty'] = false;
				$cartDetail['illegal'] = false;
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

		public function add() {
			$bookid = $_POST['bookid'] ?? null;
			$customerid = $_POST['userid'] ?? null;
			if (isset($bookid) && isset($customerid)) {
				$cart = new Cart();
				$result = $cart->addBook($bookid, $customerid);
				echo json_encode("success");
			} else {
				echo json_encode("404");
			}
		}
	}
?>
