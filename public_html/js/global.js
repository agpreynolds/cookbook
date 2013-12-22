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
global.initPanel = function(panel) {
	panel.wrapper = panel.container.find('section.wrapper');
	panel.headerLink = panel.container.find('a.panelHeader');

	if (panel.defaultState == 'hidden') {
		panel.wrapper.hide();			
	}

	panel.headerLink.bind('click',function(){
		var indicator = $(this).find('span.indicator');
		global.toggleHTML(indicator,'+','-');
		panel.wrapper.slideToggle('slow');
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