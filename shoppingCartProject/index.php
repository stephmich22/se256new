<?php
	/*
		Controller
		
		TABLES: 
		
	USERS- user_id, email, password, created
	CATEGORIES- category_id, category
	PRODUCTS- product_id, category_id, product, price, image
	*/
require_once("db.php");
require_once("functions.php");

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
	
//TABLE VARS
$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT) ?? null;
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT) ?? null;
$product = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING) ?? "";
$addProdCatId =  filter_input(INPUT_GET, 'adminCatDropDown2', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'adminCatDropDown2', FILTER_VALIDATE_INT) ?? null;
$price = filter_input(INPUT_GET, 'price', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT) ?? null;
$image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING) ?? "";

$catAdminDropDown = filter_input(INPUT_GET, 'adminCatDropDown', FILTER_SANITIZE_STRING) ?? NULL;
$catNameText = filter_input(INPUT_POST, 'catName', FILTER_SANITIZE_STRING) ?? NULL;

$p_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;

$category = filter_input(INPUT_GET, 'categoryDropDown', FILTER_SANITIZE_STRING) ?? NULL;


switch($action) {
	
	default:
	include("products.php");
	break;
	
	case "View Products":
	$productList = getProducts($db, $category);
	var_dump($productList);
	include_once("products.php");
	var_dump($category);
	break;
	
	case "Add Product":
	addProduct($db, $addProdCatId, $product, $price, $image);
	include('adminPage.php');
	break;
	
	case "Add Category":
	addCategory($db, $catNameText);
	include("adminPage.php");
	break;
	
	case "AddToCart":
	$cartProduct = getProduct($db,$p_id);
	var_dump($cartProduct);
	echo $p_id;
	echo $price;
	include_once("cart.php");
	break;
}


?>

