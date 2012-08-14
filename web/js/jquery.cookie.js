/*! Improved jQuery.cookie plugin by @mathias: http://mths.be/cookie */
/*
* Improved jQuery.cookie plugin – http://mths.be/cookie
* 
* Based on
*  - the original MIT/GPL-licensed jQuery cookie plugin by Klaus Hartl (stilbuero.de)
*  - readCookie() by Lea Verou, James Padolsey and Juriy Zaytsev: http://mths.be/abe
*
* This plugin intentionally uses the same syntax as the original jQuery cookie plugin, for backwards compatibility.
*
* Examples:
* =========
*
* Create a cookie with the given name and value and other optional parameters.
*
* @example $.cookie('the_cookie', 'the_value');
* @desc Set the value of a cookie.
* @example $.cookie('the_cookie', 'the_value', { expires: 7, path: '/', domain: 'jquery.com', secure: true });
* @desc Create a cookie with all available options.
* @example $.cookie('the_cookie', 'the_value');
* @desc Create a session cookie.
* @example $.cookie('the_cookie', null);
* @desc Delete a cookie by passing null as value. Keep in mind that you have to use the same path and domain used when the cookie was set.
*
* @param String name The name of the cookie.
* @param String value The value of the cookie.
* @param Object options An object literal containing key/value pairs to provide optional cookie attributes.
* @option Number|Date expires Either an integer specifying the expiration date from now on in days or a Date object.
*                             If a negative value is specified (e.g. a date in the past), the cookie will be deleted.
*                             If set to null or omitted, the cookie will be a session cookie and will not be retained when the the browser exits.
* @option String path The value of the path atribute of the cookie (default: path of page that created the cookie).
* @option String domain The value of the domain attribute of the cookie (default: domain of page that created the cookie).
* @option Boolean secure If true, the secure attribute of the cookie will be set and the cookie transmission will require a secure protocol (like HTTPS).
* @type undefined
*
* Get the value of a cookie with the given name.
*
* @example $.cookie('the_cookie');
* @desc Get the value of a cookie.
*
* @param String name The name of the cookie.
* @return The value of the cookie.
* @type String
*/

;(function(document, $) {
	$.cookie = function(name, value, options) {
		var expires = '',
		    date,
		    match;
		if (typeof value != 'undefined') { // name and value given, set cookie
			options || (options = {});
			if (!value) {
				value = '';
				options.expires = -1;
			}
			if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
				date = new Date;
				if (typeof options.expires == 'number') {
					date.setTime(+new Date() + (options.expires * 864e5)); // 86,400,000 ms = 1 day
				} else {
					date = options.expires;
				}
				expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
			}
			document.cookie = [
				name,
				'=',
				encodeURIComponent(value),
				expires,
				options.path ? '; path=' + options.path : '',
				options.domain ? '; domain=' + options.domain : '', 
				options.secure ? '; secure' : ''
			].join('');
		} else { // only name given, get cookie
			match = document.cookie.match(new RegExp('(?:^|;)\\s?' + name.replace(/([.*+?^=!:${}()|[\]\/\\])/g, '\\$1') + '=(.*?)(?:;|$)', 'i'));
			return match && unescape(match[1]);
		};
	};
}(document, jQuery));