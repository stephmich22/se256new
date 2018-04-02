<<<<<<< HEAD



<?php

$name = "Steph Michalopoulos\n\n";
$table = "<table>\n";

//using for loops to create a 10x10 table, this one creates the rows
for($rows = 0; $rows < 10; $rows++)
{
    $table .= "\t<tr>";

    //this for loop creates the columns
    for($cols = 0; $cols < 10; $cols++):

        //creating a new random color for each cell
        $randomColor = randColor();
        //adding <td> tags within the <tr> tags, styled so that they text within the tag is the same as the random color generated for its background
        $table .= "<td style='background-color:" .$randomColor. ";'>" .$randomColor."<br/><span style='color:#ffffff;'>" .$randomColor."</span></td>";
    endfor;
    
}//for($rows) CLOSE

//i've created this function to loop through all acceptable characters within a hex color code
function randColor() {
    $chars = 'ABCDEF0123456789';
    $color = '#';
    
    //this will loop through the characters 6 times, creating a 6 character length variable
    for ( $i = 0; $i < 6; $i++ ) {
       $color .= $chars[rand(0, strlen($chars) - 1)];
    }
    //variable that returns a hex color code
    return $color;
 }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment One</title>
    
    </head>
    <body>
    <?php echo $name; ?>
    <?php echo $table; ?>
    </body>
=======



<?php

$name = "Steph Michalopoulos\n\n";
$table = "<table>\n";

//using for loops to create a 10x10 table, this one creates the rows
for($rows = 0; $rows < 10; $rows++)
{
    $table .= "\t<tr>";

    //this for loop creates the columns
    for($cols = 0; $cols < 10; $cols++):

        //creating a new random color for each cell
        $randomColor = randColor();
        //adding <td> tags within the <tr> tags, styled so that they text within the tag is the same as the random color generated for its background
        $table .= "<td style='background-color:" .$randomColor. ";'>" .$randomColor."<br/><span style='color:#ffffff;'>" .$randomColor."</span></td>";
    endfor;
    
}//for($rows) CLOSE

//i've created this function to loop through all acceptable characters within a hex color code
function randColor() {
    $chars = 'ABCDEF0123456789';
    $color = '#';
    
    //this will loop through the characters 6 times, creating a 6 character length variable
    for ( $i = 0; $i < 6; $i++ ) {
       $color .= $chars[rand(0, strlen($chars) - 1)];
    }
    //variable that returns a hex color code
    return $color;
 }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment One</title>
    
    </head>
    <body>
    <?php echo $name; ?>
    <?php echo $table; ?>
    </body>
>>>>>>> 3a8e997f8b8831efc637537575f326a2f34e44f9
</html>