<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>

<section id="userAccountContainer">
	<header>
		<h3><a class="panelHeader">My Account<span class="indicator">+</span></a></h3>
	</header>
	<section class="wrapper">
		<section id="accountMenuContainer">
			<ul id="accountMenu">
				<li class="selected"><a id="userAccount">My Account</a></li>
				<li><a id="userPreferences">My Preferences</a></li>
				<li><a id="userRecipes">My Recipes</a></li>
				<li><a id="userFavourites">My Favourites</a></li>
			</ul>
		</section>
		<section id="accountContentContainer">
			<section id="accountSelectedContent">
				<?php include( getAbsIncPath('/templates/userPanels/includes/userAccount.php') ); ?>
			</section>
			<section id="userLogout">
				<form name="userLogout">
					<input type="hidden" name="formID" value="userLogout"/>
					
					<p class="required-note"></p>
					<input type="hidden" name="username" value="<?php echo $_SESSION['user']->username; ?>" />
					<input type="submit" value="Sign Out"/>
				</form>
			</section>
		</section>
	</section>
</section>