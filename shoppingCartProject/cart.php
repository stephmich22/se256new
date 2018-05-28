<?php
//first starting session variable
//session_start();
require_once("db.php");
require_once("functions.php");
global $cartProduct;
$p_id = $cartProduct['product_id'];
$p_price = $cartProduct['price'];
$p_category_id = $cartProduct['category_id'];
$p_product = $cartProduct['product'];
$p_image = $cartProduct['image'];
$emptyCart = "";
$cartIsEmpty = ""; // cart page display if nothing is in the cart
$priceTotal=0;
$productPrices= array();
$cartSubtotal = 0;



?>
<?php 

//emptying cart
$emptyCart .= "<a href='?action=EmptyCart' class='cartLinks'>| Empty Cart</a>";
/*$emptyCart .= "<form action='index.php' method='post'>";
$emptyCart .= "<input type='submit' class='buttons' name='action' value='Proceed to Checkout'></br></form>";*/

if(isset($cartProduct) || isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
	$found = false;
	$i = 0;
	
	$cartHeading = "<h2>Your Cart</h2>";
	
	//if cart var is not set or cart array is currently empty
	if(!isset($_SESSION["cart"])) {
		$_SESSION["cart"] = array(0=>array("product_id" => $p_id, "category_id" => $p_category_id, "product" => $p_product, "price" => $p_price, "image" => $p_image, "quantity" => 1));
		
		//$_SESSION["cart"] = array(1=>$cartProduct);
	} else {
		//this is if the cart has at least one item in item
	if($cartProduct['product_id'] !== NULL)
	{
		foreach($_SESSION["cart"] as $item) {
			$i++;
				//if item is already in the cart
				if($item['product_id'] == $p_id) 
				{ array_splice($_SESSION["cart"],$i-1,1,array(array("product_id" => $p_id, "category_id" => $p_category_id, "product" => $p_product, "price" => $p_price, "image" => $p_image, "quantity" => $item['quantity'] + 1)));
					$found = true; 
					
				}//if id == id CLOSE
		}//foreach CLOSE
		if($found == false) //push item into cart array
		{
			array_push($_SESSION["cart"], array("product_id" => $p_id, "category_id" => $p_category_id, "product" => $p_product, "price" => $p_price, "image" => $p_image, "quantity" => 1));
		}
	}//if !==NULL CLOSE
	
		
		
	}//else at least one item in cart CLOSE
	
	//header("location: cart.php");
	
	//index
	$i = 0;
	$table = "<form action='index.php' method='POST'>";
	$table .= "<table id='cartTable'>";
		foreach($_SESSION["cart"] as $cartProduct)
		{
			if($cartProduct['product_id'] !== NULL)
			{
				
				$priceTotal = $cartProduct['price'] * $cartProduct['quantity'];
				array_push($productPrices, $priceTotal);
				
			$table .= "<tr><td><b>Product_ID: </b>" . $cartProduct['product_id'] . "</td><td>" . $cartProduct['product'] ."</td><td>" ."$". $cartProduct['price'] . "</td><td><img class='displayImages' src='"  . $cartProduct['image'] .  "'></td><td>Quantity: <input type='text' name='quantity' id='quantity' value='" . $cartProduct['quantity'] . "' maxlength='3'><br /><input type='submit' class='buttonsAdmin' name='action' value='Update Quantity'><input type='hidden' name='btnQuantity' id='btnQuantity' value='". $cartProduct['product_id'] . "'></form></td><td>Total Price: <br />" . "$" .$priceTotal ."</td><td><form action='index.php' method='POST'><input type='submit' class='buttonsAdmin' name='action' value='Remove'><input type='hidden' name='removalID' id='removalID' value='". $i . "'></form></td></tr>";
			
		//	array_push($productInfo, array("product_id" => $cartProduct['product_id'], "quantity" => $cartProduct['quantity'], "price" => $cartProduct['price']));
			
			$i++;
			}
		}//foreach CLOSE
		$table .= "</table>";
	
	
	
}//if product was clicked to get to cart page CLOSE

else {
	$cartHeading = "<h2>Your Cart is Empty :(</h2>";
	$cartIsEmpty = "<div id='emptyCartDiv'><image src='images/emptyCart.png' id='emptyCartPic' /></div>";
	
	
}

//header("location: cart.php");

//VARIABLES FOR TOTALING
$cartSubtotal = array_sum($productPrices);
$tax = number_format($cartSubtotal * 0.07, 2, '.', '');
$_SESSION['tax'] = $tax;
$_SESSION['cartSubtotal'] = number_format($cartSubtotal, 2, '.','');
$cartTotal = $cartSubtotal + $tax;
$grandTotal = number_format($cartTotal, 2, '.', '');

?>

<?php /*
	if (isset($_GET['task']) && $_GET['task'] == "EmptyCart") {
    unset($_SESSION["cart"]);
}*/

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
			
			<?php if(!isset($_SESSION['username']) || $_SESSION['username'] == NULL)
			{
				echo "<form action='index.php' method='get'><a href='?action=SignUp' class='signUpLinks'>Sign Up! |</a>";
			}?>
			<a href="?action=CustPage" class="signUpLinks">My Account |</a>
			<a href="?action=Admin" class="signUpLinks">Admin Area </a></form>
			
			</div> <br /><!-- signUpDiv div CLOSE -->
			
			</div> <!-- navBar div CLOSE -->
			</div> <!-- header div CLOSE -->
			<div id="mainContent">
			
			<?php 
			
			echo $cartHeading;
			echo $cartIsEmpty;
				if(isset($_SESSION["cart"])) {
				//echo count($_SESSION["cart"]);
				echo $table;
				}
			 ?>
			<p><?php// if(isset($_SESSION["cart"])) {
				//echo "cart: "; var_dump($_SESSION["cart"]); 
			//}?></p>
			<form action='index.php' method='POST'>
			<div id='checkOutButtonDiv'>
			<input type="hidden" name="tax" value="<?php echo $tax ?>">
			<input type="hidden" name="totalPrice" value="<?php echo $cartSubtotal ?>">
			<div id="totalsDiv"><p><?php if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0)
			{
				echo "<b>Subotal: </b>" ."$". $cartSubtotal . "<br />";
				echo "<b>Tax:</b> " ."$". $tax . "<br />";
				echo "<b>Total: </b>" ."$". $grandTotal;
			
				?></p></div> <!-- totalsDiv CLOSE -->
			<input type='submit' name='action' value='Proceed to Checkout' class='buttons'><?php } ?>
			</div> <!-- checkOutButtonDiv CLOSE -->
			</form>
			<div id='cartLinksDiv'>
			
			<a href="products.php" class="cartLinks"> Continue Shopping</a>
			<?php if(isset($_SESSION["cart"]) && count($_SESSION["cart"]) > 0) {
				echo $emptyCart;
			}?>
			</div> <!-- cartLinks CLOSE -->
			<?php //var_dump($productInfo);?>
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>