<?php

$title = "<h1>Corporation Information</h1>\n";
$table = "<table><tr><td><b>Corporation: </b>" . $company['corp'] . "</td><td><b>Date: </b>" . date("m/d/Y", strtotime($company['incorp_dt'])) . "</td><td><b>Email: </b>" . $company['email'] . "</td><td><b>Zip Code: </b>" . $company['zipcode'] . "</td><td><b>Owner: </b>" . $company['owner'] . "</td><td><b>Phone: </b>" . $company['phone'] . "</td></tr><tr><td><a href='?id=". $company['id'] ."&action=Update'>Update</a></td><td><a href='?id=". $company['id'] ."&action=Delete'>Delete</a></td></tr></table><br /><br /><br />";



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
	<input type='submit' name='action' value='View' />
</form>	
	
    </body>
</html>