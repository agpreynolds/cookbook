/*
    * File for extensions to the jQuery wrapper
    * Attribution will be provided where due
*/

/* ************************************************ */

/*
    * Retrieved from http://jsfiddle.net/sxGtM/3/
    * Answer to question http://stackoverflow.com/questions/1184624/convert-form-data-to-js-object-with-jquery
*/
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

/*
    * Center a jQuery element
    * Could probably improve this using jQuery itself
*/
$.fn.center = function(ele) {
    var container = {};
    if (ele) {
        container.width = ele.outerWidth();
        container.height = ele.outerHeight();
    }
    else {
        container.width = window.innerWidth;
        container.height = window.innerHeight;
    }
    var width = this.outerWidth();
    var xPos =  ( container.width - width ) / 2;
    var height = this.outerHeight();
    var yPos = ( container.height - height ) / 2;
    if (yPos < 10 ) {
        yPos = 10;
    }
    this.css({
        'left' : xPos + "px",
        'top' : yPos + "px",
        'position' : 'absolute'
    });
}

/*
    * Overlays an element on top of an existing element
    * Current usage : Loading bar
*/
$.fn.lockTo = function(ele) {
    var offsets = ele.offset();
    var xPos = offsets.left;
    var yPos = offsets.top;
    var width = ele.outerWidth();
    var height = ele.outerHeight();

    this.css({
        'left' : xPos + 'px',
        'top'  : yPos + 'px',
        'width': width + 'px',
        'height': height + 'px',
        'position' : 'absolute'
    });
}