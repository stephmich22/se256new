<?php
//session_start();
if($_SESSION['username'] == NULL || !isset($_SESSION['username']))
{
	header('location: signIn.php');
}
require_once("functions.php");
require_once("db.php");



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
			<a href="?action=signUp" class="signUpLinks">Sign Up! |</a>
			<a href="?action=custPage" class="signUpLinks">My Account |</a>
			<a href="?action=admin" class="signUpLinks">Admin Area </a>
			</form>
			</div> <br /><!-- signUpDiv div CLOSE -->
			
			</div> <!-- navBar div CLOSE -->
			</div> <!-- header div CLOSE -->
			<div id="mainContent">
			<h2>Hey there, <?php echo $_SESSION['fname'] . " " . $_SESSION['lname'] . "!"; ?> <h2>
			<p>Please enter your billing and payment information</p>
			<table>
				<tr>
					<td>Street Address: <input type="text" name="streetAddress"></td>
				</tr>
				<tr>
					<td>City: <input type="text" name="city"></td>
				</tr>
				<tr>
					<td>State: <input type="text" name="state"></td>
				</tr>
					<td>Zip Code: <input type="text" name="zipcode"></td>
				<tr>
					<td>Phone: <input type="text" name="phone"></td>
				</tr>
			</table><br /><br />
			<table>
				<tr>
					<td>Credit Card Type- </td>
				</tr>
				<tr>
					<td>Visa <input type='radio' name='dir' value='DESC'/>Mastercard<input type='radio' name='dir' value='DESC'/></td>
				</tr>
				<tr>
					<td>Credit Card Number: <input type="text" name="ccn"></td>
				</tr>
				<tr>
					<td>Expiration Date (mm/yyyy): <input type="text" name="exp"></td>
				</tr>
				<tr>
					<td>CVV2: <input type="text" name="cvv"></td>
				</tr>
			</table>
			<form action="index.php" method="post">
			<input type="submit" name="action" value="Place Order">
			</form>
			
			<?php var_dump($_SESSION['cart']);?>
			
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>