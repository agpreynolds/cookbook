<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

?>

<article>
	<header class="black">
		<h4>Preferences</h4>
	</header>
	<form name="userPreferences">
		<input type="hidden" name="formID" value="userPreferences"/>
		
		<div class="checkbox">
			<input name="isVegetarian" type="checkbox" <?php echo $_SESSION['user']->isVegetarian ? 'checked' : ''; ?>/>
			<label for="isVegetarian">Vegetarian</label>
		</div>
		
		<div class="checkbox">
			<input name="isVegan" type="checkbox" <?php echo $_SESSION['user']->isVegan ? 'checked' : ''; ?>/>
			<label for="isVegan">Vegan</label>
		</div>

		<input type="submit" value="Submit"/>
	</form>
</article>