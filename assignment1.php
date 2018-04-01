<?php


$table = "<table>\n";

for($rows = 0; $rows < 10; $rows++)
{
    $table .= "\t<tr>";
    
    for($cols = 0; $cols < 10; $cols++):
        $randomColor = randColor();
    $table .= "<td style='background-color:" .$randomColor. ";'>" .$randomColor."<br/><span style='color:#ffffff;'>" .$randomColor."</span></td>";
    endfor;
    //for random colors, do + $randNum in between quotes for background color. 
    
}//for($rows) CLOSE

function randColor() {
    $chars = 'ABCDEF0123456789';
    $color = '#';
    for ( $i = 0; $i < 6; $i++ ) {
       $color .= $chars[rand(0, strlen($chars) - 1)];
    }
    return $color;
 }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Assignment One</title>
    
    </head>
    <body>
    <?php echo $table; ?>
    </body>
</html>