var global = global || {};

global.form = {
	requiredText : 'Fields marked with "*" are required',
	init : function() {
		var _this = global.form
		$('form').unbind('submit').bind('submit',_this.onSubmit);
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

		$(form).find('.errorList').remove();
		$(form).find('.error').removeClass('error');
		
		$.post('/php/controllers/formHandler.php',{
			method : form.name,
			data : $(form).serializeObject()
		})
		.done(function(response){
			var response = JSON.parse(response);

			if (response.type == 'success') {
				_this.onSuccess(form,response);
			}
			else if (response.type == 'error') {
				_this.onError(form,response);
			}
			global.consoleDebug('Form: ' + form.name + ' successfully processed with response:',response);
		})
		.fail(function(response){
			_this.onError(form,response);
			global.consoleDebug('Form: ' + form.name + ' failed processing');
		});
	},
	onSuccess : function(form,response) {
		if (response.onSuccess) {
			eval(response.onSuccess)();			
		}
	},
	onError : function(form,response) {
		var errorNode = $('<ul>').addClass('errorList');
		$(form).prepend(errorNode);
		
		if (response && response.messages) {
			$(response.messages).each(function(){
				errorNode.append($('<li>').attr('id',this.key).addClass('error').html(this.text));
				if (this.field) {
					$(form).find('[name="' + this.field + '"],label[for="' + this.field + '"]').addClass('error');
				}
			});			
		}
		else {	
			errorNode.append($('<li>').attr('id','system_error').addClass('error').html('System Error'));
		}

		if (response.onError) {
			eval(response.onError)(form,response);			
		}
	}
}

$(document).ready(global.form.init);