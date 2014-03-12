var global = global  || {};

global.recipeCreate = {
	init : function() {
		var _this = global.recipeCreate;
		_this.container = $('#recipeCreateContainer');

		$.get('/templates/createPanel')
		.done(function(response){
			_this.container.html(response);
			global.initPanel(_this);
			global.form.init();

			_this.container.find('select').select2();

			$('.clone-ingredient').bind('click',function(){
				var newNode = $('.ingredient').last().clone();
				newNode.find('.select2-container').remove();
				newNode.find('select').select2();
				newNode.find('input').val('');
				$(this).parent().before( newNode );
			});

			$('.clone-step').bind('click',function(){
				var newNode = $('.step').last().clone();
				newNode.find('input').val('');
				$(this).parent().before( newNode );
			});
		});
	},
	onSuccess : function(form,response) {
		global.popup.init({
				id : 'resultLarge',
				path : '/php/controllers/formHandler.php',
				data : {
					method : 'resultLogic',
					data: {
						id : $(form.label).val().toLowerCase()
					}
				},
				callback : function(response,container,contentContainer) {
					global.recipeSearch.largeResultPanel.init(response,container,contentContainer);
				}
			});
	}
}