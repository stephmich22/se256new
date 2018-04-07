<?php
//people table view

$title = "<h1>Corporations</h1>\n";
$table = "<table>\n";

foreach ($corporations as $corps) {
	
	
	
	$table .= "\t<tr>";	
	
	$table .= "<td>".$corps['corp']. "</td><td><a href='?action=Read'>Read</a></td><td><a href='?action=Update'>Update</a></td><td><a href='?action=Delete'>Delete</a></td>";
	$table .= "</tr>";
	//echo "<br />";
	
	
	
	
	
	
}

$table .= "</table>";

//echo $table;
//below are adding form/add button or whatev in html
//action in a form is completely diff concept than action in controller
?>


 

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Corporations</title>
    
    </head>
    <body>
    <?php echo $title; ?>
    <?php echo $table; ?>
<form action='index.php' method='get'>
	<input type='submit' name='action' value='Add' />
</form>	
	
    </body>
</html>