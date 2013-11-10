var global = global || {};

global.recipeSearch = {
	defaultState : 'visible',
	queryData : {
		method : 'recipeSearch',
		data : {
			searchByCuisineType : [],
			searchByMealType : []			
		}
	},
	handleQueryData : function() {
		var _this = global.recipeSearch;

		$.get('/php/controllers/ajax.php',_this.queryData)
			.done(function(responseData) {
				alert(responseData);
			})
			.fail(function() {
				alert("get request failed");
			});
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

		_this.searchOptions = $(".searchOption");

		_this.searchOptions.bind("click",function(){
			if ($(this).hasClass("selected")) {
				$(this).removeClass("selected");
			}
			else {
				if ( _this.searchOptions.hasClass("selected") ) {
					_this.searchOptions.removeClass("selected");
				}
				$(this).addClass("selected");
				global.recipeSearch.valuePanel.init({ view : this.id });					
			}
		});

		global.consoleDebug("global.recipeSearch.typePanel successfully initialised" ,_this);	
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
		_this.view = args.view;
		_this[_this.view].show();

		//Bind the events for the panel
		_this.bindEvents();		

		//If we are not already showing the panel, show it
		this.container.is(":hidden") ? this.container.show() : '';

		global.consoleDebug("global.recipeSearch.valuePanel successfully initialised" ,_this);
	},
	bindEvents : function() {
		//Define _this as a shortcut to the panel
		var _this = global.recipeSearch.valuePanel;

		//Bind a click event to each available option to store user selection
		//TODO: this.innerHTML will only work while no additional content is stored
		_this.availableOptions = _this[_this.view].find("li.searchValue");		
		_this.availableOptions.unbind("click.searchValue")
			.bind("click.searchValue",function(){
				if ( $(this).hasClass('selected') ) {
					var index = $.inArray(this.innerHTML,global.recipeSearch.queryData[_this.view]);
					global.recipeSearch.queryData.data[_this.view].splice(index,1);
					global.recipeSearch.handleQueryData();
				}
				else {
					global.recipeSearch.queryData.data[_this.view].push(this.innerHTML);								
					global.recipeSearch.handleQueryData();
				}
				$(this).toggleClass("selected");				
			});	
	}
};

global.recipeSearch.resultPanel = {
	defaultState : 'hidden',
	init : function(responseData) {
		//If there is no response data, something went wrong
		if (!responseData) {
			global.consoleDebug("global.recipeSearch.resultPanel.init() No responseData provided");
			return null;
		}

		var _this = global.recipeSearch.resultPanel;

		_this.container = $("#recipeSearchResults");
		_this.resultThumbnails = $(".searchResult");

		if (!responseData.recipes) {
			_this.container.html("<p>No recipes were found</p>");
		}

		_this.resultThumbnails.bind("click",function(){
			//Launch the full recipe
			console.log(this);
		});

		//If we are not already showing the panel, show it
		this.container.is(":hidden") ? this.container.show() : '';

		global.consoleDebug("global.recipeSearch.resultPanel successfully initialised" ,_this);
	}
};

window.onload = global.recipeSearch.init;