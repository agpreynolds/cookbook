var facebook = {
	init : function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
		fjs.parentNode.insertBefore(js, fjs);
	},
	load : function() {
		//Remove and re-init
		//TODO: Investigate efficiency
		var script = $('#facebook-jssdk');
		script.next().remove();
		script.remove();
		facebook.init(document,'script','facebook-jssdk')
	}
}

