<?php
require_once("db.php");
require_once("functions.php");


/*
TABLES:
	
	USERS- user_id, email, password, created
	CATEGORIES- category_id, category     oils[0], tea[1], teacups[2];
	PRODUCTS- product_id, category_id, product, price, image
*/	
		$home = "";
		$homeTop = "";
		$categories = "<div id='catsDiv'>";
		$categories .= "<h2>Browse Products</h2>";
		$categories .= "<form action='index.php' method='get'>";
		$categories .= "<select name='categoryDropDown' id='categoryDropDown'>";
		$categories .="<option value='hi'>Category</option>";

	$catSelections = getCats($db);
			foreach($catSelections as $catSelection)
			{
				
				$categories .= "<option value='" . $catSelection['category_id'] . "'>" . $catSelection['category'] . "</option>";
				
			}
		
		$categories .="</select>";
		$categories .= "<br /><br /><input type='submit' name='action' value='View Products' id='btnViewProducts' class='buttons'/>";
		$categories .= "</form>";
		$categories .= "</div>"; //catsDiv CLOSE
		
		//----------- product display 
		global $productList;
		$category = filter_input(INPUT_GET, 'categoryDropDown', FILTER_SANITIZE_STRING) ?? NULL;
		
	//	$products = "<form action='index.php' method='post'>";
		//var_dump($productList);
		$products = "";
		
		
	if($category !== 'hi')
	{
		if($category !== NULL)
		{
			$products .= "<div id='tableDiv'>";
			$products .= "<table>";
		
			foreach($productList as $product)
			{
				$products.= "<tr><td>Product: " . $product['product'] . "</td><td>Price : " . $product['price'] . "</td><td><img class='displayImages' src='" . $product['image'] . "'></td><td><input type='hidden' name='p_id' value='" . $product['product_id'] ."' /></td><td><a href='?id=" . $product['product_id'] . "&action=AddToCart'>Add To Cart</a></td></tr>";
			}
			
		
			$products .= "</table>";
			$products .= "</div>"; //tableDiv CLOSE
		}
	}
		if($category === 'hi' || $category == NULL) {
				$homeTop .= "<div id='socialMediaDiv'><h2>Follow Us!</h2><image src='images/fBookLogo.png' class='socialMedia'/><image src='images/instaLogo.png' class='socialMedia'/><image src='images/twitterLogo.png' class='socialMedia'/></div>";
			$home .= "<div id='homePicDiv'>";
			$home .= "<h2>Welcome :)</h2>";
			$home .= "<image src='images/teapot.png'/>";
			$home .= "</div>"; //homePicDiv CLOSE
			
		}
		//$products .= "</form>";
	
		

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
			<div id='logOutsDiv'>
			<?php
			if(isset($_SESSION['adminUsername']))
			{
				
				$adminLogout = "<a href='?action=adminLogout' class='logoutLinks'>Admin Logout  |</a>";
				echo $adminLogout;
			}
			if(isset($_SESSION['username']))
			{
				$custLogout = "<a href='?action=custLogout' class='logoutLinks'>Customer Logout</a>";
				echo $custLogout;
			}
			?>
			
			</div> <!-- logOutsDiv CLOSE -->
			<h1>Steph's Tea and Such</h1>
			
			<div id="navBar">
			<div id="navLinksDiv">
			<form action="index.php" method="get"><a href="index.php" class="navLinks">Home |</a>
			<a href="?action=Cart" class="navLinks">Cart</a>
			</form>
			</div> <!-- navLinksDiv CLOSE -->
			
			<div id="signUpLinksDiv">
			<form action="index.php" method="get">
			<?php if(!isset($_SESSION['username']) || $_SESSION['username'] == NULL)
			{
				echo "<a href='?action=SignUp' class='signUpLinks'>Sign Up! |</a>";
			}?>
			
			<a href="?action=CustPage" class="signUpLinks">My Account |</a>
			<a href="?action=Admin" class="signUpLinks">Admin Area</a>
			</form>
			</div> <br /><!-- signUpDiv div CLOSE -->
			
			</div> <!-- navBar div CLOSE -->
			</div> <!-- header div CLOSE -->
			<div id="mainContent">
				<?php
					echo $homeTop;
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