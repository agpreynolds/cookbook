<!DOCTYPE html>
<html>

<head>
	<title>TODO: Good Title</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="/css/global.css">
	
	<script type="text/javascript" src="/js/lib/jQuery_v1.10.2.js"></script>	
	<script type="text/javascript" src="/js/lib/jQuery_ext.js"></script>	
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript" src="/js/form.js"></script>
	<script type="text/javascript" src="/js/popup.js"></script>
	<script type="text/javascript" src="/js/recipeSearch.js"></script>
	<script type="text/javascript" src="/js/signin.js"></script>
</head>

<body>
	<header>
		<h1>TODO: Good Title</h1>
	</header>

	<section id="userLoginContainer">
		<header>
			<h3><a class="panelHeader">Sign In / Register<span class="indicator">+</span></a></h3>
		</header>
		<section class="wrapper">
			<article id="userLogin">
				<header>
					<h4>Sign In:</h4>
				</header>
				<p class="note">Already have an account? Enter your username and password below to sign in.</p>
				<form name="userLogin">
					<input name="username" type="text" placeholder="Username"/>
					<input name="password" type="password" placeholder="Password"/>
					<input type="submit" value="Sign In"/>
				</form>
			</article>
			<article id="userSignup">
				<header>
					<h4>Register:</h4>
				</header>
				<p class="note">To create an account enter a unique username below:</p>
				<form name="userSignup">
					<input name="username" type="text" placeholder="Username"/>
					<input name="password" type="password" placeholder="Password"/>
					<input name="password2" type="password" placeholder="Verify Password"/>
					<input type="submit" value="Register">
				</form>
			</article>
		</section>
	</section>

	<section id="recipeSearchContainer">
		<header>
			<h3><a class="panelHeader">Search Recipes<span class="indicator">-</span></a></h3>
		</header>
		<section class="wrapper">
			<article id="recipeSearchFacets">
				<header>
					<h3>Search By:</h3>
				</header>
				<ul><?php new searchOptions(); ?></ul>		
			</article>
			
			<article id="recipeSearchResults">
				<header>
					<h3>Results:</h3>
				</header>
				<ul id="resultList"></ul>			
			</article>
		</section>
	</section>

	<footer>
		<p>TODO: Disclaimer</p>
	</footer>

</body>
</html>