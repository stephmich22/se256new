<?php
require_once("functions.php");
require_once("db.php");
//require_once("index.php");

global $db;

$header = "<h1>Sites App</h1>";
$header .= "<a href='siteEntry.php'>Site Entry | </a><a href='siteListing.php'>Site Listing </a><br />";
$header .= "<h2>Site Listing</h2>";	
$header .= "<p>Please select a site.</p>";
$header .= "<form action='index.php' method='get'>";
$header .= "<select name='siteDropDown'>";
$header .= "<option value=''>Choose a site</option>";
$siteLinks = siteListingDropDown($db);

		foreach($siteLinks as $siteLink)
		{
			$header .= "<option value='" . $siteLink['site_id'] . "' id='" . $siteLink['site_id'] ."'>" . $siteLink['site'] . "</option>\n";
		}
		
	//var_dump($siteLinks);
$header .= "</select>";
$header .= "<input type='submit' name='action' value='Links' />";
$header .= "</form>";
//global $table;


?>


<html lang="en">
	<head>
		<meta charset="UTF-8">
			<title>Sites App</title>
			
	</head>
		<body>
			<?php echo $header ?>
			<!-- <?php echo $siteLinksLinks ?> -->
		
		
		</body>
</html>