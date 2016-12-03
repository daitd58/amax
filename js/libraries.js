/**
 * @author Alexander Farkas
 * v. 1.22 / v1.0 modified by OlevMedia
 background-position-animate
 */
(function(c){function f(a){a=a.replace(/left|top/g,"0px");a=a.replace(/right|bottom/g,"100%");a=a.replace(/([0-9\.]+)(\s|\)|$)/g,"$1px$2");a=a.match(/(-?[0-9\.]+)(px|\%|em|pt)\s(-?[0-9\.]+)(px|\%|em|pt)/);return[parseFloat(a[1],10),a[2],parseFloat(a[3],10),a[4]]}if(!document.defaultView||!document.defaultView.getComputedStyle){var d=c.css;c.css=function(a,b,c){"background-position"===b&&(b="backgroundPosition");if("backgroundPosition"!==b||!a.currentStyle||a.currentStyle[b])return d.apply(this, arguments);var e=a.style;return!c&&e&&e[b]?e[b]:d(a,"backgroundPositionX",c)+" "+d(a,"backgroundPositionY",c)}}var g=c.fn.animate;c.fn.animate=function(a){if("background-position"in a)a.backgroundPosition=a["background-position"],delete a["background-position"];if("backgroundPosition"in a)a.backgroundPosition="("+a.backgroundPosition;return g.apply(this,arguments)};c.fx.step.backgroundPosition=function(a){if(!a.bgPosReady){var b=c.css(a.elem,"backgroundPosition");b||(b="0px 0px");b=f(b);a.start= [b[0],b[2]];b=f(a.end);a.end=[b[0],b[2]];a.unit=[b[1],b[3]];a.bgPosReady=!0}b=[];b[0]=(a.end[0]-a.start[0])*a.pos+a.start[0]+a.unit[0];b[1]=(a.end[1]-a.start[1])*a.pos+a.start[1]+a.unit[1];a.elem.style.backgroundPosition=b[0]+" "+b[1]}})(jQuery);

/*
 * Easing
 */
jQuery.easing['jswing'] = jQuery.easing['swing']; jQuery.extend(jQuery.easing, { def: 'easeOutQuad', swing: function(x, t, b, c, d) { return jQuery.easing[jQuery.easing.def](x, t, b, c, d) }, easeInQuad: function(x, t, b, c, d) { return c * (t /= d) * t + b }, easeOutQuad: function(x, t, b, c, d) { return -c * (t /= d) * (t - 2) + b }, easeInOutQuad: function(x, t, b, c, d) { if ((t /= d / 2) < 1) return c / 2 * t * t + b; return -c / 2 * ((--t) * (t - 2) - 1) + b }, easeInCubic: function(x, t, b, c, d) { return c * (t /= d) * t * t + b }, easeOutCubic: function(x, t, b, c, d) { return c * ((t = t / d - 1) * t * t + 1) + b }, easeInOutCubic: function(x, t, b, c, d) { if ((t /= d / 2) < 1) return c / 2 * t * t * t + b; return c / 2 * ((t -= 2) * t * t + 2) + b }, easeInQuart: function(x, t, b, c, d) { return c * (t /= d) * t * t * t + b }, easeOutQuart: function(x, t, b, c, d) { return -c * ((t = t / d - 1) * t * t * t - 1) + b }, easeInOutQuart: function(x, t, b, c, d) { if ((t /= d / 2) < 1) return c / 2 * t * t * t * t + b; return -c / 2 * ((t -= 2) * t * t * t - 2) + b }, easeInQuint: function(x, t, b, c, d) { return c * (t /= d) * t * t * t * t + b }, easeOutQuint: function(x, t, b, c, d) { return c * ((t = t / d - 1) * t * t * t * t + 1) + b }, easeInOutQuint: function(x, t, b, c, d) { if ((t /= d / 2) < 1) return c / 2 * t * t * t * t * t + b; return c / 2 * ((t -= 2) * t * t * t * t + 2) + b }, easeInSine: function(x, t, b, c, d) { return -c * Math.cos(t / d * (Math.PI / 2)) + c + b }, easeOutSine: function(x, t, b, c, d) { return c * Math.sin(t / d * (Math.PI / 2)) + b }, easeInOutSine: function(x, t, b, c, d) { return -c / 2 * (Math.cos(Math.PI * t / d) - 1) + b }, easeInExpo: function(x, t, b, c, d) { return (t == 0) ? b : c * Math.pow(2, 10 * (t / d - 1)) + b }, easeOutExpo: function(x, t, b, c, d) { return (t == d) ? b + c : c * (-Math.pow(2, -10 * t / d) + 1) + b }, easeInOutExpo: function(x, t, b, c, d) { if (t == 0) return b; if (t == d) return b + c; if ((t /= d / 2) < 1) return c / 2 * Math.pow(2, 10 * (t - 1)) + b; return c / 2 * (-Math.pow(2, -10 * --t) + 2) + b }, easeInCirc: function(x, t, b, c, d) { return -c * (Math.sqrt(1 - (t /= d) * t) - 1) + b }, easeOutCirc: function(x, t, b, c, d) { return c * Math.sqrt(1 - (t = t / d - 1) * t) + b }, easeInOutCirc: function(x, t, b, c, d) { if ((t /= d / 2) < 1) return -c / 2 * (Math.sqrt(1 - t * t) - 1) + b; return c / 2 * (Math.sqrt(1 - (t -= 2) * t) + 1) + b }, easeInElastic: function(x, t, b, c, d) { var s = 1.70158; var p = 0; var a = c; if (t == 0) return b; if ((t /= d) == 1) return b + c; if (!p) p = d * .3; if (a < Math.abs(c)) { a = c; var s = p / 4 } else var s = p / (2 * Math.PI) * Math.asin(c / a); return -(a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b }, easeOutElastic: function(x, t, b, c, d) { var s = 1.70158; var p = 0; var a = c; if (t == 0) return b; if ((t /= d) == 1) return b + c; if (!p) p = d * .3; if (a < Math.abs(c)) { a = c; var s = p / 4 } else var s = p / (2 * Math.PI) * Math.asin(c / a); return a * Math.pow(2, -10 * t) * Math.sin((t * d - s) * (2 * Math.PI) / p) + c + b }, easeInOutElastic: function(x, t, b, c, d) { var s = 1.70158; var p = 0; var a = c; if (t == 0) return b; if ((t /= d / 2) == 2) return b + c; if (!p) p = d * (.3 * 1.5); if (a < Math.abs(c)) { a = c; var s = p / 4 } else var s = p / (2 * Math.PI) * Math.asin(c / a); if (t < 1) return -.5 * (a * Math.pow(2, 10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p)) + b; return a * Math.pow(2, -10 * (t -= 1)) * Math.sin((t * d - s) * (2 * Math.PI) / p) * .5 + c + b }, easeInBack: function(x, t, b, c, d, s) { if (s == undefined) s = 1.70158; return c * (t /= d) * t * ((s + 1) * t - s) + b }, easeOutBack: function(x, t, b, c, d, s) { if (s == undefined) s = 1.70158; return c * ((t = t / d - 1) * t * ((s + 1) * t + s) + 1) + b }, easeInOutBack: function(x, t, b, c, d, s) { if (s == undefined) s = 1.70158; if ((t /= d / 2) < 1) return c / 2 * (t * t * (((s *= (1.525)) + 1) * t - s)) + b; return c / 2 * ((t -= 2) * t * (((s *= (1.525)) + 1) * t + s) + 2) + b }, easeInBounce: function(x, t, b, c, d) { return c - jQuery.easing.easeOutBounce(x, d - t, 0, c, d) + b }, easeOutBounce: function(x, t, b, c, d) { if ((t /= d) < (1 / 2.75)) { return c * (7.5625 * t * t) + b } else if (t < (2 / 2.75)) { return c * (7.5625 * (t -= (1.5 / 2.75)) * t + .75) + b } else if (t < (2.5 / 2.75)) { return c * (7.5625 * (t -= (2.25 / 2.75)) * t + .9375) + b } else { return c * (7.5625 * (t -= (2.625 / 2.75)) * t + .984375) + b } }, easeInOutBounce: function(x, t, b, c, d) { if (t < d / 2) return jQuery.easing.easeInBounce(x, t * 2, 0, c, d) * .5 + b; return jQuery.easing.easeOutBounce(x, t * 2 - d, 0, c, d) * .5 + c * .5 + b } });

/**
 * omParallax
 * v2.0.0
 */
(function(e){function i(){if(r)return;t=e(window);n=t.height();t.resize(function(){n=t.height()});r=true}function s(){if(!window.getComputedStyle){return false}var e=document.createElement("div"),t,n={webkitTransform:"-webkit-transform",transform:"transform"};document.body.insertBefore(e,null);for(var r in n){if(e.style[r]!==undefined){e.style[r]="translate3d(1px,1px,1px)";t=window.getComputedStyle(e).getPropertyValue(n[r])}}document.body.removeChild(e);return t!==undefined&&t.length>0&&t!=="none"}var t,n;var r=false;e.fn.omParallax=function(r){function o(){var i=t.scrollTop();u.each(function(t){var s=e(this);var o=(new Date).getTime();var u=s.data("omLastDimensions");if(!u||o-u>2e3){s.data("omTop",s.offset().top);s.data("omHeight",f(s));s.data("omLastDimensions",o)}var c=s.data("omTop");var h=s.data("omHeight");if(c+h<i||c>i+n){return}var p=s.data("parallax-direction");if(p!="up"&&p!="down")p="up";var d=(i-(c-n))/(h+n);var v;if(p=="up")v=-Math.round(d*r.offset);else if(p=="down")v=-Math.round((1-d)*r.offset);l(a[t],v+"px")})}r=e.extend({offset:400,getOuterHeight:false,disableOnMobile:true},r);if(r.disableOnMobile&&/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){e(this).find(".om-parallax-inner").css("padding-bottom","0");return false}i();var u=e(this);var a=[];u.each(function(t){a[t]=e(this).find(".om-parallax-inner").css("padding-bottom",r.offset+"px")});var f;if(r.getOuterHeight){f=function(e){return e.outerHeight(true)}}else{f=function(e){return e.height()}}var l;if(s()){l=function(e,t){e.css({webkitTransform:"translate3d(0,"+t+",0)",transform:"translate3d(0,"+t+",0)"})}}else{l=function(e,t){e.css({top:t})}}var c=false;var h=window.requestAnimationFrame||window.webkitRequestAnimationFrame||window.mozRequestAnimationFrame||window.msRequestAnimationFrame||window.oRequestAnimationFrame||function(e){if(!c){c=true;window.setTimeout(function(){c=false;e()},16)}};t.bind("scroll resize",function(){h(o)});o()}})(jQuery);

/**
 * Horizontal Stock Ticker for jQuery.
 *
 * @package jStockTicker
 * @author Peter Halasz <skinner@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GPL v3.0
 * @copyright (c) 2009, Peter Halasz all rights reserved.
 */
( function($) {

    $.fn.jStockTicker = function(options) {

        if (typeof (options) == 'undefined') {
            options = {};
        }

        var settings = $.extend( {}, $.fn.jStockTicker.defaults, options);

        var $ticker = $(this);

        settings.tickerID = $ticker[0].id;

        $.fn.jStockTicker.settings[settings.tickerID] = {};

        var $wrap = null;

        if ($ticker.parent().get(0).className != 'wrap') {
            $wrap = $ticker.wrap("<div class='wrap'></div>");
        }

        var $tickerContainer = null;

        if ($ticker.parent().parent().get(0).className != 'container') {
            $tickerContainer = $ticker.parent().wrap(
                "<div class='container'></div>");
        }

        var node = $ticker[0].firstChild;
        var next;

        while(node) {
            next = node.nextSibling;
            if(node.nodeType == 3) {
                $ticker[0].removeChild(node);
            }
            node = next;
        }

        var shiftLeftAt = $($ticker.children().get(0)).outerWidth(true);

        $.fn.jStockTicker.settings[settings.tickerID].shiftLeftAt = shiftLeftAt;
        $.fn.jStockTicker.settings[settings.tickerID].left = 0;
        $.fn.jStockTicker.settings[settings.tickerID].runid = null;

        $ticker.width(2 * screen.availWidth);

        function startTicker() {
            stopTicker();

            var params = $.fn.jStockTicker.settings[settings.tickerID];
            params.left -= settings.speed;
            if(params.left <= params.shiftLeftAt * -1) {
                params.left = 0;
                $ticker.append($ticker.children().get(0));
                params.shiftLeftAt = $($ticker.children().get(0)).outerWidth(true);
            }

            $ticker.css('left', params.left + 'px');
            params.runId = setTimeout(arguments.callee, settings.interval);

            $.fn.jStockTicker.settings[settings.tickerID] = params;
        }

        function stopTicker() {
            var params = $.fn.jStockTicker.settings[settings.tickerID];
            if (params.runId)
                clearTimeout(params.runId);

            params.runId = null;

            $.fn.jStockTicker.settings[settings.tickerID] = params;
        }

        function updateTicker() {

            stopTicker();
            startTicker();
        }

        $ticker.hover(stopTicker,startTicker);

        startTicker();
    };

    $.fn.jStockTicker.settings = {};

    $.fn.jStockTicker.defaults = {
        tickerID :null,
        url :null,
        speed :1,
        interval :20
    };
})(jQuery);

(function($) {
    $("#ticker").jStockTicker({interval: 45,speed:1});
})(jQuery);