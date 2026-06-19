<?php
	class OrderController extends baseController {
		public function orderPreview() {
			$userid = $_GET['userid'] ?? null;
			if (isset($userid)) {

				// check if userid in token_login is the same as the userid in url
				$token_login = $_COOKIE['token_login'] ?? null;
				if (!$token_login) {
					$this->renderView('orderPreview', []);
				}
				$tokenTable = new tokenLogin();
				$tokenData = $tokenTable->getToken($token_login);
				if ($userid != $tokenData['customerid']) {
					$this->renderView('orderPreview', []);
				}
				$order = new Order();
				$orderPreview = $order->previewOrder($userid);
				$this->renderView('orderPreview', $orderPreview);		
			} else {
				echo "404";
			}
		}

		public function placeOrder() {
			$userid = $_POST['userid'] ?? null;
			$address = $_POST['address'] ?? null;
			if (isset($userid) && isset($address)) {
				$order = new Order();
				$orderid = $order->placeOrder($userid, $address);
				echo json_encode($orderid);
			} else {
				echo json_encode("404");
			}
		}

		public function viewOrder() {
			$orderid = $_GET['orderid'] ?? null;
			if (isset($orderid)) {
				$order = new Order();
				$orderList = $order->getOrder($orderid);

				// check if this order belongs to this user
				$token_login = $_COOKIE['token_login'] ?? null;
				if (!$token_login) {
					$this->renderView('orderView', []);
				}
				$tokenTable = new tokenLogin();
				$tokenData = $tokenTable->getToken($token_login);
				if ($orderList[0]['customerid'] != $tokenData['customerid']) {
					$this->renderView('orderView', []);
				}

				$this->renderView('orderView', $orderList);
			}
		}
	}
?>

