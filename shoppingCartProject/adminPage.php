<?php
//session_start();
if($_SESSION['adminUsername'] == NULL || !isset($_SESSION['adminUsername']))
{
	header('location: adminLogin.php');
}

require_once("db.php");
require_once("functions.php");

//images
/*
$name = $_FILES['image']['name'];
$size = $_FILES['image']['size'];
$type = $_FILES['image']['type'];

$tmp_name = $_FILES['image']['tmp_name'];


//CONTINUE WATCHING VIDEO 88


*/




global $catButton;
global $prodButton;
global $catNameText;
global $adminProdList;
global $prodInfo;
global $newAdminResults;
//CATEGORIES AREA
$aProdTable = "";

$catArea = "<form action='index.php' method='post'>";
$catArea .= "<select name='adminCatDropDown' id='adminCatDropDown'>";

$adminCatSelects = getCats($db);
	foreach($adminCatSelects as $adminCatSelect)
	{
		
		$catArea .= "<option value='" . $adminCatSelect['category'] . "'>" . $adminCatSelect['category'] . "</option>";
		
	}
	
$catArea .= "</select>";
$catArea .= "<input type='submit' class='buttonsAdmin' name='action' value='Edit'>";
$catArea .= "<input type='submit' class='buttonsAdmin' name='action' value='Delete'>";
$catArea .= "<input type='submit' class='buttonsAdmin' name='action' value='View'>";

$catArea .= "&nbsp;Category: <input type='text' name='catName' id='catName' value='" . $catNameText . "'>";
$catArea .= "<br /><br /><input type='submit' class='buttons' name='action' value='" . $catButton . "'>";
$catArea .= "</form>";

//setting productinfo to empty string
$productInfo = [ 'product' => "",
				'price' => "",
				'image' => ""
	
];

//PRODUCT AREA
$prodArea = "<form action='index.php' method='post'>";
$prodArea .= "Product Name: <input type='text' name='prodName' id='prodName' value='".$prodInfo['product'] ."'>";
$prodArea .= "<br />Category: <select name='adminCatDropDown2'>";
	foreach($adminCatSelects as $adminCatSelect)
	{
		$prodArea .= "<option value='" . $adminCatSelect['category'] . "'>" . $adminCatSelect['category'] . "</option>";
	}
$prodArea .= "</select>";
$prodArea .= "<br />Price: $<input type='text' name='price' id='price' value='".$prodInfo['price']."'>";
$prodArea .= "<br />Image: <input type='file' name='image' id='image' value='".$prodInfo['image'] ."'>";
$prodArea .= "<input type='hidden' name='updateProdID' value='" . $prodInfo['product_id'] ."'>";
$prodArea .= "<br /><input name='action' type='submit' class='buttons' value='".$prodButton."'>";
$prodArea .= "</form>";

//displaying products in table after view button clicked
$aProdTable = "<div id='aProdTableDiv'>";
$aProdTable .= "<form action='index.php' method='get'><table>";
	if(isset($adminProdList))
	{
	foreach($adminProdList as $adminProdListItem)
	{
		$aProdTable .= "<tr>";
		$aProdTable .= "<td>Product_ID: ".$adminProdListItem['product_id'] . "</td><td>".$adminProdListItem['product'] . "</td><td>Price : $".$adminProdListItem['price'] . "</td><td><img src='".$adminProdListItem['image'] ."' class='displayImages'></td><input type='hidden' name='adminProdListItemID' value='".$adminProdListItem['product_id']."'/><td><a href='?eid=".$adminProdListItem['product_id']."&action=editProduct'>Edit Product</a></td><td><a href='?did=".$adminProdListItem['product_id']."&action=deleteProduct'>Delete Product</a></td></form>";
		$aProdTable .= "</tr>";
	}
	}
$aProdTable .= "</table>";
$aProdTable .= "</div>"; // aProdTableDiv CLOSE


//ADD NEW ADMIN Area
$addNewAdmin = "<form action='index.php' method='post'>";
$addNewAdmin .= "<table>";
if(isset($newAdminResults))
{
	$addNewAdmin .= "$newAdminResults";
}
$addNewAdmin .= "";
$addNewAdmin .= "<tr><td>New Admin Username: <input type='text' name='newAuName'></td></tr>";
$addNewAdmin .= "<tr><td>New Admin Password: <input type='text' name='newApw'></td></tr>";
$addNewAdmin .= "<tr><td><input type='submit' name='action' class='buttonsAdmin' value='Add New Admin'>";
$addNewAdmin .= "</td></tr></table></form>";


//ORDERS AREA
$ordersTable = "";
$orders = "<h2> View Orders </h2>";

//DISPLAYING ORDER TABLE FOR ADMIN
/*
if(isset($orderDisplay))
{
	$orders .= "<table>";
	foreach()
	$orders .= "</table>";

}*/

//looping through orders from db
global $adminOrders;
global $itemsArray;
$orders .= "<form action='index.php' method='get'>";
$orders .= "<input type='submit' class='buttons' name='action' value='View Orders'>";
$orders .= "</form>";

if(isset($adminOrders))
{
	$ordersTable .= "<form action='index.php' method='post'><table class='aOrderTables'>";
	foreach($adminOrders as $adminOrder){
		
		$ordersTable .= "<tr><td>Order_ID: " . $adminOrder['order_id'] . "</td>";
		$ordersTable .= "<td>Customer_ID: " . $adminOrder['customer_id'] . "</td>";
		$ordersTable .= "<td>Ship Date: " . $adminOrder['shipDate'] . "</td>";
		$ordersTable .= "<td>Tax: " . $adminOrder['tax'] . "</td>";
		$ordersTable .= "<td>Total Price: " .$adminOrder['totalPrice'] . "</td>";
		$ordersTable .= "<input type='hidden' name='getOrderitemsID' value='".$adminOrder['order_id'] . "'>";
		$ordersTable .= "<td><input type='submit' class='buttonsAdmin' name='action' value='View Order Items'></td>";
		//$ordersTable .= "<td><a href='?id=" .$adminOrder['order_id'] . "&action=viewOrderItems'>View Order Items</a></td>";
		$ordersTable .= "</tr></form>";
	}
	$ordersTable .= "</table>";
	
	
}//if(isset) CLOSE

if(isset($itemsArray))
	{
		$orderItems = "<table class='aOrderTables'>";
		foreach($itemsArray as $item)
		{
			$orderItems .= "<tr><h2>Order Details <h2></tr>";
			$orderItems .= "<tr><td>Order_id: " .$item['order_id'] . "</td>";
			$orderItems .= "<td>Orderitems_id: " .$item['orderItems_id'] . "</td>";
			$orderItems .= "<td>Customer_id: " .$item['customer_id'] . "</td>";
			$orderItems .= "<td>Product_id: " .$item['product_id'] . "</td>";
			$orderItems .= "<td>Product Price: " .$item['productPrice'] . "</td>";
			$orderItems .= "<td>Quantity: " .$item['quantity'] . "</td></tr>";
		}
		$orderItems .= "</table>";
		
	}
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
			<?php //echo "catAdminDropDown: ";
			//var_dump($catAdminDropDown);
			//echo "catNameText: "; 
			//var_dump($catNameText)?>
			<div id="adminProductsDiv">
			<h2>Products</h2>
			<?php echo $prodArea ?>
			</div> <!-- adminProductsDiv div CLOSE -->
			<div id="adminCatsDiv">
			<h2>Categories</h2>
			<?php echo $catArea ?>
			</div> <!-- adminCatsDiv div CLOSE -->
			<div id="addNewAdminDiv">
			<h2>Add New Admin</h2>
			<?php echo $addNewAdmin; ?>
			</div> <!-- addNewAdminDiv CLOSE -->
				<?php  ?>
			<div id="adminProdDisplayDiv">
			<?php echo $aProdTable ?>
			</div> <!-- adminProdDisplayDiv CLOSE --> 
			<div id="ordersDiv">
				<?php echo $orders ?>
				<?php 
					if(isset($adminOrders))
					{
						echo $ordersTable;
						
					}
					if(isset($itemsArray))
						{
							echo $orderItems;
						}
					
				?>
			</div> <!-- ordersDiv CLOSE -->
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>