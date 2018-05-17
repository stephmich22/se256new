<?php
require_once("db.php");
require_once("functions.php");

//CATEGORIES AREA

$catArea = "<form action='index.php' method='get'>";
$catArea .= "<select name='adminCatDropDown'>";

$adminCatSelects = getCats($db);
	foreach($adminCatSelects as $adminCatSelect)
	{
		$catArea .= "<option value='" . $adminCatSelect['category_id'] . "'>" . $adminCatSelect['category'] . "</option>";
	}
	
$catArea .= "</select>";
$catArea .= "<input type='submit' name='action' value='Edit'>";
$catArea .= "<input type='submit' name='action' value='Delete'>";
$catArea .= "<input type='submit' name='action' value='view'>";
$catArea .= "</form>";

$catArea .= "<form action='index.php' method='post'>";
$catArea .= "Category: <input type='text' name='catName' id='catName'>";
$catArea .= "<br /><br /><input type='submit' name='action' value='Add Category'>";
$catArea .= "</form>";
//PRODUCT AREA
$prodArea = "<form action='index.php' method='post'>";
$prodArea .= "Product Name: <input type='text' name='prodName' id='prodName'>";
$prodArea .= "<br />Category: <select name='adminCatDropDown2'>";
	foreach($adminCatSelects as $adminCatSelect)
	{
		$prodArea .= "<option value='" . $adminCatSelect['category_id'] . "'>" . $adminCatSelect['category'] . "</option>";
	}
$prodArea .= "</select>";
$prodArea .= "<br />Price: $<input type='text' name='price' id='price'>";
$prodArea .= "<br />Image: <input name='image' id='image' type='file'>";
$prodArea .= "<br /><input name='action' type='submit' value='Add Product'>";
$prodArea .= "</form>";










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
			<a href="signIn.php" class="signUpLinks">Admin Login</a>
			</div> <!-- signUpDiv div CLOSE -->
			
			</div> <!-- navBar div CLOSE -->
			</div> <!-- header div CLOSE -->
			<div id="mainContent">
			<div id="adminProductsDiv">
			<h2>Products</h2>
			<?php echo $prodArea ?>
			</div> <!-- adminProductsDiv div CLOSE -->
			<div id="adminCatsDiv">
			<h2>Categories</h2>
			<?php echo $catArea ?>
			</div> <!-- adminCatsDiv div CLOSE -->
				<?php  ?>
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>