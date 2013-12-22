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
	<script type="text/javascript" src="/js/recipeCreate.js"></script>
	<script type="text/javascript" src="/js/recipeSearch.js"></script>
	<script type="text/javascript" src="/js/user.js"></script>
</head>

<body>
	<header>
		<h1>TODO: Good Title</h1>
	</header>

	<div id="userOptionsContainer"><?php new userOptions(); ?></div>
	<section id="recipeCreateContainer"></section>

	<section id="recipeSearchContainer">
		<header>
			<h3><a class="panelHeader">Search Recipes<span class="indicator">-</span></a></h3>
		</header>
		<section class="wrapper">
			<section id="recipeSearchFacets">
				<ul><?php new searchOptions(); ?></ul>		
			</section>
			
			<section id="recipeSearchResults">
				<ul id="resultList"></ul>			
			</section>
		</section>
	</section>

	<footer>
		<p>TODO: Disclaimer</p>
	</footer>

</body>
</html>