<?php
function getRows() {
	
	//select all the rows as associative array and returning
	global $db;
	$stmt = $db->prepare("SELECT * FROM demo");
	$stmt->execute();
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);//asking for associatively indexed array and then underneath, returning that array
	return $results; 
}