var global = global || {};

global.user = {
	defaultState : 'hidden',
	init : function(args) {
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
			$('a.terms').bind('click',function(){
				global.popup.init({
					id : 'terms',
					path : '/templates/customer_service/terms.html'
				});
			});
			
		}
		else if (accountContainer.length) {
			_this.container = accountContainer;
			_this.selectedContent = _this.container.find("#accountSelectedContent");
			$('.signout').bind('click',function(){
				_this.signout();
			});
			$('#accountMenu a').bind('click',function(){
				$('#accountMenu li').removeClass('selected');
				$(this).parent().addClass('selected');
				_this.updateAccountContent(this);
			});
			$('#recipeCreate').bind('click',function(){
				global.recipeCreate.init();
			});
		}
		else {
			global.consoleDebug('No user segements on page');
			return null;
		}
		
		global.initPanel(_this,args.keepDisplaying);
		
		//Sign in container forms need events bound
		//This happens on first page load but needs to be done again here
		if (args.reload) { 
			global.form.init();
		}
	},
	switchPanels : function(template) {
		var _this = global.user;
		_this.wrapper.slideUp('slow');
		
		$.get(template)
		.done(function(panel) {
			$('#userOptionsContainer').html(panel);
			_this.init({
				reload : 1
			});
			_this.headerLink.click();			
		});
	},
	signin : function() {
		var _this = global.user;

		//FIXME: Hack - Yuckety yuck yuck
		_this.username = _this.signinForm.find('input[name="username"]').val();
		
		_this.switchPanels('/templates/userPanels/userAccount.php');		
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
		_this.switchPanels('/templates/userPanels/userLogin.php');
	},
	updateAccountContent : function(link) {
		var _this = global.user;
		
		$.get('/templates/userPanels/includes/' + link.id + '.php')
		.done(function(response){
			_this.selectedContent.html(response);
			global.user.init({
				reload : 1,
				keepDisplaying : 1
			});
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