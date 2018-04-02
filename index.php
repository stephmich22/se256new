<?php
require_once("db.php");
require_once("people.php");
$action = $_REQUEST['action'];
switch ($action){
	default:
	//get all the rows
		$people = getRows(); //dont need to provide any info because only dealing with one table
		
		//display the rows
		include_once("peopleTable.php");
}