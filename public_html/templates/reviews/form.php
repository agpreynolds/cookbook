<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

	$logic = $request->response;

	if ($_SESSION['user']->isSignedIn) {
		$userInput = "<input type='hidden' name='reviewer' value='{$_SESSION['user']->username}' />";	
	}
	else {
		$userInput = "<label for='reviewer'>*Username</label>\n<input type='text' name='reviewer'/>";
	}
?>

<header class="black">
	<h4>Review this Recipe</h4>
</header>
<form name="recipeReview">
	<input type="hidden" name="formID" value="recipeReview"/>
	<input type="hidden" name="subject" value="<?php echo $logic->recipe->uri ; ?>" />
	
	<?php echo $userInput; ?>
	
	<label for="title">*Title</label>
	<input type="text" name="title"/>

	<label for="text">*Review Text</label>
	<textarea name="text"/>
	
	<input type="submit" value="Submit">	
</form>