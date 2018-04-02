<?php //THIS IS THE CONTROLLER
require_once("db.php");
require_once("people.php");
$action = $_REQUEST['action'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$age = $_POST['age'];
switch ($action){
	case "Add":
		include_once("personForm.php");
		break;
	case "Save"://this is what button on the form is labeled
		savePerson($db, $fName, $lName, $age);
		//get all the rows
		$people = getRows(); //dont need to provide any info because only dealing with one table
		
		//display the rows
		include_once("peopleTable.php");
		break;
	default:
	//get all the rows
		$people = getRows(); //dont need to provide any info because only dealing with one table
		
		//display the rows
		include_once("peopleTable.php");
}