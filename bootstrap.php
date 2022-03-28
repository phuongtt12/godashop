<?php

require_once ABSPATH . "model/connectdb.php";
require_once ABSPATH . "model/base/BaseRepository.php";
require_once ABSPATH . "model/action/Action.php";
require_once ABSPATH . "model/action/ActionRepository.php";
require_once ABSPATH . "model/category/Category.php";
require_once ABSPATH . "model/category/CategoryRepository.php";
require_once ABSPATH . "model/brand/Brand.php";
require_once ABSPATH . "model/brand/BrandRepository.php";
require_once ABSPATH . "model/comment/Comment.php";
require_once ABSPATH . "model/comment/CommentRepository.php";
require_once ABSPATH . "model/customer/Customer.php";
require_once ABSPATH . "model/customer/CustomerRepository.php";
require_once ABSPATH . "model/district/District.php";
require_once ABSPATH . "model/district/DistrictRepository.php";
require_once ABSPATH . "model/order/Order.php";
require_once ABSPATH . "model/order/OrderRepository.php";
require_once ABSPATH . "model/status/Status.php";
require_once ABSPATH . "model/status/StatusRepository.php";
require_once ABSPATH . "model/orderItem/OrderItem.php";
require_once ABSPATH . "model/orderItem/OrderItemRepository.php";
require_once ABSPATH . "model/product/Product.php";
require_once ABSPATH . "model/product/ProductRepository.php";
require_once ABSPATH . "model/brand/Brand.php";
require_once ABSPATH . "model/brand/BrandRepository.php";
require_once ABSPATH . "model/imageItem/ImageItem.php";
require_once ABSPATH . "model/imageItem/ImageItemRepository.php";
require_once ABSPATH . "model/province/Province.php";
require_once ABSPATH . "model/province/ProvinceRepository.php";
require_once ABSPATH . "model/role/Role.php";
require_once ABSPATH . "model/role/RoleRepository.php";
require_once ABSPATH . "model/roleAction/RoleAction.php";
require_once ABSPATH . "model/roleAction/RoleActionRepository.php";
require_once ABSPATH . "model/staff/Staff.php";
require_once ABSPATH . "model/staff/StaffRepository.php";
require_once ABSPATH . "model/transport/Transport.php";
require_once ABSPATH . "model/transport/TransportRepository.php";
require_once ABSPATH . "model/ward/Ward.php";
require_once ABSPATH . "model/ward/WardRepository.php";
require_once ABSPATH . "model/cart/Cart.php";
require_once ABSPATH . "model/cart/CartStorage.php";
require_once ABSPATH . "model/newsletter/NewsLetter.php";
require_once ABSPATH . "model/newsletter/NewsLetterRepository.php";
require_once ABSPATH . "service/EmailService.php";
//Load Composer's autoloader
require ABSPATH . '/vendor/autoload.php';
function get_host_name() {
	return $_SERVER['HTTP_HOST'];
}

function getProtocol() {
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	return $protocol;
}

function get_domain(){
	$protocol = getProtocol();
    return $protocol . $_SERVER['HTTP_HOST'];
}
function get_domain_site(){
	
    return get_domain() . "/site";
}
function slugify($str)
{
  	$str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
}
function get_url_without_param() {
	$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
	$url = get_domain() . $uri_parts[0];
	return $url;
}
?>