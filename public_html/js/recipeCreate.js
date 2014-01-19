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

			$('#fileupload').fileupload({
       			dataType : 'json',
       			url : '/php/controllers/formHandler.php',
       			multipart : 'true',
       			formData : function(form) {
       				return form.serializeArray();
       			},
       			add : function(e,data) {
       				data.form.unbind('submit.form').bind('submit.form',function(evt){
       					evt.preventDefault();
       					data.submit();
       				});
       				$(this).after( $('<p>').html(data.files[0].name) );
       			},
        		done : function (e, data) {
		            $('#progress').remove();
		            data.form.find('.errorList').remove();
					data.form.find('.error').removeClass('error');
		            global.form.selectCallback(data.form,data.result);

		            $.each(data.result.files, function (index, file) {
		                $('<p/>').text(file.name).appendTo(document.body);
		            });
        		},
        		fail : function (e, data) {
        			$('#progress').remove();
        		},
    		});

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