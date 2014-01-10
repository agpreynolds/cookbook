<?php 
	require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); 
	$logic = new userRecipeLogic();
?>
<article>
	<header class="black">
		<h4>My Recipes</h4>
	</header>
	<p class="note">Below are all the recipes you have uploaded to the system</p>

	<?php 
		$logic->outputRecipes();
	?>
</article>