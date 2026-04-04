<?php
	class CartController extends baseController {
		public function index() {
			$cart = new Cart();	
			$cartDetail = $cart->getCart(1);
			//var_dump($cartDetail);
			$this->renderView('cart', $cartDetail);
		}	
	}
?>
