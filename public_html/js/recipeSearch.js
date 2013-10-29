var global = global || {};

global.recipeSearch = {
	defaultState : 'visible',
	queryData : {
		searchByCuisineType : [],
		searchByMealType : []
	},
	submitQuery : function() {

	},
	handleQueryData : function() {
		var _this = global.recipeSearch;

		$.post('search.php',_this.queryData)
			.done(function() {
				_this.resultPanel.init();
			})
			.fail(function() {
				_this.resultPanel.init();
			});
	},
	displayResults : function(responseData) {
		if (!responseData || responseData.recipes) {
			global.consoleDebug("Unable to find recipes");
			return null;
		}
	},
	init : function() {
		var _this = global.recipeSearch;

		_this.container = $("#recipeSearchContainer");
		
		_this.typePanel.init();
	},
	reset : function() {
		var _this = global.recipeSearch;

		_this.queryData = undefined;		
	}
};

global.recipeSearch.typePanel = {
	defaultState : 'visible',
	init : function() {
		var _this = global.recipeSearch.typePanel;

		_this.container = $("#recipeSearchParameters");
		_this.mealType = $("#searchByMealType");
		_this.cuisineType = $("#searchByCuisineType");

		_this.listOptions = [ _this.cuisineType, _this.mealType ];

		$(_this.listOptions).each(function(i,item){
			item.bind("click",function(){
				global.recipeSearch.valuePanel.init({
					view : this.id
				});				
			});			
		});		
	}
};

global.recipeSearch.valuePanel = {
	defaultState : 'hidden',
	init : function(args) {
		//Panel won't work - exit out
		if (!args || !args.view) {
			global.consoleDebug('global.recipeSearch.valuePanel.init() Invalid arguments specified' + args);
			return null;
		}

		//Define _this as a shortcut to the panel
		var _this = global.recipeSearch.valuePanel;

		//Set the nodes we may need to access
		_this.container = $("#recipeSearchValues");
		_this.searchByMealType = $("#mealTypeValues");
		_this.searchByCuisineType = $("#cuisineTypeValues");

		//Get a list of value lists and hide them all by default
		_this.valueLists = $(".valueList");
		_this.valueLists.hide();
		
		//Show the list of values requested
		_this[args.view].show();
		
		//Bind a click event to each available option to store user selection
		//TODO: this.innerHTML will only work while no additional content is stored
		//TODO: enhance selector, haven't considered sublists
		_this.availableOptions = _this[args.view].find("li");
		_this.availableOptions.bind("click",function(){
			if ( $(this).hasClass('selected') ) {
				$(this).removeClass('selected');
				var index = $.inArray(this.innerHTML,global.recipeSearch.queryData[args.view]);
				global.recipeSearch.queryData[args.view].splice(index,1);
				global.recipeSearch.handleQueryData();
			}
			else {
				$(this).addClass('selected');
				global.recipeSearch.queryData[args.view].push(this.innerHTML);								
				global.recipeSearch.handleQueryData();
			}
		});

		//If we are not already showing the panel, show it
		this.container.is(":hidden") ? this.container.show() : '';
	}
};

global.recipeSearch.resultPanel = {
	defaultState : 'hidden',
	init : function() {
		var _this = global.recipeSearch.resultPanel;

		_this.container = $("#recipeSearchResults");

		//If we are not already showing the panel, show it
		this.container.is(":hidden") ? this.container.show() : '';
	}
};

window.onload = global.recipeSearch.init;