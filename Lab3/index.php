<?php // CONTROLLER
require_once("db.php");
require_once("people.php");



$action = $_REQUEST['action'];
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
//$incorp_dt = $_POST['incorp_dt'];
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? null;

$company=['corp'=>"",
		  'email'=>"",
		  'zipcode'=>"",
		  'owner'=>"",
		  'phone'=>""
];

$button="Add";

switch ($action){
	case "Create":
		include_once("personForm.php");
		break;
	case "Add":
		saveCorp($db, $corp, $email, $zipcode, $owner, $phone);
		$corporations = getRows();
		include_once("peopleTable.php");
		break;
	case "Save"://this is what button on the form is labeled
		updateCorp($db, $corp, $email, $zipcode, $owner, $phone, $id);
		//get all the rows
		$corporations = getRows(); 
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
		break;
	case "Read":
		$company = getCorp($db,$id);
		include_once("companyResults.php");
		break;
	case "Delete":
		deleteCorp($db, $id);
		$corporations = getRows();
		include('peopleTable.php');
		break;
	case "Update":
		$company = getCorp($db,$id);
		$button = "Save";
		include_once("personForm.php");
}

 