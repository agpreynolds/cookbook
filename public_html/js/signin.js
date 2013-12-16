var global = global || {};

global.siginin = {
	defaultState : 'hidden',
	init : function() {
		var _this = global.siginin;

		_this.container = $('#userLoginContainer');
		
		global.initPanel(_this);
	}
}

$(document).ready(global.siginin.init);