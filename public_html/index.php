<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/php/preload.php'); ?>

<!DOCTYPE html>
<html>

<head>
	<title>Semantic Recipe Finder</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="/css/global.css">
	<link rel="stylesheet" type="text/css" href="/css/select2.css">
	<link rel="stylesheet" type="text/css" href="/js/lib/select2/select2.css">
	<link rel="stylesheet" type="text/css" href="/js/lib/jRating/jquery/jRating.jquery.css">
	
	<script type="text/javascript" src="/js/lib/jQuery_v1.10.2.js"></script>	
	<script type="text/javascript" src="/js/lib/jQuery_ext.js"></script>
	<script type="text/javascript" src="/js/lib/jQuery-File-Upload/js/vendor/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="/js/lib/jQuery-File-Upload/js/jquery.fileupload.js"></script>
	<script type="text/javascript" src="/js/lib/jQuery-File-Upload/js/jquery.iframe-transport.js"></script>
	<script type="text/javascript" src="/js/lib/select2/select2.js"></script>
	<script type="text/javascript" src="/js/lib/jRating/jquery/jRating.jquery.js"></script>
	<script type="text/javascript" src="/js/lib/handlebars.js"></script>
	<script type="text/javascript" src="/js/global.js"></script>
	<script type="text/javascript" src="/js/form.js"></script>
	<script type="text/javascript" src="/js/popup.js"></script>
	<script type="text/javascript" src="/js/recipeCreate.js"></script>
	<script type="text/javascript" src="/js/recipeSearch.js"></script>
	<script type="text/javascript" src="/js/user.js"></script>

	<script id="searchResults" type="text/x-handlebars-template">
		<li id="{{uri}}" class="searchResult <?php echo $class; ?>">
			<article>
				<header>
					<h4>{{label}}</h4>
				</header>
				<img class="fLeft" src="{{imagePath}}" height="64" width="64">
				<section class="thumbnailRating">
					<div class="rating" data-average="{{avgRating}}"></div>
				</section>
			</article>
		</li>
	</script>
</head>

<body>
	<header>
		<h1>Semantic Recipe Finder</h1>
	</header>

	<div id="userOptionsContainer"><?php new userOptions(); ?></div>
	<section id="recipeCreateContainer"></section>

	<section id="recipeSearchContainer">
		<header>
			<h3><a class="panelHeader">Search Recipes<span class="indicator">-</span></a></h3>
		</header>
		<section class="wrapper">
			<section id="recipeSearchFacets">
				<form name="recipeSearch">
					<p class="note required-note"></p>
					<input type="hidden" name="formID" value="recipeSearch"/>
					<?php new searchOptions(); ?>
				</form>
			</section>
			
			<section id="recipeSearchResults">
				<p class="note">Select from the options on the left to start searching for recipes</p>
				<ul id="resultList"></ul>			
			</section>
		</section>
	</section>

	<footer>Copyright &copy; 2014 Alex Reynolds</footer>
</body>
</html>