<?php
function getRows() {
	
	//select all the rows as associative array and returning
	global $db;
	$stmt = $db->prepare("SELECT * FROM corps");
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//asking for associatively indexed array and then underneath, returning that array
	return $results; 
}
function saveCorp($db, $corp, $email, $zipcode, $owner, $phone) {
	
	$sql = "INSERT INTO corps VALUES (null, :corp, NOW(), :email, :zipcode, :owner, :phone)";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':corp',$corp);
	//$stmt->bindParam(':incorp_dt',$incorp_dt);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':zipcode',$zipcode, PDO::PARAM_INT); //saying btw this is an integer
	$stmt->bindParam(':owner',$owner);
	$stmt->bindParam(':phone',$phone, PDO::PARAM_INT); //saying btw this is an integer
	$stmt->execute();
	
}//saveCorp() CLOSE

function getCorp($db,$id) {
	$sql = $db->prepare("SELECT * FROM corps WHERE id = :id");
	$sql->bindParam(':id', $id, PDO::PARAM_INT);
	$sql->execute();
	$row = $sql->fetch(PDO::FETCH_ASSOC);
	return $row;
	
	
}//getCorp() CLOSE

function updateCorp($db, $corp, $email, $zipcode, $owner, $phone, $id) {
	try {
		$sql = $db->prepare("UPDATE `corps` SET corp= :corp, email= :email, zipcode= :zipcode, owner= :owner, phone= :phone WHERE id= :id");
		$sql->bindParam(':corp',$corp);
	//$stmt->bindParam(':incorp_dt',$incorp_dt);
	$sql->bindParam(':email',$email);
	$sql->bindParam(':zipcode',$zipcode, PDO::PARAM_INT); //saying btw this is an integer
	$sql->bindParam(':owner',$owner);
	$sql->bindParam(':phone',$phone, PDO::PARAM_INT); //saying btw this is an integer
	$sql->bindParam(':id', $id);
	$sql->execute();
	
	//return $sql->rowCount();
		
		
	} catch (PDOException $e) {
		
		
	}//catch CLOSE
}//updateCorp() CLOSE

function deleteCorp($db,$id) {
	try {
		$sql = $db->prepare("DELETE FROM corps WHERE id = :id");
		$sql->bindParam(':id',$id,PDO::PARAM_INT);
		$sql->execute();
		return $sql->rowCount();
	} catch(PDOException $e) {
		
	}
		
	
	
	}//deleteCorp() CLOSE
