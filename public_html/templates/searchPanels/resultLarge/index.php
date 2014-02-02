<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');
$resultLogic = $request->response;
$recipe = $resultLogic->recipe;

?>

<article id="<?php echo $recipe->uri; ?>" class="contentContainer">
	<header>
		<h3><?php echo $recipe->label; ?><a class="close-link">X</a></h3>			
	</header>
	<section class="wrapper">
		<img class="fLeft" src="<?php echo $recipe->imagePath; ?>" height="128" width="128">
		<p>Uploaded by:
			<a href="/user.php?username=<?php echo $recipe->author; ?>">
				<?php echo $recipe->username; ?>
			</a>
		</p>
		
		<p><?php echo $recipe->comment; ?></p>
		
		<section id="components">
			<article class="componentOption">
				<header>
					<a><h4>Ingredients <span class="indicator">+</span></h4></a>
				</header>
				<section>
					<ul><?php $resultLogic->outputIngredientList(); ?></ul>
				</section>
			</article>
			<article class="componentOption">
				<header>
					<a><h4>Tools <span class="indicator">+</span></h4></a>
				</header>
				<section>
					<ul><?php $resultLogic->outputToolList(); ?></ul>
				</section>
			</article>
			<article class="componentOption">
				<header>
					<a><h4>Techniques <span class="indicator">+</span></h4></a>
				</header>
				<section>
					<ul><?php $resultLogic->outputTechniqueList(); ?></ul>					
				</section>
			</article>
			<article class="componentOption">
				<header>
					<a><h4>Steps <span class="indicator">+</span></h4></a>
				</header>
				<section>
					<ul><?php $resultLogic->outputStepList(); ?></ul>
				</section>
			</article>
			<article class="componentOption">
				<header>
					<a><h4>Reviews <span class="indicator">+</span></h4></a>
				</header>
				<section>
					<ul><?php $resultLogic->outputReviews(); ?></ul>

					<?php include ( getAbsIncPath('/templates/reviews/form.php') ); ?>
				</section>
			</article>
		</section>
		<section id="recipeModeration">
			<a>Report to a Moderator</a>
		</section>
	</section>
</article>