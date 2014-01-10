<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>
<article>
	<header class="black">
		<h4>My Account</h4>
	</header>
	<p>Welcome <?php echo $_SESSION['user']->username; ?></p>
	<a id="recipeCreate">Upload Recipe</a>
</article>