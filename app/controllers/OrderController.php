<?php
	class OrderController extends baseController {
		public function orderPreview() {
			$userid = $_GET['userid'] ?? null;
			if (isset($userid)) {
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
				$this->renderView('orderView', $orderList);
			}
		}
	}
?>

