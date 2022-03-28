<?php 
class InformationController {
	function returnPolicy() {
		require ABSPATH_SITE . "view/information/returnPolicy.php";
	}
	function deliveryPolicy() {
		require ABSPATH_SITE . "view/information/deliveryPolicy.php";
	}
	function paymentPolicy() {
		require ABSPATH_SITE . "view/information/paymentPolicy.php";
	}
}

?>
