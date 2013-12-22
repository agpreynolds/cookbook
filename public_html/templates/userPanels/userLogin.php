<section id="userLoginContainer">
	<header>
		<h3><a class="panelHeader">Sign In / Register<span class="indicator">+</span></a></h3>
	</header>
	<section class="wrapper">
		<article id="userLogin">
			<header class="black">
				<h4>Sign In:</h4>
			</header>
			<p class="note">Already have an account? Enter your username and password below to sign in.</p>
			<form name="userLogin">
				<label for="username">Username</label>
				<input name="username" type="text" placeholder="Username"/>

				<label for="password">Password</label>
				<input name="password" type="password" placeholder="Password"/>
				
				<input type="submit" value="Sign In"/>
			</form>
		</article>
		<article id="userSignup">
			<header class="black">
				<h4>Register:</h4>
			</header>
			<p class="note">To create an account enter a unique username below:</p>
			<form name="userSignup" autocomplete="off">
				<label for="username">Username</label>
				<input name="username" type="text" placeholder="Username"/>

				<label for="password">Password (case sensitive, 6 - 12 characters)</label>
				<input name="password" type="password" placeholder="Password"/>
				
				<label for="password2">Verify Password</label>
				<input name="password2" type="password" placeholder="Verify Password"/>

				<input name="terms" type="checkbox"/>
				<label for="terms">Please confirm you have read and agreed to our <a>Terms of Use</a></label>
				
				<input type="submit" value="Register">
			</form>
		</article>
	</section>
</section>