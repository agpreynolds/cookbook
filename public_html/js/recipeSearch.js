var global = global || {};

global.recipeSearch = {
	defaultState : 'visible',
	queryData : {
		method : 'recipeSearch',
		data : { }
	},
	handleQueryData : function() {
		var _this = global.recipeSearch;

		//TODO: Reliable way of detecting no params
		//TODO: Make use of resultData for filtering rather than unnecessary querying of backend
		if (_this.queryData.data) {
			$.get('/templates/searchPanels/resultSmall/index.php',_this.queryData)
				.done(function(response) {
					var responseParsed = $.parseJSON(response);
					_this.resultData = responseParsed.data;
					if (_this.resultPanel.state == 'visible') {
						_this.resultPanel.resultList.html(responseParsed.html);
						_this.resultPanel.bindEvents();
					}
					else {
						_this.resultPanel.init(responseParsed.html);					
					}
				})
				.fail(function() {
					global.consoleDebug("get request failed");
				});			
		}
	},	
	init : function() {
		var _this = global.recipeSearch;

		_this.container = $("#recipeSearchContainer");

		global.initPanel(_this);
		
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
			var facetOptionsList = parent.find("ul.facetOptions");
			//If this facet is already selected, un-select and return
			if (parent.hasClass("selected")) {
				parent.removeClass("selected");
				facetOptionsList.slideToggle();
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
					var searchType = $(this).parents().get(2).id;
					var value = this.innerHTML;
					if ( $(this).parent().hasClass('selected') ) {
						var index = $.inArray(value,global.recipeSearch.queryData.data[searchType]);
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

			if ( !facetOptionsList.length ) {
				$.get('/templates/facetOptionsList/' + parent.get(0).id + '.php')
					.done(function(html){
						var listNode = $(html);
						bindEventsToOptionsList(listNode);
						parent.append(listNode);
						listNode.slideToggle();
					})
					.fail(function(response){
						global.consoleDebug(response);
					})
			}
			else {
				facetOptionsList.slideToggle();
				if ( !facetOptionsList.hasClass("evBound") ) {
					bindEventsToOptionsList(facetOptionsList);
				}
			}
		});

		global.consoleDebug("global.recipeSearch.facetPanel successfully initialised" ,_this);	
	}
};

global.recipeSearch.resultPanel = {
	state : 'hidden',
	init : function(responseData) {
		//If there is no response data, something went wrong
		if (!responseData) {
			global.consoleDebug("global.recipeSearch.resultPanel.init() No responseData provided");
			return null;
		}

		var _this = global.recipeSearch.resultPanel;

		_this.container = $("#recipeSearchResults");
		_this.resultList = $("#resultList");

		_this.resultList.html(responseData);
		_this.bindEvents();
		
		//If we are not already showing the panel, show it
		_this.container.is(":hidden") ? _this.container.show() : '';
		_this.state = 'visible';

		global.consoleDebug("global.recipeSearch.resultPanel successfully initialised" ,_this);
	},
	bindEvents : function() {
		var _this = global.recipeSearch.resultPanel;
		_this.resultThumbnails = $(".searchResult");

		_this.resultThumbnails.unbind('click').bind("click",function(){
			var ele = this;
			$(global.recipeSearch.resultData).each(function(i,item){
				if (item.label == ele.id) {
					global.popup.init({
						id : 'resultLarge',
						path : '/templates/searchPanels/resultLarge/index.php',
						data : {
							method : 'recipe',
							data: item
						},
						callback : function(response,container) {
							global.recipeSearch.largeResultPanel.init(response,container);
						}
					});
				}
			});
		});		
	}
};

global.recipeSearch.largeResultPanel = {
	state : 'hidden',
	init : function(response,container) {
		var _this = global.recipeSearch.largeResultPanel;
		_this.closeButton = $("a.close-link");
		_this.closeButton.bind('click',function(){
			container.remove();
		});
		
		_this.componentLists = $("article.componentOption header");
		_this.componentLists.bind('click',function(){
			var indicator = $(this).find('span.indicator');
			global.toggleHTML(indicator,'+','-');
			
			$(this).parent().find('ul,ol').slideToggle();
		});
	}
};

$(document).ready(global.recipeSearch.init);