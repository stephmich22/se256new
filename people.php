<?php
function getRows() {
	
	//select all the rows as associative array and returning
	global $db;
	$stmt = $db->prepare("SELECT * FROM demo");
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//asking for associatively indexed array and then underneath, returning that array
	return $results; 
}
function savePerson($db, $fName, $lName, $age) {
	$sql = "INSERT INTO demo (fName, lName, age) VALUES (:fName, :lName, :age)";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':fName',$fName);
	$stmt->bindParam(':lName',$lName);
	$stmt->bindParam(':age',$age, PDO::PARAM_INT); //saying btw this is an integer
	$stmt->execute();
	
}