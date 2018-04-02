<?php
//var_dump($people);
//print_r($people);

foreach ($people as $person) {
	echo $person['fName'] ." ". $person['lName'] . " " . $person['age'];
	echo "<br />";
	
}
