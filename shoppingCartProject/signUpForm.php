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
			<a href="cart.php" class="navLinks">Cart</a>
			</div> <!-- navLinksDiv CLOSE -->
			
			
			<div id="signUpLinksDiv">
			<a href="signIn.php" class="signUpLinks">Sign In</a>
			<a href="signUpForm.php" class="signUpLinks">Sign Up!</a>
			</div> <!-- signUpDiv div CLOSE -->
			
			</div> <!-- navBar div CLOSE -->
			</div> <!-- header div CLOSE -->
			<div id="mainContent">
			
			<div id="signUpFormDiv">
			<form action="index.php" method="get">
			<!-- log in textboxes etc -->
			Email: <input type="text" name="EmailSignUp" /><br>
			Password: <input type="text" name="PasswordSignUp" /><br>
			<input type="submit" name="action" value="Sign Up">
			
			</form>
			</div> <!-- signUpFormDiv div CLOSE -->
			
			<a href="signIn.php" class="signUpLinks">Sign In</a>
			</div> <!-- mainContent div CLOSE -->
			<div id="footer">
			<p>Steph's Store | Copyright&copy;2018 </p>
			</div> <!-- footer div CLOSE -->
			</div> <!-- container div CLOSE -->
		</body>
	
<html>