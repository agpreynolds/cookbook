var global = global || {};

global.form = {
	requiredText : 'Fields marked with "*" are required',
	init : function() {
		var _this = global.form
		$('form').unbind('submit.form').bind('submit.form',_this.onSubmit);
		
		$('form').find('#fileupload').fileupload({
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
	            _this.reset(data.form);
	            global.form.selectCallback(data.form,data.result);

	            $.each(data.result.files, function (index, file) {
	                $('<p/>').text(file.name).appendTo(document.body);
	            });
    		},
    		fail : function (e, data) {
    			_this.reset(data.form);
    		},
		});

		$('form').each(function(){
			var requiredNoteNode = $(this).find(".required-note");
			if (!requiredNoteNode.length) {
				$(this).prepend($('<p>').addClass('note required-note').html(_this.requiredText));
			}
		});
	},
	onSubmit : function(evt) {
		evt.preventDefault();
		var form = this;
		var _this = global.form;
		
		$.post('/php/controllers/formHandler.php',$(form).serializeArray())
		.done(function(response){
			_this.reset(form);
			
			response = global.parseJSONResponse(response);
			
			_this.selectCallback(form,response);

			global.consoleDebug('Form: ' + form.name + ' successfully processed with response:',response);
		})
		.fail(function(response){
			_this.reset(form);
			_this.onError(form,response);
			global.consoleDebug('Form: ' + form.name + ' failed processing');
		});
	},
	reset : function(form) {
		$('#progress').remove();
		$(form).find('.errorList').remove();
		$(form).find('.error').removeClass('error');
	},
	selectCallback : function(form,response) {
		var _this = global.form;

		if (response.status == 'success') {
			_this.onSuccess(form,response);
		}
		else if (response.status == 'error') {
			_this.onError(form,response);
		}
	},
	onSuccess : function(form,response) {
		global.form.doCallback(form,response);
	},
	onError : function(form,response) {
		var _this = global.form;
		
		if (response.action) {
			_this.doCallback(form,response);			
		}
		else {
			_this.showErrors(form,response);
		}
	},
	showErrors : function(form,response,errorNode) {
		if (!errorNode) {
			var errorNode = $('<ul>').addClass('errorList');
			$(form).prepend(errorNode);
		}
		
		if (response && response.messages) {
			$(response.messages).each(function(){
				errorNode.append($('<li>').attr('id',this.key).addClass('error').html(this.text));
				if (this.field) {
					$(form).find('[name="' + this.field + '"],[name="' + this.field + '[]"],label[for="' + this.field + '"]').addClass('error');
				}
			});			
		}
		else {	
			errorNode.append($('<li>').attr('id','system_error').addClass('error').html('System Error'));
		}
	},
	doCallback : function(form,response) {
		if (response.action) {
			eval(response.action)(form,response);			
		}
	}
}

$(document).ready(global.form.init);