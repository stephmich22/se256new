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
$siteSelection = filter_input(INPUT_GET, 'siteDropDown', FILTER_SANITIZE_STRING) ?? NULL;
//column variables for SITELINKS table
$link = filter_input(INPUT_POST, 'link', FILTER_SANITIZE_STRING) ?? "";
$siteLink=[ 'site_id'=>"",
			'site'=>"",
			'date'=>""


];

$table = "";
$body = "";
global $siteLinks;
global $siteLink;

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
	$siteLinksLinks = getLinks($db, $siteSelection);
	$siteLinksCount = count($siteLinksLinks);
	$siteNames = getCaption($db, $siteSelection);
	
	foreach($siteNames as $siteName)
	{
	}
	
	$t = strtotime($siteName['date']);
	$date = date('m/d/y H:i:s',$t);
	
	$table .= "<caption><b>" . $siteLinksCount . " Links found for " . $siteName['site'] . " | stored/retrieved " . $date . " </b></caption>";
	$table .= "<table>";
	foreach($siteLinksLinks as $siteLinkLink)
		{
			$table .= "<tr><td><a href='" . $siteLinkLink['link'] . "' target='popup'>" . $siteLinkLink['link'] . "</a></td></tr>\n";
			
			/*
			$table .= "<ul>";
			$table .= "<li>" . $siteLinkLink['link'] . "</li>";
			$table .= "</ul>";*/
			
		}
	$table .= "</table>";
	include_once("siteListing.php");
	break;
	
	
}//switch($action) CLOSE



?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
			<title>Sites App</title>
			
	</head>
		<body>
			
			<?php echo $table ?>
		
		
		</body>
</html>




