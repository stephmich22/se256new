<?php
if($_SESSION['username'] == NULL || !isset($_SESSION['username']))
{
	header('location: signIn.php');
}
require_once("functions.php");
require_once("db.php");

$welcome = "<h3>Welcome, " .$_SESSION['fname'] . "!</h3>";

$viewOrders = "";

if(isset($viewMyOrders))
{
	$viewOrders .= "<form action='index.php' method='post'><table>";
	foreach($viewMyOrders as $viewMyOrder)
	{
	$viewOrders .= "<tr><td>Order_ID: " .$viewMyOrder['order_id'] ."</td>";
	$viewOrders .= "<td>Ship Date: " . $viewMyOrder['shipDate'] . "</td>";
	$viewOrders .= "<td>Tax: " . $viewMyOrder['tax'] . "</td>";
	$viewOrders .= "<td>Total Price: " . $viewMyOrder['totalPrice'] . "</td>";
	$viewOrders .= "<input type='hidden' name='custGetOrderitemsID' value='".$viewMyOrder['order_id'] . "'>";
	$viewOrders .= "<td><input type='submit' class='buttonsAdmin' name='action' value='View Order Details'></td></tr>";
	
	
	}//foreach CLOSE
	
	$viewOrders .= "</table></form>";
}//if(isset) CLOSE 

if(isset($custItemsArray))
{
	$viewOrderItems = "<table>";
	foreach($custItemsArray as $custItem)
	{
		$viewOrderItems .= "<tr><td>Order_id: " . $custItem['order_id'] . "</td>";
		$viewOrderItems .= "<td>Orderitems_id: " .$custItem['orderItems_id'] . "</td>";
		$viewOrderItems .= "<td>Customer_id: " . $custItem['customer_id'] . "</td>";
		$viewOrderItems .= "<td>Product_id: " . $custItem['product_id'] . "</td>";
		$viewOrderItems .= "<td>Product Price: " . $custItem['productPrice'] . "</td>";
		$viewOrderItems .= "<td>Quantity: " . $custItem['quantity'] . "</td></tr>";
	}
	
	$viewOrderItems .= "</table>";
} //if (isset) CLOSE
$custSideTable = "<table id='custSideTable'>";
$custSideTable .= "<tr><td><form action='index.php' method='get'><input type='submit' class='buttons' name='action' value='View My Orders'></form></td></tr>";
$custSideTable .= "</table>";



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
			<h1>Shopping Cart Project</h1>
			
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
			<div id="custTablesDiv">
			<?php
				echo $welcome;
				echo $viewOrders;
				if(isset($custItemsArray))
				{
					echo $viewOrderItems;
				}
				
			?>
			</div> <!-- custTablesDiv CLOSE -->
			<div id="custSideContentDiv">
			<?php
				echo $custSideTable;
			?>
			</div> <!-- custSideContent div CLOSE -->
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>