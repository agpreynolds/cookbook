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
       				console.log('test');
       				data.form.unbind('submit').bind('submit.fileupload',function(evt){
       					evt.preventDefault();
       					data.submit();
       				});
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
        			console.log('test');
        		},
        		progressall : function (e, data) {
			        // var progress = parseInt(data.loaded / data.total * 100, 10);
			        // $('#progress .bar').css({
			        //     'width' : progress + '%'
			        // });
			    }
    		});
		});
	},
	onSuccess : function() {
		alert('Recipe Successfully Uploaded');
	}
}