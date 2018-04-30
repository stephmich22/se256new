<?php
//people table view

$title = "<h1>Corporations</h1>\n";
$sort = "Sort Column:<form action='index.php' method='post'><select name='sortDropDown'>";
$fields = columnNames($db);
foreach($fields as $field)
{
	$sort .= "<option value='$field'>$field</option> \n";
}
$sort.=  "</select>"; 
$asc = "Ascending:<input type='radio' name='order' value='ASC'/>";
$desc = "Descending:<input type='radio' name='order' value='DESC'/>";
$btnSortSubmit = "<input id='sortSubmit' type='submit' name='action' value='Sort' />";
$btnSortReset = "<input id='sortReset' type='submit' name='action' value='Reset' /></form><br/>";
$search = "Search Column:<form action='index.php' method='get'><select id='searchDropDown'>";
foreach($fields as $field)
{
	$search .= "<option value='$field'>$field</option> \n";
}
$search .= "</select>";
$term = "Term: <input type='text' name='term' id = 'term' />";
$btnSearchSubmit = "<input id='searchSubmit' type='submit' name='action' value='Search' />";
$btnSearchReset = "<input id='searchReset' type='submit' name='action' value='Reset' /></form><br/>";
$table = "<table>" . PHP_EOL;



foreach ($corporations as $company) {
	
	
	$table .= "<tr><td>".$company['corp']. "</td><td><a href='?id=". $company['id'] ."&action=Read'>Read</a></td><td><a href='?id=". $company['id'] ."&action=Update'>Update</a></td><td><a href='?id=". $company['id'] ."&action=Delete'>Delete</a></td>";
	$table .= "</tr>";
	//echo "<br />";

	
	
}

$table .= "</table>";
// . PHP_EOL;



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
	<?php echo $response; ?>
	<?php echo $sort;?>
	<?php echo $asc;?>
	<?php echo $desc; ?>
	<?php echo $btnSortSubmit; ?>
	<?php echo $btnSortReset; ?>
	<?php echo $search; ?>
	<?php echo $term; ?>
	<?php echo $btnSearchSubmit; ?>
	<?php echo $btnSearchReset; ?>
    <?php echo $table; ?>
<form action='index.php' method='get'>
	<input type='submit' name='action' value='Create' />
	
</form>	
	
    </body>
</html>
 
