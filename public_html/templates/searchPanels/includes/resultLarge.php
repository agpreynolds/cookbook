<?php

$recipe = $request->response;

?>

<article>
	<header>
		<img class="fLeft" src="/media/recipe_default.png" alt="http://www.iconarchive.com/show/virtual-kitchen-icons-by-sirea/Pan-icon.html">
		<h3><?php echo $recipe->name; ?></h3>			
	</header>
	<p>Uploaded by: </p>
	<p><?php echo $recipe->description; ?></p>
	
	<ul id="components" style="clear:both;">
		<li class="componentOption">
			<a><h4>+ Ingredients</h4></a>
			<ul>
				<li>Eg1</li>
				<li>Eg2</li>
				<li>Eg3</li>
			</ul>
		</li>
		<li class="componentOption">
			<a><h4>+ Tools</h4></a>
			<ul style="display:none">
				<li>Eg1</li>
				<li>Eg2</li>
				<li>Eg3</li>
			</ul>
		</li>
		<li><h4>+ Techniques</h4></li>
		<li><h4>+ Steps</h4></li>
	</ul>
</article>