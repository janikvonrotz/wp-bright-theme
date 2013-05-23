/* Load this script using conditional IE comments if you need to support IE 7 and IE 6. */

window.onload = function() {
	function addIcon(el, entity) {
		var html = el.innerHTML;
		el.innerHTML = '<span style="font-family: \'icomoon\'">' + entity + '</span>' + html;
	}
	var icons = {
			'icon-social-500px' : '&#x21;',
			'icon-social-addthis' : '&#x22;',
			'icon-social-bebo' : '&#x23;',
			'icon-social-behance' : '&#x24;',
			'icon-social-blogger' : '&#x25;',
			'icon-social-deviantart' : '&#x26;',
			'icon-social-digg' : '&#x27;',
			'icon-social-dribbble' : '&#x28;',
			'icon-social-email' : '&#x29;',
			'icon-social-envato' : '&#x2a;',
			'icon-social-evernote' : '&#x2b;',
			'icon-social-facebook' : '&#x2c;',
			'icon-social-flickr' : '&#x2d;',
			'icon-social-forrst' : '&#x2e;',
			'icon-social-github' : '&#x2f;',
			'icon-social-google-plus' : '&#x30;',
			'icon-social-grooveshark' : '&#x31;',
			'icon-social-kippt' : '&#x32;',
			'icon-social-last-fm' : '&#x33;',
			'icon-social-linkedin' : '&#x34;',
			'icon-social-myspace' : '&#x35;',
			'icon-social-paypal' : '&#x36;',
			'icon-social-pencode' : '&#x37;',
			'icon-social-photobucket' : '&#x38;',
			'icon-social-pinterest' : '&#x39;',
			'icon-social-quora' : '&#x3a;',
			'icon-social-sharethis' : '&#x3b;',
			'icon-social-skype' : '&#x3c;',
			'icon-social-soundcloud' : '&#x3d;',
			'icon-social-stumbleupon' : '&#x3e;',
			'icon-social-tumblr' : '&#x3f;',
			'icon-social-twitter' : '&#x40;',
			'icon-social-viddler' : '&#x41;',
			'icon-social-virb' : '&#x42;',
			'icon-social-wordpress' : '&#x43;',
			'icon-social-yahoo' : '&#x44;',
			'icon-social-yelp' : '&#x45;',
			'icon-social-youtube' : '&#x46;',
			'icon-social-zerply' : '&#x47;',
			'icon-social-vimeo' : '&#x48;'
		},
		els = document.getElementsByTagName('*'),
		i, attr, html, c, el;
	for (i = 0; ; i += 1) {
		el = els[i];
		if(!el) {
			break;
		}
		attr = el.getAttribute('data-icon');
		if (attr) {
			addIcon(el, attr);
		}
		c = el.className;
		c = c.match(/icon-[^\s'"]+/);
		if (c && icons[c[0]]) {
			addIcon(el, icons[c[0]]);
		}
	}
};