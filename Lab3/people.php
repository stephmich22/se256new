<?php
$response = "";

function getRows() {
	
	//select all the rows as associative array and returning
	global $db;
	$stmt = $db->prepare("SELECT * FROM corps");
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//asking for associatively indexed array and then underneath, returning that array
	return $results; 
}

function getCorpsAsSortedTable($db, $col, $dir) {
	try {
		

		$sql = "SELECT corp, email, zipcode, owner, phone FROM corps ORDER BY $col $dir";
		$stmt = $db->prepare($sql);
		/*$stmt->bindParam(':corp',$corp);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':zipcode',$zipcode, PDO::PARAM_INT); //saying btw this is an integer
		$stmt->bindParam(':owner',$owner);
		$stmt->bindParam(':phone',$phone, PDO::PARAM_INT); //saying btw this is an integer*/
		$stmt->execute();
		$corps = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//return $results;
		
	} catch(PDOException $e) {
		die("There was a problem.");
	}
		return $corps;
}//getCorpsAsSortedTable() CLOSE

function saveCorp($db, $corp, $email, $zipcode, $owner, $phone) {
	try {
	$sql = "INSERT INTO corps VALUES (null, :corp, NOW(), :email, :zipcode, :owner, :phone)";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':corp',$corp);
	//$stmt->bindParam(':incorp_dt',$incorp_dt);
	$stmt->bindParam(':email',$email);
	$stmt->bindParam(':zipcode',$zipcode, PDO::PARAM_INT); //saying btw this is an integer
	$stmt->bindParam(':owner',$owner);
	$stmt->bindParam(':phone',$phone, PDO::PARAM_INT); //saying btw this is an integer
	
	$stmt->execute();
	$response = "<h2>Record successfully inserted</h2>";
	
	} catch(PDOException $e) {
		die("There was a problem adding the record.");
	}
	
	
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
	$sql->bindParam(':id', $id, PDO::PARAM_INT);
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

function columnNames($db) {

	$tableToDescribe = 'corps';
 
//Query MySQL with the PDO objecy.
//The SQL statement is: DESCRIBE [INSERT TABLE NAME]
	$sql = $db->prepare('DESCRIBE ' . $tableToDescribe);
	$sql->execute();
 
//Fetch our result.
$result = $sql->fetchAll(PDO::FETCH_ASSOC);
 
//The result should be an array of arrays,
//with each array containing information about the columns
//that the table has.
//var_dump($result);
 
 $fields = [];
 

 
//For the sake of this tutorial, I will loop through the result
//and print out the column names and their types.
foreach($result as $column){
    //echo "<option value='" . $column['Field'] . " - " . $column['Type'],"'>" . $column['Field'] . " - " . $column['Type'] . "</option><br >";
	//echo "<option value='" . $column['Field'] . "'>" . $column['Field'] ."</option><br >";
	array_push( $fields, $column['Field']);
	//return ($fields);	
	//var_dump($column). "<br/>" ; 
}

return $fields;
exit;
//	return $result;

}//columnNames() CLOSE 	



	
	
	
