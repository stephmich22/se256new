<?php
//people table view
foreach ($people as $person) {
	echo $person['fName'] ." ". $person['lName'] . " " . $person['age'];
	echo "<br />";
	
}
//below are adding form/add button or whatev in html
//action in a form is completely diff concept than action in controller
?>

<form action='index.php' method='get'>
	<input type='submit' name='action' value='Add' />
</form>