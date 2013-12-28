<?php 
require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php');
$logic = new uploadLogic(); 
?>

<header>
	<h3><a class="panelHeader">Upload Recipe<span class="indicator">-</span></a></h3>
</header>
<section class="wrapper">
	<p class="note">Please complete the form below to upload a recipe</p>
	<article>
		<form name="recipeCreate">
			<label for="label">*Name</label>
			<input type="text" name="label" placeholder="Name"/>

			<label for="comment">*Description</label>
			<textarea name="comment"></textarea>

			<label for="cuisine">*Cuisine Type</label>
			<select name="cuisine">
				<option value=0>Select</option>
				<?php echo $logic->outputFacetOptions('recipe:Cuisine'); ?>
			</select>

			<label for="course">*Course</label>
			<select name="course">
				<option value=0>Select</option>
				<?php echo $logic->outputFacetOptions('recipe:Course'); ?>
			</select>

			<input type="submit" value="Submit Recipe"/>
		</form>
	</article>
</section>