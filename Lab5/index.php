<?php //CONTROLLER
require_once("db.php");
require_once("functions.php");

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING) ??
    filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING) ?? NULL;

$urlEntry = filter_input(INPUT_GET, 'urlEntry', FILTER_SANITIZE_STRING) ?? "";

//column variables for SITES table
$site_id = filter_input(INPUT_GET, 'site_id', FILTER_VALIDATE_INT) ?? filter_input(INPUT_POST, 'site_id', FILTER_VALIDATE_INT) ?? null; 
$site = filter_input(INPUT_POST, 'site', FILTER_SANITIZE_STRING) ?? "";
$date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING) ?? "";
$innerSiteLinks = filter_input(INPUT_GET, 'siteDropDown', FILTER_SANITIZE_STRING) ?? NULL;
//column variables for SITELINKS table
$link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING) ?? "";

//$file = file_get_contents($urlEntry);


switch($action) {
	
	default:
	include("siteEntry.php");
	break;
	
	case "Add":
	checkForUniqueURL($db,$urlEntry);
	submitURL($urlEntry);
	include_once("siteEntry.php");
	break;
	
	case "Links":
	getLinks($db, $innerSiteLinks);
	echo $links;
	include_once("siteListing.php");
	break;
	
	
}//switch($action) CLOSE



?>

