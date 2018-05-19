<?php
//first starting session variable
session_start();

require_once("db.php");
require_once("functions.php");
global $cartProduct;
$p_id = $cartProduct['product_id'];
$p_price = $cartProduct['price'];
$p_category_id = $cartProduct['category_id'];
$p_product = $cartProduct['product'];
$p_image = $cartProduct['image'];

?>
<?php 

if(isset($cartProduct)) {
	$found = false;
	$i = 0;
	
	//if cart var is not set or cart array is currently empty
	if(!isset($_SESSION["cart"]) || count($_SESSION["cart"]) > 1) {
		$_SESSION["cart"] = array(1=>array("product_id" => $p_id, "category_id" => $p_category_id, "product" => $p_product, "price" => $p_price, "image" => $p_image, "quantity" => 1));
		//$_SESSION["cart"] = array(1=>$cartProduct);
	} else {
		//this is if the cart has at least one item in item
		foreach($_SESSION["cart"] as $item) {
			$i++;
				//if item is already in the cart
				if($item['product_id'] == $p_id) 
				{ 
					array_splice($_SESSION["cart"],$i-1,1,array(array("product_id" => $p_id, "category_id" => $p_category_id, "product" => $p_product, "price" => $p_price, "image" => $p_image, "quantity" => $item['quantity'] + 1)));
					$found = true;
				}//if id == id CLOSE
		}//foreach CLOSE
		if($found == false) //push item into cart array
		{
			array_push($_SESSION["cart"], array("product_id" => $p_id, "category_id" => $p_category_id, "product" => $p_product, "price" => $p_price, "image" => $p_image, "quantity" => 1));
		}
	}//else at least one item in cart CLOSE
}//if product was clicked to get to cart page CLOSE








?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
			<title>Shopping Cart</title>
			<link rel="stylesheet" href="style.css">
	</head>
	
		<body>
			<div id="container">
			
			<div id="header">
			<h1>Shopping Cart Project</h1>
			
			<div id="navBar">
			
			<p>Nav Bar</p>
			<div id="navLinksDiv">
			<a href="index.php" class="navLinks">Home</a>
			</div> <!-- navLinksDiv CLOSE -->
			
			
			<div id="signUpLinksDiv">
			<a href="signIn.php" class="signUpLinks">Sign In</a>
			<a href="signUpForm.php" class="signUpLinks">Sign Up!</a>
			</div> <!-- signUpDiv div CLOSE -->
			
			</div> <!-- navBar div CLOSE -->
			</div> <!-- header div CLOSE -->
			<div id="mainContent">
			<?php print_r($cartProduct)?>
			<h2>Your Cart</h2
			<p><?php "cart: "; print_r($_SESSION["cart"]) ?></p>
			<a href="&action=EmptyCart">Empty Cart</a>
			<a href="products.php">Continue Shopping</a>
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>