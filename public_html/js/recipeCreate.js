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
				newNode.find('input').val('');
				$(this).parent().before( newNode );
			});			
		});
	},
	onSuccess : function() {
		alert('Recipe Successfully Uploaded');
	}
}