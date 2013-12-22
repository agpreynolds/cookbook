var global = global || {};

global.popup = {
    init : function(args) {
        if (!args || !args.id || !args.path) {
            global.consoleDebug('Missing args to: global.popup.init()');
            return false;
        }
        
        var path = args.path;
        var data = args.data || {};
        var callback = args.callback;
        
        var popupExists = function(id) {
            var ele = $(id);
            if (ele.length) {
                if (ele.hasClass('content')) {
                    var parents = ele.parents();
                    parents.get(1).show();
                    parents.get(0).center();
                    return 1;
                }
                else {
                    global.consoleDebug('Warning: Popup has same ID as existing element');
                }
            }
            return 0;
        }

        //If popup exists already no need to re-build it, just show it
        if (popupExists(args.id)) { return false; }

        var container = $('<div>');
        $('body').append(container);
        
        if (!args.noBg) {
            var bgContainer = $('<div>').addClass('popup-bg');
            container.append(bgContainer);
        }
        
        var fgContainer = $('<div>').addClass('popup');
        container.append(fgContainer);
        
        var contentContainer = $('<section>').addClass('content');
        contentContainer.attr('id',args.id);
        fgContainer.append(contentContainer);

        $.get(path,data)
        .done(function(response){
        	contentContainer.html(response);
        	fgContainer.center();
            
            $('body').animate({
                scrollTop: $('body').offset().top
            }, 500);
        	
            callback(response,container);
        });
        
        $(window).resize(function(){
        	fgContainer.center();
        });
    }                
}