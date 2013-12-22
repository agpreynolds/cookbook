<?php

$recipe = $request->response;
$resultLogic = new resultLogic($recipe);

?>

<article>
	<header>
		<h3><?php echo $recipe->name; ?><a class="close-link">X</a></h3>			
	</header>
	<section class="wrapper">
		<img class="fLeft" src="/media/recipe_default.png" alt="http://www.iconarchive.com/show/virtual-kitchen-icons-by-sirea/Pan-icon.html">
		<p>Uploaded by:
			<a href="/user.php?username=<?php echo $recipe->author; ?>">
				<?php echo $recipe->author; ?>
			</a>
		</p>
		
		<p><?php echo $recipe->description; ?></p>
		
		<section id="components">
			<article class="componentOption">
				<header>
					<a><h4>Ingredients <span class="indicator">+</span></h4></a>
				</header>
				<ul><?php $resultLogic->outputIngredientList(); ?></ul>
			</article>
			<article class="componentOption">
				<header>
					<a><h4>Tools <span class="indicator">+</span></h4></a>
				</header>
				<ul><?php $resultLogic->outputToolList(); ?></ul>
			</article>
			<article class="componentOption">
				<header>
					<a><h4>Techniques <span class="indicator">+</span></h4></a>
				</header>
				<ul><?php $resultLogic->outputTechniqueList(); ?></ul>
			</article>
			<article class="componentOption">
				<header>
					<a><h4>Steps <span class="indicator">+</span></h4></a>
				</header>
				<ul><?php $resultLogic->outputStepList(); ?></ul>
			</article>
		</section>
	</section>
</article>