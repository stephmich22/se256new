<?php

//$linksTest = submitURL($urlEntry);

$header = "<h1>Sites App</h1>";
$header .= "<a href='siteEntry.php'>Site Entry | </a><a href='siteListing.php'>Site Listing </a><br />";
$header .= "<h2>Site Entry</h2>";	
$header .= "<form action='index.php' method='get'>";
$header .= "<input type='text' name='urlEntry' id ='urlEntry' value='' />";
$header .= "<input type='submit' name='action' value='Add'/>";
$header .= "</form>";

global $body;
?>



<html lang="en">
	<head>
		<meta charset="UTF-8">
			<title>Sites App</title>
			<?php echo $header ?>
			<?php echo $body ?>
			
	</head>
		<body>
		
		
		
		
		
		
		</body>
</html>