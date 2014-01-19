var global = global || {};

global.debug = 1;
global.consoleDebug = function(msg,obj) {
	if (global.debug && msg) {
		console.log(msg);
		if (obj) {
			console.log(obj);
		}
	}
}
global.initPanel = function(panel,keepDisplaying) {
	panel.wrapper = panel.container.find('section.wrapper');
	panel.headerLink = panel.container.find('a.panelHeader');
	panel.forms = panel.container.find('form');

	if (panel.defaultState == 'hidden' && !keepDisplaying ) {
		panel.wrapper.hide();			
	}

	panel.headerLink.unbind('click').bind('click',function(){
		var indicator = $(this).find('span.indicator');
		global.toggleHTML(indicator,'+','-');
		panel.wrapper.slideToggle('slow');
	});

	panel.forms.unbind('submit.panel').bind('submit.panel',function(){
		var progressImg = new Image();
		progressImg.src = '/media/images/buttons/ajax-loader.gif';
		global.popup.init({
			id : 'progress',
			content : progressImg,
			positionNode : panel.wrapper
		});
	});
}
global.toggleHTML = function(ele,a,b) {
	if (ele.html() === a) {
		return ele.html(b);
	}
	else if (ele.html() === b) {
		return ele.html(a)
	}
	return 0;
}

global.parseJSONResponse = function(string,field) {
	try {
		response = JSON.parse(string);
	}
	catch(e) {
		response = {
			status : 'error',
			messages : [{
				key : 'json_error',
				text : 'Unable to parse JSON',
				field : field
			}]
		};
	}

	return response;
}