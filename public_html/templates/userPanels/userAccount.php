<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>

<section id="userAccountContainer">
	<header>
		<h3><a class="panelHeader">My Account<span class="indicator">+</span></a></h3>
	</header>
	<section class="wrapper">
		<section id="accountMenuContainer">
			<ul id="accountMenu">
				<li class="selected"><a>My Account</a></li>
				<li><a>My Preferences</a></li>
				<li><a>My Recipes</a></li>
				<li><a>My Favourites</a></li>
			</ul>
		</section>
		<section id="accountContentContainer">
			<section id="userLogout">
				<form name="userLogout">
					<p class="required-note"></p>
					<input type="hidden" name="username" value="<?php echo $_SESSION['user']->username; ?>" />
					<input type="submit" value="Sign Out"/>
				</form>
			</section>
			<p>Welcome <?php echo $_SESSION['user']->username; ?></p>
			<section id="accountSelectedContent">
				<article>
					<header class="black">
						<h4>Preferences</h4>
					</header>
					<a id="recipeCreate">Upload Recipe</a>
					<form name="userPreferences">
						<div class="checkbox">
							<input name="vegetarian" type="checkbox"/>
							<label for="vegetarian">Vegetarian</label>
						</div>
						
						<div class="checkbox">
							<input name="vegan" type="checkbox"/>
							<label for="vegan">Vegan</label>
						</div>

						<div class="checkbox">
							<input name="lactoseIntolerant" type="checkbox"/>
							<label for="lactoseIntolerant">Lactose Intolerant</label>
						</div>
					</form>
				</article>
			</section>
		</section>
	</section>
</section>