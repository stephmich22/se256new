<?php





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
			<a href="?action=admin" class="signUpLinks">Admin Area</a>
			</form>
			</div> <br /><!-- signUpDiv div CLOSE -->
			
			</div> <!-- navBar div CLOSE -->
			</div> <!-- header div CLOSE -->
			<div id="mainContent">
			<!-- log in textboxes etc -->
			<div id="signUpFormDiv">
			<form action="index.php" method="post">
			<!-- log in textboxes etc -->
			<table>
				<tr>
					<td>Email: </td><td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td>Password: </td><td><input type="password" name="password"></td>
				</tr>
				<tr>
					<td><input type="submit" name="action" value="Login"></td>
				</tr>
				<tr>
					<td>&nbsp;</td><td></td>
				</tr>
			</table>
			
			
			</form>
			</div> <!-- signUpFormDiv div CLOSE -->
			<a href="signUpForm.php" class="signUpLinks">Sign Up</a>
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>