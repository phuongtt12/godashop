<?php 
	class HomeController {
		function list() {
			$productRepository = new ProductRepository();
			$conds = [];
			$sorts = ["featured" => "DESC"];
			$page = 1;
			$product_per_page = 4;
			
			$featuredProducts = $productRepository->getBy($conds, $sorts, $page, $product_per_page);
			$sorts = ["created_date" => "DESC"];
			$latestProducts = $productRepository->getBy($conds, $sorts, $page, $product_per_page);

			$categoryRepository = new CategoryRepository();
			$categories = $categoryRepository ->getAll();
			$categoryProducts = [];
			foreach ($categories as $category) {
				$conds = [
					"category_id" => [
						"type" => "=",
						"val"  => $category->getId()
					]
				];
				$products = $productRepository->getBy($conds, $sorts, $page, $product_per_page);
				$categoryProducts[$category->getName()] = $products;
			}
			require ABSPATH_SITE . "view/home/list.php";
		}
	}
 ?>