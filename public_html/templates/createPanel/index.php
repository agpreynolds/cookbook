<header>
	<h3><a class="panelHeader">Upload Recipe<span class="indicator">-</span></a></h3>
</header>
<section class="wrapper">
	<p class="note">Please complete the form below to upload a recipe</p>
	<form name="recipeCreate">
		<label for="label">Name</label>
		<input type="text" name="label" placeholder="Name"/>

		<label for="description">Description</label>
		<textarea name="description"></textarea>

		<label for="cuisine">Cuisine Type</label>
		<select name="cuisine">
			<option value=0>Select</option>
			<option value="italian">Italian</option>
			<option value="indian">Indian</option>
		</select>

		<label for="course">Course</label>
		<select name="course">
			<option value=0>Select</option>
			<option value="starter">Starter</option>
			<option value="main">Main</option>
			<option value="dessert">Dessert</option>
		</select>

		<input type="submit" value="Submit Recipe"/>
	</form>
</section>