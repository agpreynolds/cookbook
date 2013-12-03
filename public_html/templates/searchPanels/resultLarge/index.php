<?php

$recipe = $request->response;
$resultLogic = new resultLogic($recipe);

?>

<article>
	<header>
		<img class="fLeft" src="/media/recipe_default.png" alt="http://www.iconarchive.com/show/virtual-kitchen-icons-by-sirea/Pan-icon.html">
		<h3><?php echo $recipe->name; ?></h3>			
	</header>
	<p>Uploaded by:
		<a href="/user.php?username=<?php echo $recipe->author; ?>">
			<?php echo $recipe->author; ?>
		</a>
	</p>
	
	<p><?php echo $recipe->description; ?></p>
	
	<ul id="components" style="clear:both;">
		<li class="componentOption">
			<a><h4>+ Ingredients</h4></a>
			<ul><?php $resultLogic->outputIngredientList(); ?></ul>
		</li>
		<li class="componentOption">
			<a><h4>+ Tools</h4></a>
			<ul style="display:none"><?php $resultLogic->outputToolList(); ?></ul>
		</li>
		<li class="componentOption">
			<a><h4>+ Techniques</h4></a>
			<ul style="display:none"><?php $resultLogic->outputTechniqueList(); ?></ul>
		</li>
		<li class="componentOption">
			<a><h4>+ Steps</h4></a>
			<ol style="display:none"><?php $resultLogic->outputStepList(); ?></ol>
		</li>
	</ul>
</article>