<?php

return array(
	'db_host' => '127.0.0.1', /* default: localhost */
	'db_name' => 'cookbook',
	'db_user' => 'root',
	'db_pwd' => 'ls55ftc',
	'prefixes' => array(
		'foaf: <http://xmlns.com/foaf/0.1/>',
		'recipe: <http://linkedrecipes.org/schema/>',
		'rev: <http://purl.org/stuff/rev#>',
		'diet: <http://agpreynolds.co.uk/data/rdf/vegetarian/>',
		'dCourse: <http://palacealex.com/data/Course/>',
		'dCuisine: <http://palacealex.com/data/Cuisine/>',
		'dFood: <http://palacealex.com/data/Food/>',
		'dFoodGroup: <http://palacealex.com/data/FoodGroup/>',
		'dIngredient: <http://palacealex.com/data/Ingredient/>',
		'dRecipe: <http://palacealex.com/data/Recipe/>',
		'dTechnique: <http://palacealex.com/data/Technique/>',
		'dTool: <http://palacealex.com/data/Tool/>',
		'dReview: <http://palacealex.com/data/Review/>',
		'dUser: <http://palacealex.com/data/User/>',
		'dUserRestricted: <http://palacealex.com/data/User/Restricted/>',
		'dClass: <http://palacealex.com/data/Classes/>'
	),
	/* store */
	'store_name' => 'arc_tests',
	/* network */
	'proxy_host' => '192.168.1.1',
	'proxy_port' => 80,
	/* parsers */
	'bnode_prefix' => 'bn',
	/* sem html extraction */
	'sem_html_formats' => 'rdfa microformats',
	/* endpoint */
  	'endpoint_features' => array(
    	'select', 'construct', 'ask', 'describe', 
    	'load', 'insert', 'delete', 
    	'dump' /* dump is a special command for streaming SPOG export */
  	),
  	'endpoint_timeout' => 60, /* not implemented in ARC2 preview */
  	'endpoint_read_key' => '', /* optional */
  	'endpoint_write_key' => '', /* optional, but without one, everyone can write! */
  	'endpoint_max_limit' => 250 /* optional */
);

?>