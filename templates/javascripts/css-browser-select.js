// CSS Browser Selector   v0.2.3
// Documentation:         http://rafael.adm.br/css_browser_selector
// License:               http://creativecommons.org/licenses/by/2.5/
// Author:                Rafael Lima (http://rafael.adm.br)
// Contributors:          http://rafael.adm.br/css_browser_selector#contributors

// Examples:
// 
//     * html.gecko div#header { margin: 1em; }
//     * .opera #header { margin: 1.2em; }
//     * .ie .mylink { font-weight: bold; }
//     * .mac.ie .mylink { font-weight: bold; }
//     * .[os].[browser] .mylink { font-weight: bold; } -> without space between .[os] and .[browser]
// 
// Available OS Codes [os]:
// 
//     * win - Microsoft Windows
//     * linux - Linux (x11 and linux)
//     * mac - Mac OS
// 
// Available Browser Codes [browser]:
// 
//     * ie - Internet Explorer (All versions)
//     * ie6 - Internet Explorer 6.x
//     * ie5 - Internet Explorer 5.x
//     * gecko - Mozilla, Firefox, Camino
//     * opera - Opera (All versions)
//     * opera8 - Opera 8.x
//     * opera9 - Opera 9.x
//     * konqueror - Konqueror
//     * webkit or safari - Safari, NetNewsWire, OmniWeb, Shiira

var css_browser_selector = function() {
	var 
		ua = navigator.userAgent.toLowerCase(),
		is = function(t){ return ua.indexOf(t) != -1; },
		h = document.getElementsByTagName('html')[0],
		b = (!(/opera|webtv/i.test(ua)) && /msie (\d)/.test(ua)) ? ((is('mac') ? 'ieMac ' : '') + 'ie ie' + RegExp.$1)
			: is('gecko/') ? 'gecko' : is('opera') ? 'opera' : is('konqueror') ? 'konqueror' : is('applewebkit/') ? 'webkit safari' : is('mozilla/') ? 'gecko' : '',
		os = (is('x11') || is('linux')) ? ' linux' : is('mac') ? ' mac' : is('win') ? ' win' : '';
	var c = b+os+' js';
	h.className += h.className?' '+c:c;
}();