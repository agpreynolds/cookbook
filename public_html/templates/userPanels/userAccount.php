<section id="userAccountContainer">
	<header>
		<h3><a class="panelHeader">My Account<span class="indicator">+</span></a></h3>
	</header>
	<section class="wrapper">
		<p>Welcome <?php echo $_SESSION['user']->username; ?>, not user <a class="signout">Sign Out</a></p>
		<article>
			<header class="black">
				<h4>Preferences</h4>
			</header>
			<a id="recipeCreate">Upload Recipe</a>
			<form name="userPreferences">
				<input name="vegetarian" type="checkbox"/>
				<label for="vegetarian">Vegetarian</label>

				<input name="vegan" type="checkbox"/>
				<label for="vegan">Vegan</label>

				<input name="lactoseIntolerant" type="checkbox"/>
				<label for="lactoseIntolerant">Lactose Intolerant</label>
			</form>
		</article>
	</section>
</section>