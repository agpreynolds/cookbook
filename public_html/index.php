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
	<script type="text/javascript" src="/js/api/facebook.js"></script>

	<script id="smallResult" type="text/x-handlebars-template">
		{{#if messages.length}}
			<ul class="errorList">
			{{#each messages}}
				<li id="{{key}}" class="error">{{text}}</li>
			{{/each}}
			</ul>
		{{/if}}

		{{#if data.length}}
			<ul id="resultList">
			{{#each data}}
				<a href="#{{id}}">
				<li id="{{id}}" class="searchResult <?php echo $class; ?>">
					<article>
						<header>
							<h4>{{label}}</h4>
						</header>
						<img class="fLeft" src="{{imagePath}}" height="64" width="64">
						<section class="thumbnailRating">
							<div class="rating" data-average="{{avgRating}}"></div>
							<p>{{username}}</p>
						</section>
					</article>
				</li>
				</a>
			{{/each}}
			</ul>
			<p class="note">Showing 1 - {{data.length}} of {{data.length}}</p>
		{{/if}}
	</script>
	<script id="largeResult" type="text/x-handlebars-template">
		{{#if data}}
			{{#with data}}
				<article id="{{id}}" class="contentContainer">
					<header>
						<h3>{{label}}<a class="close-link">X</a></h3>			
					</header>
					<section class="wrapper">
						<div class="img">
							<img src="{{imagePath}}" height="128" width="128">
							<div id="fb-root"></div>
							<div class="fb-share-button" data-type="button_count"></div>
						</div>
						<div class="details">
							<p>{{comment}}</p>
							
							<p>Uploaded by:
								<a href="/user.php?username={{username}}">
									{{username}}
								</a>
							</p>

							<p>Cuisine Type: {{#each cuisine}}	{{this}} {{/each}}</p>
							<p>Suitable as a: {{#each course}} {{this}} {{/each}}</p>
							
							<form name="recipeRating" class="hidden">
								<input type="hidden" name="formID" value="recipeRating"/>
								<input type="hidden" name="subject" value="{{uri}}" />
								<input type="hidden" name="rating" id="rating"/>
							</form>
							<div class="ratingLarge"></div>
						</div>
											
						<section id="components">
							{{#if ingredients}}
							<article class="componentOption">
								<header>
									<a><h4>Ingredients <span class="indicator">+</span></h4></a>
								</header>
								<section>
									<ul>
										{{#each ingredients}}
											<li id="{{uri}}">{{quantity}} {{name}}</li>
										{{/each}}
									</ul>
								</section>
							</article>
							{{/if}}
							
							{{#if steps}}
							<article class="componentOption">
								<header>
									<a><h4>Steps <span class="indicator">+</span></h4></a>
								</header>
								<section>
									<ol>
										{{#each steps}}
											<li>{{this}}</li>
										{{/each}}
									</ol>
								</section>
							</article>
							{{/if}}

							<article class="componentOption">
								<header>
									<a><h4>Reviews <span class="indicator">+</span></h4></a>
								</header>
								<section>
									{{#if reviews}}
									<ul>
										{{#each reviews}}
											<li id="{{uri}}">{{title}} {{text}}</li>
										{{/each}}
									</ul>
									{{/if}}

									<header class="black">
										<h4>Review this Recipe</h4>
									</header>
									<form name="recipeReview">
										<input type="hidden" name="formID" value="recipeReview"/>
										<input type="hidden" name="subject" value="{{uri}}" />
										
										{{#if ../../username}}
											<input type="hidden" name="reviewer" value="{{../../username}}"/>
										{{else}}
											<label for="reviewer">*Username</label>
											<input type="text" name="reviewer"/>
										{{/if}}										
																				
										<label for="title">*Title</label>
										<input type="text" name="title"/>

										<label for="text">*Review Text</label>
										<textarea name="text"/>
										
										<input type="submit" value="Submit">	
									</form>
								</section>
							</article>
						</section>
						<section id="recipeModeration">
							<a>Report to a Moderator</a>
						</section>
					</section>
				</article>
			{{/with}}
		{{/if}}
	</script>
</head>

<body>
	<header class="black">
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
				<ul class="errorList">
					<li class="error">Select from the options on the left to start searching for recipes</li>
				</ul>							
			</section>
		</section>
	</section>

	<footer>Copyright &copy; 2014 <a href="http://agpreynolds.co.uk">Alex Reynolds</a></footer>
</body>
</html>