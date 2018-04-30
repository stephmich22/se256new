<?php // CONTROLLER
require_once("db.php");
require_once("people.php");



$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;
$dir = filter_input(INPUT_GET, 'order', FILTER_SANITIZE_STRING) ?? 'ASC';
$field = filter_input(INPUT_GET, 'sortDropDown', FILTER_SANITIZE_STRING) ?? NULL;
$corp = filter_input(INPUT_POST, 'corp', FILTER_SANITIZE_STRING) ?? "";
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING) ?? "";
$zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_STRING) ?? "";
$owner = filter_input(INPUT_POST, 'owner', FILTER_SANITIZE_STRING) ?? "";
$phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING) ?? "";
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT) ?? null;
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
		$response = "<h2>*Record successfully added</h2>";
		include_once("peopleTable.php");
		break;
	case "Save"://this is what button on the form is labeled
		updateCorp($db, $corp, $email, $zipcode, $owner, $phone, $id);
		//get all the rows
		$corporations = getRows(); 
		//display the rows
		$response = "<h2>*Record successfully updated</h2>";
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
		$response = "<h2>*Record Deleted</h2>";
		include('peopleTable.php');
		break;
	case "Update":
		$company = getCorp($db,$id);
		$button = "Save";
		include_once("personForm.php");
		break;
	case "Sort":
		//$sortable = true;
		$corporations = getCorpsAsSortedTable($db, $field, $dir);
		$fields = columnNames($db);
		//include_once('peopleTable.php');
		echo $corporations;   //// ************* just did this for testing 
		break;
		
	case "Search":
	include_once("personForm.php");
		break;
	//case "Reset":
}

 