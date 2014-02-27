var global = global || {};

global.recipeSearch = {
	defaultState : 'visible',
	init : function() {
		var _this = global.recipeSearch;

		_this.container = $("#recipeSearchContainer");

		_this.searchForm = _this.container.find('form');

		_this.selects = _this.searchForm.find("select");
		_this.selects.bind('change',function(){
			_this.searchForm.submit();
		}).select2();
		
		global.initPanel(_this);
	},
	//TODO: Reset Search Form
	reset : function() {
		var _this = global.recipeSearch;

		_this.queryData = undefined;		
	},
	onSuccess : function(form,response) {
		var _this = global.recipeSearch;
		_this.resultPanel.init(response.html);
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
			global.popup.init({
				id : 'resultLarge',
				path : '/templates/searchPanels/resultLarge/index.php',
				data : {
					method : 'resultLogic',
					data: {
						uri : this.id
					}
				},
				callback : function(response,container) {
					global.recipeSearch.largeResultPanel.init(response,container);
				}
			});						
		});		
	}
};

global.recipeSearch.largeResultPanel = {
	state : 'hidden',
	init : function(response,container) {
		var _this = global.recipeSearch.largeResultPanel;
		_this.container = $("#resultLarge");
		global.initPanel(_this);

		_this.contentContainer = _this.container.find('article.contentContainer').get(0);

		_this.closeButton = _this.container.find("a.close-link");
		_this.closeButton.bind('click',function(){
			container.remove();
		});
		
		_this.componentLists = _this.container.find("article.componentOption header");
		_this.componentLists.bind('click',function(){
			var indicator = $(this).find('span.indicator');
			global.toggleHTML(indicator,'+','-');
			
			$(this).parent().find('section').slideToggle();
		});

		_this.moderation = _this.container.find('#recipeModeration');
		_this.moderationLink = _this.moderation.find('a');

		_this.moderationLink.bind('click',function(){
			$.get('/templates/moderation/form.php',{
				method : 'moderationLogic',
				data : {
					subject : _this.contentContainer.id
				}
			})
			.done(function(response){
				_this.moderation.html(response);
				global.form.init();
				$(window).resize();
			});
		});
	}
};

$(document).ready(global.recipeSearch.init);