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
	
	$sql = $db->prepare("SELECT * FROM categories");
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
	$sql = $db->prepare("SELECT * FROM Products WHERE product_id = :id");
$sql->bindParam(':id',$p_id, PDO::PARAM_INT);
	$sql->execute();
	$results = $sql->fetch(PDO::FETCH_ASSOC);
	return $results;
}
/*
//LOGGING IN 
function logIn {
	
	
}

//FOR CUSTOMER
function viewMyOrders{
	//SELECT * FROM orders 
}



//CART STUFF
function addItem {
	
}

function removeItem {
	
}

function emptyCart {
	
}

//CHECKING OUT 
function checkout {
	//INSERT PRODUCTS
	
}





//ADMIN (if logged in) ----------------------------------------------------------

//CREDENTIALS
function addUser {
	
	
	
}*/

//MANAGING PRODUCTS
function addProduct($db, $addProdCatId, $product, $price, $image) {
	try {
		$sql = $db->prepare("INSERT INTO Products VALUES (NULL, :category_id, :product, :price, :image)");
		$sql->bindParam(':category_id', $addProdCatId, PDO::PARAM_INT);
		$sql->bindParam(':product', $product);
		$sql->bindParam(':price', $price);
		$sql->bindParam('image', $image);
		$sql->execute();
	
	} catch(PDOException $e) {
		die("There was a problem adding the product.");
	}
	
	
	
}
/*
function updateProduct {
	
	
}

function deleteProduct {
	
	
}


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
/*
function updateCategory {
	
}

function deleteCategory {
	
}

//ORDERS
function viewAllOrders {
	
}*/

?>