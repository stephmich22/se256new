<?php

/*
	TABLES:
	
	USERS- user_id, email, password, created
	CATEGORIES- category_id, category
	PRODUCTS- product_id, category_id, product, price, image
	
	TABLES TO CREATE: 
	
	ADMINUSERS
	ORDERS - order_id, customer_id
	ORDERITEMS - order_id, products (containing product id)

*/




//CAT LIST
function getCats($db) {
	
	$sql = $db->prepare("SELECT * FROM categories ORDER BY category_id ASC");
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	return $results;
}
//DISPLAY PRODUCTS
function getProducts($db, $category) {
	$sql= $db->prepare("SELECT * FROM Products WHERE category_id = :category");
	$sql->bindParam(':category', $category, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	return $results;
}
function getProduct($db,$p_id)
{
	$sql = $db->prepare("SELECT * FROM Products WHERE product_id = $p_id");
	//$sql->bindParam(':p_id',$p_id, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetch(PDO::FETCH_ASSOC);
	return $results;
}


//ADMIN (if logged in) ----------------------------------------------------------

//CREDENTIALS
function addAdmin($db, $newAdminUsername,$newAdminPW) {
	try {
		
	$sql = $db->prepare("INSERT INTO users VALUES(null, :newAdminUsername, :newAdminPW, NOW())");
	$sql->bindParam(':newAdminUsername',$newAdminUsername);
	$sql->bindParam(':newAdminPW',$newAdminPW);
	$sql->execute();
	
	$results = "New Admin '$newAdminUsername' Added!";
	
	} catch(PDOException $e) {
		die("There was a problem adding the admin.");
		$results = "There was a problem adding the admin.";
	}
	return $results;
	
	
	
}

//MANAGING PRODUCTS
function addProduct($db, $addProdCatId, $product, $price, $image) {
	try {
		$sql=$db->prepare("SELECT category_id FROM categories WHERE category = '$addProdCatId'");
		$sql->execute();
		$results=$sql->fetch(PDO::FETCH_ASSOC);
		
		foreach($results as $result)
		{
			$id = $result['category_id'];
			var_dump($id);
		}
		
		$sql2=$db->prepare("INSERT INTO products VALUES (null,$id,'$product','$price','$image')");
		$sql2->execute();
		return $sql2;
	} catch(PDOException $e) {
		die("There was a problem adding the product.");
	}
	
}

function updateProduct($db, $addProdCatId, $product, $price, $image, $productEditID) {
	
		$sql=$db->prepare("SELECT category_id FROM categories WHERE category = '$addProdCatId'");
		$sql->execute();
		$results=$sql->fetch(PDO::FETCH_ASSOC);
		
		
		foreach($results as $result)
		{
			$id = $result;
		}
	
	$sql2= $db->prepare("UPDATE `products` SET  `products`.`category_id`=$id, product='$product', price='$price', image ='$image' WHERE product_id=$productEditID");
	//$sql2->bindParam(':category_id', $id, PDO::PARAM_INT);
//	$sql2->bindParam(':price', $price);
	//$sql2->bindParam(':product', $product);
	//$sql2->bindParam(':image', $image);
//	$sql2->bindParam(':id', $productEditID,PDO::PARAM_INT);
	
	return $sql2;
	
}

function deleteProduct($db, $productDeleteID) {
	try {
		$sql = $db->prepare("DELETE FROM products WHERE product_id = $productDeleteID");
		$sql->execute();
} catch(PDOException $e) {
	die("There was a problem adding the product.");
}
}
/*
function viewProduct {
	
	
} 
*/
//MANAGING CATEGORIES
function addCategory($db, $catNameText) {
	try {
		$sql = $db->prepare("INSERT INTO categories VALUES(NULL, :category)");
		$sql->bindParam(':category', $catNameText);
		$sql->execute();
	} catch(PDOException $e) {
		die("There was a problem adding the category.");
	}
}

//function getAdminCatText($db, $catAdminDropDown,)

function updateCategory($db, $catNameText, $catAdminDropDown) {
	try 
	{
		$sql = $db->prepare("UPDATE `categories` SET category ='$catNameText' WHERE category ='$catAdminDropDown'");
		$sql->execute();
		$response = "<p>Category successfully updated.</p>";
		
	} catch(PDOException $e) {
		die("There was a problem updating the category.");
		$response = "There was a problem updating the category.";
	}
	return $sql;
}
function adminViewProducts($db,$catAdminDropDown) {
	$sql = $db->prepare("SELECT * FROM categories WHERE category='$catAdminDropDown'");
	//$sql->bindParam(':catAdminDropDown', $catAdminDropDown, PDO::PARAM_STR);
	$sql->execute();
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($results as $result) {
		$cat_id = $result['category_id'];
	}
	
	//return $cat_id;
	
	$sql2 = $db->prepare("SELECT * FROM products where category_id = $cat_id");
	$sql2->bindParam(':cat_id', $cat_id, PDO::PARAM_INT);
	$sql2->execute();
	$productList = $sql2->fetchAll(PDO::FETCH_ASSOC);
	return $productList;
	
	
}

function deleteCategory($db,$catAdminDropDown) {
	//delete * from products where products.category_id = categories.category id
//sql2 = delete * from categories where categoryid = catid	

	$sql = $db->prepare("SELECT category_id FROM categories WHERE category='$catAdminDropDown'");
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($results as $result)
	{
		$cat_id = $result['category_id'];
	}
	
	$sql2 = $db->prepare("DELETE FROM products WHERE category_id=$cat_id");
	$sql2->execute();
	
	$sql3 = $db->prepare("DELETE FROM categories WHERE category_id=$cat_id");
	$sql3->execute();
}


//ORDERS
function viewAllOrders($db) {
	$sql = $db->prepare("SELECT * FROM orders");
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
	
}

function viewOrderItems($db, $order_id) {
	$sql = $db->prepare("SELECT * FROM `orderitems` where `orderitems`.`order_id` = $order_id");
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
	
}

//LOGIN STUFF

function login($db, $email, $password) {
	//SELECT * FROM customers WHERE email = :email AND password = :password
	$sql = $db->prepare("SELECT * FROM customers WHERE email = '$email' and password = '$password'");
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	return $results;
}

//orders

function addToOrders($db, $sessionCust_id, $tax, $totalPrice) {
	$date = date_create(date('Y-m-d'));
	date_add($date, date_interval_create_from_date_string('5 days'));
	$shipDate = date_format($date, 'Y-m-d');
	
	$sql = $db->prepare("INSERT INTO orders VALUES (NULL, $sessionCust_id, '$shipDate', '$tax', '$totalPrice')");
	$sql->execute();
	
	//grabbing last id
	$last_id = $db->lastInsertId(); //this is order_id for orderitems table
	return $last_id;
}

function getProductIds($sessionCart) {
	//and quantity and price 
	$productInfo = array();
	if(isset($sessionCart))
	{
	foreach($sessionCart as $cartProduct)
	{
		array_push($productInfo, array("product_id" => $cartProduct['product_id'], "quantity" => $cartProduct['quantity'], "price" => $cartProduct['price']));
	}
	
	return $productInfo;
	}
}

function addToOrderItems($db,$productInfo, $last_id, $sessionCust_id) { //put in an array of all product id's

	foreach($productInfo as $productInformation) {
		
		$prod_id = $productInformation['product_id'];
		$quant = $productInformation['quantity'];
		$price = $productInformation['price'];
		
		$sql = $db->prepare("INSERT INTO orderitems VALUES (NULL, $last_id, $sessionCust_id, $prod_id, $price, $quant)");
		$sql->execute();
	}
	return $sql;
}
function addCustomer($db, $SUfname, $SUlname, $SUemail, $SUpw) {
	$sql = $db->prepare("INSERT INTO customers VALUES (NULL, '$SUfname', '$SUlname', '$SUemail', '$SUpw')");
	$sql->execute();
	
	
}

function loginAdmin($db, $email, $password) {
	//SELECT * FROM customers WHERE email = :email AND password = :password
	$sql = $db->prepare("SELECT * FROM users WHERE email = '$email' and password = '$password'");
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	return $results;
}

//customer view orders
function viewMyOrders($db, $sessionCust_id) {
	$sql = $db->prepare("SELECT * FROM orders WHERE customer_id = $sessionCust_id");
	$sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	
	return $results;
}



?>