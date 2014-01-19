<article>
	<header class="black">
		<h4>Preferences</h4>
	</header>
	<form name="userPreferences">
		<input type="hidden" name="formID" value="userPreferences"/>
		
		<div class="checkbox">
			<input name="isVegetarian" type="checkbox"/>
			<label for="isVegetarian">Vegetarian</label>
		</div>
		
		<div class="checkbox">
			<input name="isVegan" type="checkbox"/>
			<label for="isVegan">Vegan</label>
		</div>

		<div class="checkbox">
			<input name="isLactoseIntolerant" type="checkbox"/>
			<label for="isLactoseIntolerant">Lactose Intolerant</label>
		</div>

		<input type="submit" value="Submit"/>
	</form>
</article>