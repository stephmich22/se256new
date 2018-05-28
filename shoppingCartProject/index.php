<?php
session_start();
	/*
		Controller
		
		TABLES: 
		
	USERS- user_id, email, password, created
	CATEGORIES- category_id, category
	PRODUCTS- product_id, category_id, product, price, image
	*/
require_once("db.php");
require_once("functions.php");

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
	
//TABLE VARS
$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT) ?? null;
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT) ?? null;
$product = filter_input(INPUT_POST, 'prodName', FILTER_SANITIZE_STRING) ?? "";
$addProdCatId =  filter_input(INPUT_POST, 'adminCatDropDown2', FILTER_SANITIZE_STRING) ?? "";
$price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING) ?? "";
$image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_STRING) ?? "";

$catAdminDropDown =  filter_input(INPUT_POST, 'adminCatDropDown', FILTER_SANITIZE_STRING) ?? "";

$catNameText = filter_input(INPUT_POST, 'catName', FILTER_SANITIZE_STRING) ?? NULL;

$p_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;

$category = filter_input(INPUT_GET, 'categoryDropDown', FILTER_SANITIZE_STRING) ?? NULL;

$productEditID = filter_input(INPUT_GET, 'eid', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'eid', FILTER_VALIDATE_INT) ?? null;

$updateProd_id = filter_input(INPUT_GET, 'updateProdID', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'updateProdID', FILTER_VALIDATE_INT) ?? null;

$productDeleteID = filter_input(INPUT_GET, 'did', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'did', FILTER_VALIDATE_INT) ?? null;

$adminCat = [
			'category' =>""];
			
$adminProd = ['product' =>"",
			'price' =>"",
			'image'=>""];
			
$catButton = "Add Category";
$prodButton = "Add Product";

//login stuff
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? NULL;
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING) ?? NULL;

if(isset($_SESSION['customer_id']))
{
	$sessionCust_id = $_SESSION['customer_id'];
}

//getting info to insert into orderitems table
//$productInfo = array();

//$tax
if(isset($_SESSION['tax']))
{
	$tax = $_SESSION['tax'];
}
//$totalPrice
if(isset($_SESSION['cartSubtotal']))
{
$cartSubtotal = $_SESSION['cartSubtotal'];
}


//SIGN UP FORM STUFF
$SUfname = filter_input(INPUT_POST, 'SUfname', FILTER_SANITIZE_STRING) ?? NULL;
$SUlname = filter_input(INPUT_POST, 'SUlname', FILTER_SANITIZE_STRING) ?? NULL;
$SUemail = filter_input(INPUT_POST, 'SUemail', FILTER_SANITIZE_STRING) ?? NULL;
$SUpw = filter_input(INPUT_POST, 'SUpw', FILTER_SANITIZE_STRING) ?? NULL;

//admin login
$aEmail = filter_input(INPUT_POST, 'Aemail', FILTER_SANITIZE_STRING) ?? NULL;
$aPassword = filter_input(INPUT_POST, 'Apassword', FILTER_SANITIZE_STRING) ?? NULL;

//NEWADMIN
$aUnameNew = filter_input(INPUT_POST, 'newAuName', FILTER_SANITIZE_STRING) ?? NULL;
$aPWNew = filter_input(INPUT_POST, 'newApw', FILTER_SANITIZE_STRING) ?? NULL;

//getting items 
$adminGetOrderItems = filter_input(INPUT_GET, 'getOrderitemsID', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'getOrderitemsID', FILTER_VALIDATE_INT) ?? null;
$custGetOrderItems = filter_input(INPUT_GET, 'custGetOrderitemsID', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'custGetOrderitemsID', FILTER_VALIDATE_INT) ?? null;




switch($action) {
	
	default:
	include("products.php");
	break;
	
	case "View Products":
	if($category == 'hi')
	{
		include_once("products.php");
	}
	$productList = getProducts($db, $category);
//	var_dump($productList);
	include_once("products.php");
	//var_dump($category);
	break;
	
	case "Add Product":
	$sql = addProduct($db, $addProdCatId, $product, $price, $image);
	include_once('adminPage.php');
	//var_dump($sql);
	break;
	
	case "Add Category":
	addCategory($db, $catNameText);
	include("adminPage.php");
	break;
	
	case "AddToCart":
	$cartProduct = getProduct($db,$p_id);
	if(isset($_SESSION['cart']))
	{
		$cartProdStuff = getProductIds($_SESSION['cart'], $productInfo);
		//var_dump($cartProdStuff);
	}
	//var_dump($_SESSION['cart']);
	//echo $p_id;
	//echo $price;
	include_once("cart.php");
	if(isset($_SESSION['tax'])) {
	//var_dump($_SESSION['tax']);
}
	break;
	
	case "EmptyCart":
	if(isset($_SESSION["cart"]))
	{
		
		include_once("cart.php");
		unset($_SESSION["cart"]);
		$cartProduct = "";
		//var_dump($_SESSION["cart"]);
	}
	include_once("cart.php");
	break;
	
	//CATEGORY BUTTONS
	case "Edit":
	$catNameText = $catAdminDropDown;
	$catAdminDropDown = $catAdminDropDown;
	$catButton = "Update";
	$prodButton = "Add Product";
	include_once("adminPage.php");
	//var_dump($productInfo);
	break;
	
	case "Update":
	$results = updateCategory($db, $catNameText, $catAdminDropDown);
	$catButton = "Add Category";
	$prodButton = "Add Product";
	$catNameText = "";
	include_once("adminPage.php");
	//var_dump($catNameText);
	//var_dump($results);	
	break;
	
	case "Delete":
	deleteCategory($db,$catAdminDropDown);
	include_once('adminPage.php');
	break;
	
	//NAV BAR LINKS
	
	case "Admin":
	$catButton = "Add Category";
	$prodButton = "Add Product";
	include_once("adminPage.php");
	break;
	
	case "CustPage":
	include_once("index.php");
	include_once("custPage.php");
	break;
	
	case "Cart":
	include_once("index.php");
	include_once("cart.php");
	break;
	
	case "SignUp":
	include_once("index.php");
	include_once("signUpForm.php");
	break;
	
	
	case "View":
	$adminProdList = adminViewProducts($db,$catAdminDropDown);
	$catButton = "Add Category";
	$prodButton = "Add Product";
	include_once("adminPage.php");
	//var_dump($adminProdList);
	break;
	
	case "Remove":
	$removalID = $_POST['removalID'];
	include_once("cart.php");
	if(isset($_SESSION["cart"]))
	{
		if(count($_SESSION["cart"]) <= 1)
		{
			unset($_SESSION["cart"]);
		} else {
			unset($_SESSION["cart"][$removalID]);
			sort($_SESSION["cart"]);
		}
	}
	break;
	
	case "Update Quantity":
	include_once("cart.php");
	$btnQuantity = $_POST['btnQuantity'];
	$quantityText = $_POST['quantity'];
	if(isset($_POST['btnQuantity']) && $_POST['btnQuantity'] != "")
	{
		$i = 0;
		if($cartProduct['product_id'] !== NULL) 
		{
		foreach($_SESSION["cart"] as $item) {
			$i++;
				//if item is already in the cart
				if($item['product_id'] == $btnQuantity) 
				{ array_splice($_SESSION["cart"],$i,1,array(array("product_id" => $item['product_id'], "category_id" => $item['category_id'], "product" => $item['product'], "price" => $item['price'], "image" => $item['image'], "quantity" => $quantityText)));
					//$found = true; 
					
				}//if id == id CLOSE
		}//foreach CLOSE
		}//if !== NULL CLOSE
	}
	//var_dump($btnQuantity);
	//var_dump($quantityText);
	//var_dump($i);
	break;
	
	case "editProduct":
	$prodInfo = getProduct($db,$productEditID);
	$prodButton = "Update Product";
	include_once("adminPage.php");
	//var_dump($prodInfo);
	//var_dump($productEditID);
	break;
	
	case "Update Product":
	include_once("adminPage.php");
	$sql = updateProduct($db, $addProdCatId, $product, $price, $image, $updateProd_id);
	var_dump($sql);
	var_dump($productEditID);
	break;
	
	case "deleteProduct":
	deleteProduct($db,$productDeleteID);
	include_once("adminPage.php");
	break;
	
	case "Proceed to Checkout":
	include_once("checkOut.php");
	break;
	
	case "Login":
	$results = login($db, $email, $password);
	if(count($results) == 1) {
		$_SESSION['username'] = $email;
		foreach($results as $result)
		{
			$customer_id = $result['customer_id'];
			$customerFName = $result['fname'];
			$customerLName = $result['lname'];
		}
		$_SESSION['customer_id'] = $customer_id;
		$_SESSION['fname'] = $customerFName;
		$_SESSION['lname'] = $customerLName;
		//header('location: cart.php');
		include_once("cart.php");
	}
	else {
		echo "Sorry, invalid login credentials.";
		include_once("signIn.php");
	}
	
	//var_dump($results);
	//var_dump($_SESSION['username']);
	break;
	
	case "Place Order":
	$last_id = addToOrders($db,$sessionCust_id,$tax, $cartSubtotal);
	//var_dump($last_id);
	$productInfo = getProductIds($_SESSION['cart']);
	//var_dump($productInfo);
	addToOrderItems($db, $productInfo, $last_id, $sessionCust_id);
	if(isset($_SESSION['cart']))
	{
		unset($_SESSION["cart"]);
	}
	include_once("custPage.php");
	//unset($_SESSION["cart"]);
	break;
	
	case "Sign Up":
	addCustomer($db, $SUfname, $SUlname, $SUemail, $SUpw);
	include_once("cart.php");
	break;
	
	case "Login As Admin":
	$results = loginAdmin($db, $aEmail, $aPassword);
	if(count($results) == 1) {
		$_SESSION['adminUsername'] = $aEmail;
	//	var_dump($results);
		include_once("adminPage.php");
	}
	else {
		echo "Sorry, invalid login credentials.";
		include_once("adminLogin.php");
	}
	break;
	
	//case view my orders (for customer)
	case "View My Orders":
	$viewMyOrders = viewMyOrders($db,$_SESSION['customer_id']);
	include_once("custPage.php");
	//var_dump($viewMyOrders);
	break;
	
	case "View Order Details":
	$custItemsArray = viewOrderItems($db, $custGetOrderItems);
	//var_dump($custGetOrderItems);
	//var_dump($custItemsArray);
	include_once("custPage.php");
	break;
	
	case "View Orders": 
	$adminOrders = viewAllOrders($db);
	include_once("adminPage.php");
	//var_dump($adminOrders);
	break;
	
	case "View Order Items":
	$itemsArray = viewOrderItems($db, $adminGetOrderItems);
	//var_dump($adminGetOrderItems);
	//var_dump($itemsArray);
	include_once("adminPage.php");
	break;
	
	case "Add New Admin":
	$newAdminResults = addAdmin($db,$aUnameNew,$aPWNew);
	include_once("adminPage.php");
	break;
	
	//logouts 
	
	case "adminLogout":
	if(isset($_SESSION['adminUsername']))
	{
		unset($_SESSION['adminUsername']);
	}
	include_once("products.php");
	break;
	
	case "custLogout":
	if(isset($_SESSION['username']))
	{
		unset($_SESSION['username']);
	}
	include_once("products.php");
	break;
	
}//switch


?>
