var global = global || {};

global.recipeSearch = {
	defaultState : 'visible',
	queryData : {
		method : 'recipeSearch',
		data : { }
	},
	handleQueryData : function() {
		var _this = global.recipeSearch;

		$.get('/php/controllers/ajax.php',_this.queryData)
			.done(function(responseData) {
				_this.resultPanel.init($.parseJSON(responseData));
				global.consoleDebug('response',responseData);
			})
			.fail(function() {
				global.consoleDebug("get request failed");
			});
	},	
	init : function() {
		var _this = global.recipeSearch;

		_this.container = $("#recipeSearchContainer");
		
		_this.facetPanel.init();
	},
	reset : function() {
		var _this = global.recipeSearch;

		_this.queryData = undefined;		
	}
};

global.recipeSearch.facetPanel = {
	defaultState : 'visible',
	init : function() {
		var _this = global.recipeSearch.facetPanel;

		_this.container = $("#recipeSearchFacets");
		_this.searchFacets = $(".searchFacet");

		//Get the top level links and bind a click event
		_this.facetLinks = $("a.facetLink");
		_this.facetLinks.bind("click",function(){
			//Get the parent of the link element
			var parent = $(this).parent();
			
			//If this facet is already selected, un-select and return
			if (parent.hasClass("selected")) {
				parent.removeClass("selected");
				return;
			}
			//Only one facet selected at a time, de-select other facets
			if ( _this.searchFacets.hasClass("selected") ) {
				_this.searchFacets.removeClass("selected");
			}
			
			//Make this facet active
			parent.addClass("selected");

			var bindEventsToOptionsList = function(listNode) {
				var facetValues = listNode.find("li.facetValue a");
				facetValues.bind("click",function(){
					var searchType = $(this).parents().get(1).id;
					var value = this.innerHTML;
					if ( $(this).parent().hasClass('selected') ) {
						var index = $.inArray(value,global.recipeSearch.queryData[searchType]);
						global.recipeSearch.queryData.data[searchType].splice(index,1);
						global.recipeSearch.handleQueryData();
					}
					else {
						if ( !global.recipeSearch.queryData.data[searchType] ) {
							global.recipeSearch.queryData.data[searchType] = [];
						}
						global.recipeSearch.queryData.data[searchType].push(value);								
						global.recipeSearch.handleQueryData();
					}
					$(this).parent().toggleClass("selected");				
				})
				listNode.addClass("evBound");
			}

			var facetOptionsList = parent.find("ul.facetOptions");
			if ( !facetOptionsList.length ) {
				$.get('/templates/facetOptionsList/' + parent.get(0).id + '.php')
					.done(function(html){
						var listNode = $(html);
						bindEventsToOptionsList(listNode);
						parent.append(listNode);
					})
					.fail(function(response){
						global.consoleDebug(response);
					})
			}
			else if ( !facetOptionsList.hasClass("evBound") ) {
				bindEventsToOptionsList(facetOptionsList);
			}		
		});

		global.consoleDebug("global.recipeSearch.facetPanel successfully initialised" ,_this);	
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

$(document).ready(global.recipeSearch.init);