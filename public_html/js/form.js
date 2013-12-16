var global = global || {};

global.form = {
	init : function() {
		var _this = global.form
		$('form').bind('submit',_this.onSubmit);
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
			var response = JSON.parse(response);

			if (response.type == 'error') {
				_this.onError(form,response.messages);
			}
			global.consoleDebug('Form: ' + form.name + ' successfully processed');
		})
		.fail(function(response){
			global.consoleDebug('Form: ' + form.name + ' failed processing');
		});
	},
	onError : function(form,messages) {
		var errorNode = $(form).find('errors')
		if ( errorNode.length ) {
			errorNode.html(messages);
		}
		else {
			$(form).prepend(messages);
		}
	}
}

$(document).ready(global.form.init);