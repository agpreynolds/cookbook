var global = global || {};

global.form = {
	requiredText : 'Fields marked with "*" are required',
	init : function() {
		var _this = global.form
		$('form').unbind('submit.form').bind('submit.form',_this.onSubmit);
		$('form').each(function(){
			var requiredNoteNode = $(this).find(".required-note");
			if (!requiredNoteNode.length) {
				$(this).prepend($('<p>').addClass('note required-note').html(_this.requiredText));
			}
		});
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
	onSubmit : function(evt) {
		evt.preventDefault();
		var form = this;
		var _this = global.form;
		
		$.post('/php/controllers/formHandler.php',{
			method : form.name,
			data : $(form).serializeObject()
		})
		.done(function(response){
			$('#progress').remove();
			$(form).find('.errorList').remove();
			$(form).find('.error').removeClass('error');
			
			try {
				response = JSON.parse(response);
			}
			catch(e) {
				response = {
					status : 'error',
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
	},
	onSuccess : function(form,response) {
		var _this = global.form;
		_this.doCallback(form,response);
	},
	onError : function(form,response) {
		var _this = global.form;
		var errorNode = $('<ul>').addClass('errorList');
		$(form).prepend(errorNode);
		
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

		_this.doCallback(form,response);
	},
	doCallback : function(form,response) {
		if (response.action) {
			eval(response.action)(form,response);			
		}
	}
}

$(document).ready(global.form.init);