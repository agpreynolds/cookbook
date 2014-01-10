<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

	$logic = $request->response;

	if ($_SESSION['user']->isSignedIn) {
		$userInput = "<input type='hidden' name='username' value='{$_SESSION['user']->username}' />";	
	}
	else {
		$userInput = "<label for='username'>*Username</label>\n<input type='text' name='username'/>";
	}
?>

<header class="black">
	<h4>Report this Recipe</h4>
</header>
<form name="recipeModerate">
	<input type="hidden" name="subject" value="<?php echo $logic->subject ; ?>" />
	
	<?php echo $userInput; ?>
	
	<label for="comment">*Enter a Comment</label>
	<textarea name="comment"/>
	
	<input type="submit" value="Submit">	
</form>