<?php 
class ProductController {
	function list() {
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();

		$conds = [];
		$sorts = [];
		$page = !empty($_GET["page"]) ? $_GET["page"] : 1;
		$product_per_page = 5;
		$productRepository = new ProductRepository();

		$category_id = !empty($_GET["category_id"]) ? $_GET["category_id"] : null;
		if ($category_id) {
			$conds = [
				"category_id" => [
					"type" => "=", 
					"val" => $category_id
				]
			];
		}
		$price_range = !empty($_GET["price-range"]) ? $_GET["price-range"] : null;
		if ($price_range) {
			$temp = explode('-', $price_range);
			$start = $temp[0];
			$end = $temp[1];
			$conds = [
				"sale_price" => [
					"type" => "BETWEEN",
					"val" => "$start AND $end"
				]
			];
			if ($end == "greater") {
				$conds = [
					"sale_price" => [
						"type" => ">=",
						"val" => $start
					]
				];
			}
		}

		$sort = !empty($_GET["sort"]) ? $_GET["sort"] : null;
		if ($sort) {
			$temp = explode('-', $sort);
			$find = $temp[0];
			$orderType = strtoupper($temp[1]);

			$mapColumn = ["price" => "sale_price", "alpha" => "name", "created" => "created_date"];
			$columnName = $mapColumn[$find];
			$sorts = [$columnName => $orderType];
		}

		$search = !empty($_GET["search"]) ? $_GET["search"] : null;
		if ($search) {
			$conds = [
				"name" => [
					"type" => "LIKE",
					"val" => "'%$search%'"
				]
			];
		}
		$products = $productRepository->getBy($conds, $sorts, $page, $product_per_page);

		$totalProducts = $productRepository->getBy($conds, $sorts);
		$totalPage = ceil(count($totalProducts) / $product_per_page);

		require ABSPATH_SITE . "view/product/list.php";
	}

	function ajaxSearch() {
		$search = $_GET["pattern"];
		$conds = [
				"name" => [
					"type" => "LIKE",
					"val" => "'%$search%'"
				]
			];
		$sorts = [];
		$productRepository = new ProductRepository();
		$products = $productRepository->getBy($conds, $sorts);
		echo count($products);
		require ABSPATH_SITE . "view/product/ajaxSearch.php";
	}
	function detail() {
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->getAll();

		$id = $_GET["id"];
		$productRepository = new ProductRepository();
		$product = $productRepository->find($id);
		$category_id = $product->getCategoryId($id);
		$category_name = $product->getCategory()->getName();
		$price_range = null;
		$conds = [
			"category_id" => [
				"type" => "=",
				"val" => $product->getCategoryId(),
			],
			"id" => [
				"type" => "!=",
				"val" => $product->getId()
			]
		];
		$relatedProducts = $productRepository->getBy($conds);
		require ABSPATH_SITE . "view/product/detail.php";
	}
}
?>