<?php
$size = mt_rand(5, 10);

$table = "<table>\n";

for($rows = 1; $rows <= $size; $rows++)
{
	$table .= "\t<tr>";
	//alternatice syntax to curly bracks
	for($cols = 1; $cols <= $size; $cols++)://note the colon
		$table .= "<td>" . $rows * $cols . "</td>";
	endfor;
	$table .= "\t</tr>\n";
}//for() CLOSE
$table .= "<table/>\n";
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Multiplication Table</title>
</head>
<body>
<?php echo $table; ?>


</body>
</html>