<?php //THIS IS THE CONTROLLER
require_once("db.php");
require_once("people.php");


$action = $_REQUEST['action'];
$corp = $_POST['corp'];
//$incorp_dt = $_POST['incorp_dt'];
$email = $_POST['email'];
$zipcode = $_POST['zipcode'];
$owner = $_POST['owner'];
$phone = $_POST['phone'];

switch ($action){
	case "Add":
		include_once("personForm.php");
		break;
	case "Save"://this is what button on the form is labeled
		saveCorp($db, $corp, $email, $zipcode, $owner, $phone);
		//get all the rows
		$corporations = getRows(); //dont need to provide any info because only dealing with one table
		
		//display the rows
		include_once("peopleTable.php");
		break;
	case "View":
		$corporations = getRows();
		include_once("peopleTable.php");
	default:
	//get all the rows
		$corporations = getRows(); //dont need to provide any info because only dealing with one table
		
		//display the rows
		include_once("peopleTable.php");
}

switch ($action) {
	case "Read":
		include_once("personForm.php");
		break;
	
	
	
	
}