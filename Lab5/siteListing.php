<?php
require_once("functions.php");
require_once("db.php");
global $db;

$header = "<h1>Sites App</h1>";
$header .= "<a href='siteEntry.php'>Site Entry | </a><a href='siteListing.php'>Site Listing </a><br />";
$header .= "<h2>Site Listing</h2>";	
$header .= "<p>Please select a site.</p>";
$header .= "<form action='index.php' method='get'>";
$header .= "<select name='siteDropDown'>";
$header .= "<option value=''>Choose a site</option>";
$siteLinks = siteListingDropDown($db);
	foreach($siteLinks as $siteLink) {
		foreach($siteLink as $innerSiteLinks)
		{
		$header .= "<option value='$innerSiteLinks'>$innerSiteLinks</option>\n";
		}
		
	}
	var_dump($siteLinks);
$header .= "</select>";
$header .= "<input type='submit' name='action' value='Links' />";
$header .= "</form>";
$body = "";
$results = getLinks($db, $innerSiteLinks);
	foreach($results as $result)
	{
		$body .= $result;
	}


?>


<html lang="en">
	<head>
		<meta charset="UTF-8">
			<title>Sites App</title>
			
	</head>
		<body>
		
			<?php echo $header ?>
			<?php echo $body ?>
		
		
		
		</body>
</html>