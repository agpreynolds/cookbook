<?php

return array(
	'searchByCuisineType' => array(
		'active' => 1,
		'label' => 'Cuisine Type',
		'mapsTo' => '?cuisine',
		'options' => array(
			'British','Chinese','Indian','Italian','Mexican','Russian'
		)
	),
	'searchByCourse' => array(
		'active' => 1,
		'label' => 'Course',
		'mapsTo' => '?course',
		'options' => array(
			'Starter','Main','Dessert'
		)
	)
	// 'byMealType' => 1,
	// 'byIngredient' => 1,
	// 'byEquipment' => 1
);

?>