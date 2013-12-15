<!DOCTYPE html>
<html>

<head>
	<title>TODO: Good Title</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="/css/global.css">
	
	<script type="text/javascript" src="/js/lib/jQuery_v1.10.2.js"></script>	
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript" src="/js/recipeSearch.js"></script>
</head>

<body>
	<header>
		<h1>TODO: Good Title</h1>
	</header>

	<section id="recipeSearchContainer">
		<section id="recipeSearchFacets">
			<header>
				<h3>Search By:</h3>
			</header>

			<ul><?php new searchOptions(); ?></ul>		
		</section>
		
		<section id="recipeSearchResults">
			<header>
				<h3>Results:</h3>
			</header>

			<ul id="resultList"></ul>
			
		</section>

	</section>

	<section id="resultLarge" style="clear:both"></section>

	<footer>
		<p>TODO: Disclaimer</p>
	</footer>

</body>
</html>