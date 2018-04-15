<?php
//php extension but for now this is gonna be straight up html
//php doesnt have anything to do with an id
?>
<form method='post' action='index.php'>
<label for='corp'>Corporation: </label>
	<input type='text' name='corp' value="<?php echo $company['corp']; ?>" /><br />
<label for='email'>Email: </label>
	<input type='text' name='email' value="<?php echo $company['email']; ?>" /><br />
<label for='zipcode'>Zip Code: </label>
	<input type='text' name='zipcode' value="<?php echo $company['zipcode']; ?>" /><br />
<label for='owner'>Owner: </label>
	<input type='text' name='owner' value="<?php echo $company['owner']; ?>" /><br />
<label for='phone'>Phone: </label>
	<input type='text' name='phone' value="<?php echo $company['phone']; ?>" /><br />
<input type="hidden" name="id" value="<?php echo $company['id']; ?>"/>
<input type='submit' id="button" name='action' value="<?php echo $button; ?>" />
<input type='submit' name='action' value='View' />
</form>
