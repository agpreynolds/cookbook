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
       				data.form.unbind('submit.form').unbind('submit.fileupload').bind('submit.fileupload',function(evt){
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
        		progressall : function (e, data) {
			        // var progress = parseInt(data.loaded / data.total * 100, 10);
			        // $('#progress .bar').css({
			        //     'width' : progress + '%'
			        // });
			    }
    		});

			$('.clone-ingredient').bind('click',function(){
				var newNode = $('.ingredient').last().clone();
				newNode.find('input').val('');
				$(this).parent().before( newNode );
			});

			//TODO: Move this into form.js as generic functionality
			$('form[name="recipeCreate"]')
				.unbind('submit.form')
				.unbind('submit.fileupload')
				.bind('submit.fileupload',function(evt){
					evt.preventDefault();
					var form = this;
					var _this = global.form;
					
					$.post('/php/controllers/formHandler.php',$(form).serializeArray())
					.done(function(response){
						$('#progress').remove();
						$(form).find('.errorList').remove();
						$(form).find('.error').removeClass('error');
						
						try {
							response = JSON.parse(response);
						}
						catch(e) {
							response = {
								type : 'error',
								messages : [{
									key : 'json_error',
									text : 'Unable to parse JSON',
									field : ''
								}]
							};
						}

						_this.selectCallback(form,response);

						global.consoleDebug('Form: ' + form.name + ' successfully processed with response:',response);
					})
					.fail(function(response){
						$('#progress').remove();
						_this.onError(form,response);
						global.consoleDebug('Form: ' + form.name + ' failed processing');
					});
				});
		});
	},
	onSuccess : function() {
		alert('Recipe Successfully Uploaded');
	}
}