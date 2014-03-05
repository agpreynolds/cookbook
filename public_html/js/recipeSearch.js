var global = global || {};

global.recipeSearch = {
	defaultState : 'visible',
	init : function() {
		var _this = global.recipeSearch;

		_this.container = $("#recipeSearchContainer");
		_this.searchForm = _this.container.find('form');
		_this.resultsContainer = _this.container.find('#resultList');

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
		_this.resultsContainer.removeClass('errorList').empty();
		_this.updateResults(response.html);
	},
	onError : function(form,response) {
		var _this = global.recipeSearch;
		_this.resultsContainer.addClass('errorList').empty();
		global.form.showErrors(form,response,_this.resultsContainer);
	},
	updateResults: function(content) {
		var _this = global.recipeSearch;

		_this.resultsContainer.html(content);

		_this.resultsContainer.find(".searchResult").unbind('click').bind("click",function(){
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

		//TODO: Modulise This
		$('.rating').jRating({
			rateMax : 5,
			bigStarsPath : 'js/lib/jRating/jquery/icons/stars.png',
			isDisabled : true
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

		_this.ratingForm = $('form[name="recipeRating"]');
		_this.ratingInput = _this.ratingForm.find('#rating');
		$('.ratingLarge').jRating({
			rateMax : 5,
			bigStarsPath : 'js/lib/jRating/jquery/icons/stars.png',
			sendRequest : 0,
			onClick : function(element,rating) {
				_this.ratingInput.val(rating);
				_this.ratingForm.submit();
			}
		});
	}
};

$(document).ready(global.recipeSearch.init);