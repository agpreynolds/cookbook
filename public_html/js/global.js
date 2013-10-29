var global = {
	debug : 1,
	consoleDebug : function(msg,obj) {
		if (global.debug && msg) {
			console.log(msg);
			if (obj) {
				console.log(obj);
			}
		}
	}
};