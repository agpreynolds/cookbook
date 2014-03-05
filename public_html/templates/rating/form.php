<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');

	$logic = $request->response;
?>

<form name="recipeRating" class="hidden">
	<input type="hidden" name="formID" value="recipeRating"/>
	<input type="hidden" name="subject" value="<?php echo $logic->recipe->uri ; ?>" />
	<input type="hidden" name="rating" id="rating"/>
</form>
<div class="ratingLarge"></div>