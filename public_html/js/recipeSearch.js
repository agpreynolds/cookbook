var global = global || {};

global.recipeSearch = {
	defaultState : 'visible',
	init : function() {
		var _this = global.recipeSearch;

		_this.container = $("#recipeSearchContainer");
		_this.searchForm = _this.container.find('form');
		_this.resultsContainer = _this.container.find('#recipeSearchResults');

		//Templates
		_this.smallResultTemplate = Handlebars.compile($("#smallResult").html());
		_this.largeResultTemplate = Handlebars.compile($("#largeResult").html());

		_this.selects = _this.searchForm.find("select");
		_this.selects.bind('change',function(){
			_this.searchForm.submit();
		}).select2();
		
		global.initPanel(_this);

		//Can access recipe details from uri
		//TODO: Restful API structure????
		//Rethought - Fragments are better - must make this more readable
		var recipe;
		if (recipe = location.hash.match("\\w*$").join()) {
			global.popup.init({
				id : 'resultLarge',
				path : '/php/controllers/formHandler.php',
				data : {
					method : 'resultLogic',
					data: {
						id : recipe.toLowerCase()
					}
				},
				callback : function(response,container,contentContainer) {
					global.recipeSearch.largeResultPanel.init(response,container,contentContainer);
				}
			});
		}
	},
	//TODO: Reset Search Form
	reset : function() {
		var _this = global.recipeSearch;

		_this.queryData = undefined;		
	},
	onSuccess : function(form,response) {
		var _this = global.recipeSearch;
		_this.updateResults(response);
	},
	onError : function(form,response) {
		var _this = global.recipeSearch;
		_this.updateResults(response);
	},
	updateResults: function(response) {
		var _this = global.recipeSearch;

		_this.resultsContainer.html( _this.smallResultTemplate(response) );
		
		_this.resultsContainer.find(".searchResult").unbind('click').bind("click",function(){
			global.popup.init({
				id : 'resultLarge',
				path : '/php/controllers/formHandler.php',
				data : {
					method : 'resultLogic',
					data: {
						id : this.id
					}
				},
				callback : function(response,container,contentContainer) {
					global.recipeSearch.largeResultPanel.init(response,container,contentContainer);
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
	init : function(response,container,contentContainer) {
		var _this = global.recipeSearch.largeResultPanel;
		_this.container = $("#resultLarge");

		response = global.parseJSONResponse(response);

		//FIXME: Not sure about the robustness of this
		response.username = global.user.username;

		contentContainer.html( global.recipeSearch.largeResultTemplate(response) );

		facebook.load();

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