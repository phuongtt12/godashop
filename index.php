<?php 
		session_start();
	require_once "config.php";
	require_once ABSPATH . "bootstrap.php";
	require_once ABSPATH_SITE . "load.php";

	$router = new AltoRouter();
	// generate() là hàm được hỗ trợ sẵn của router	
	// Trang chủ
	$router->map( 'GET', '/', ["HomeController", "list"], "home"
	);
	// Trang sản phẩm
	$router->map( 'GET', '/san-pham', array("ProductController", "list"), 'product');

	//trang chính sách đổi trả
	$router->map( 'GET', '/chinh-sach-doi-tra', array("InformationController", "returnPolicy"), 'returnPolicy');

	// trang chính sách thanh toán
	$router->map( 'GET', '/chinh-sach-thanh-toan', array("InformationController", "paymentPolicy"), 'paymentPolicy');

	// trang chính sách giao hàng
	$router->map( 'GET', '/chinh-sach-giao-hang', array("InformationController", "deliveryPolicy"), 'deliveryPolicy');
	// trang liên hệ
	$router->map( 'GET', '/lien-he', array("ContactController", "form"), 'contact-form');
	// trang chi tiết sản phẩm
	// không đực dùng slug-name do không hiểu dấu - trong tên
	$router->map('GET', '/san-pham/[*:slugName]-[i:id].html', function($slugName, $id) {
		$_GET["id"] = $id;
	  	call_user_func_array(["ProductController", "detail"],[]);
	}, 'product-detail');

	//Trang đơn hàng
	$router->map( 'GET', '/don-hang', array("AccountController", "orders"), 'orders');

	//Trang chi tiết đơn hàng
	$router->map('GET', '/chi-tiet-don-hang/[i:id].html', function($id) {
		$_GET["id"] = $id;
	  	call_user_func_array(["AccountController", "orderDetail"],[]);
	}, 'order-detail');

	// trang danh mục
	// không đực dùng slug-name do không được đặt tên biến có dấu -
	$router->map('GET', '/danh-muc/[*:slugName]-[i:categoryId]', function($slugName, $categoryId) {
		$_GET["category_id"] = $categoryId;
	  	call_user_func_array(["ProductController", "list"],[]);
	}, 'category');
	// khoảng giá
	$router->map('GET', '/khoang-gia/[*:priceRange]', function($priceRange) {
		$_GET["price-range"] = $priceRange;
	  	call_user_func_array(["ProductController", "list"],[]);
	}, 'price-range');
	// Tìm kiếm
	$router->map('GET', '/search', function() {
	  	call_user_func_array(["ProductController", "list"],[]);
	}, 'search');
	
	// match current request url
	$match = $router->match();
	$routeName = $match["name"];
	// call closure or throw 404 status
	if( is_array($match) && is_callable( $match['target'] ) ) {
		call_user_func_array( $match['target'], $match['params'] ); 
	} else {
		// no route was matched
	
	$c = !empty($_GET["c"]) ? $_GET["c"] : "home";
	$a = !empty($_GET["a"]) ? $_GET["a"] : "list";
	$controller = ucfirst($c) . "Controller";
	$controller = new $controller();
	$controller->$a();
	}
 ?>