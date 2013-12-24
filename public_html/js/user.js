var global = global || {};

global.user = {
	defaultState : 'hidden',
	init : function(reload) {
		var _this = global.user;

		var signInContainer = $("#userLoginContainer");
		var accountContainer = $("#userAccountContainer");

		if (signInContainer.length) {
			_this.container = signInContainer;
			_this.signinForm = signInContainer.find('form[name="userLogin"]');
			_this.registrationForm = signInContainer.find('form[name="userSignup"]');
			_this.registrationForm.find('input[name="password"]').bind('keyup',function(){
				_this.checkPasswordStrength(this);
			});
			
			//Sign in container forms need events bound
			//This happens on first page load but needs to be done again here
			if (reload) { 
				global.form.init();
			}
		}
		else if (accountContainer.length) {
			_this.container = accountContainer;
			$('.signout').bind('click',function(){
				_this.signout();
			});
			$('#recipeCreate').bind('click',function(){
				global.recipeCreate.init();
			})
		}
		else {
			global.consoleDebug('No user segements on page');
			return null;
		}
		
		global.initPanel(_this);
	},
	switchPanels : function(panel) {
		var _this = global.user;
		_this.wrapper.slideUp('slow');
		setTimeout(function(){
			$('#userOptionsContainer').html(panel);
			_this.init(1);
			_this.headerLink.click();		
		},600);
	},
	signin : function() {
		var _this = global.user;
		$.get('/templates/userPanels/userAccount.php')
		.done(function(response){
			_this.switchPanels(response);
		});
	},
	signinError : function(form,response) {
		var _this = global.user;
		if (response && response.messages) {
			$(response.messages).each(function(){
				if (this.key == 'user_not_recognized') {
					var currentUser = _this.signinForm.find('input[name="username"]').val();
					var newUser = _this.registrationForm.find('input[name="username"]')
					newUser.val(currentUser);
					newUser.focus();
				}
			})
		}
	},
	signout : function() {
		var _this = global.user;
		$.post('/templates/userPanels/userLogin.php',{
			method : 'userLogout',
			data : {}
		})
		.done(function(response){
			_this.switchPanels(response);
		});
	},
	checkPasswordStrength : function(field) {
		var _this = global.user;
		var value = $(field).val();
		var strength;
		var outputNode = $('.pwd-strength');
		
		if (!outputNode.length) {
			outputNode = $('<p>').addClass('pwd-strength note');
			$(field).after(outputNode);
		}

		if ( value.length < 6 ) {
			strength = 'weak';			
		}
		else if (value.length < 10) {
			strength = 'average';
		}
		else {
			strength = 'strong';
		}

		outputNode.html("Password strength: <span class='" + strength + "'>" + strength + "</span>");
	}
}

$(document).ready(global.user.init);