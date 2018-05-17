<?php
require_once("db.php");
require_once("functions.php");
//require_once("index.php");


/*
TABLES:
	
	USERS- user_id, email, password, created
	CATEGORIES- category_id, category     oils[0], tea[1], teacups[2];
	PRODUCTS- product_id, category_id, product, price, image
*/	
		$home = "";
		$categories = "<div id='catsDiv'>";
		$categories .= "<h2>Browse Products</h2>";
		$categories .= "<form action='index.php' method='get'>";
		$categories .= "<select name='categoryDropDown'>";
		$categories .="<option value='hi'>Category</option>";

	$catSelections = getCats($db);
			foreach($catSelections as $catSelection)
			{
				
				$categories .= "<option value='" . $catSelection['category_id'] . "'>" . $catSelection['category'] . "</option>";
				
			}
		
		$categories .="</select>";
		$categories .= "<input type='submit' name='action' value='Products'/>";
		$categories .= "</form>";
		$categories .= "</div>"; //catsDiv CLOSE
		
		//----------- product display 
		global $productList;
		$category = filter_input(INPUT_GET, 'categoryDropDown', FILTER_SANITIZE_STRING) ?? NULL;
		
		$products = "<form action='index.php' method='get'>";
		//var_dump($productList);
		
		
		
	if($category !== 'hi')
	{
		if($category !== NULL)
		{
			$products .= "<div id='tableDiv'>";
			$products .= "<table>";
		
			foreach($productList as $product)
			{
				$products.= "<tr><td>Product: " . $product['product'] . "</td><td>Price : " . $product['price'] . "</td><td><img class='displayImages' src='" . $product['image'] . "'></td><td><a href='?id=" . $product['product_id'] . "&action=AddToCart'>Add To Cart</a></td></tr>";
			}
			
		
			$products .= "</table>";
			$products .= "</div>"; //tableDiv CLOSE
		}
	}
		else {
			$home .= "<div id='homePicDiv'>";
			$home .= "<img src='images/homeBG.png' id='homePic'>";
			$home .= "</div>"; //homePicDiv CLOSE
			
		}
		$products .= "</form>";
	
		

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
			<a href="products.php" class="navLinks">Home</a>
			<a href="cart.php" class="navLinks">Cart</a>
			</div> <!-- navLinksDiv CLOSE -->
			
			<div id="signUpLinksDiv">
			<a href="adminPage.php" class="signUpLinks">Admin Login</a>
			</div> <!-- signUpDiv div CLOSE -->
			
			</div> <!-- navBar div CLOSE -->
			</div> <!-- header div CLOSE -->
			<div id="mainContent">
				<?php
					echo $categories;
					echo $home ?>
				<?php 
				if($category !== NULL || $category !== "")
				{
					echo $products; 
				} ?>
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>