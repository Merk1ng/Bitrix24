
jQuery(document).ready(function(){
jQuery('button').click(function() {

	str = jQuery(this).val();
	var off=jQuery(window).width()/100*5-150;
	jQuery.scrollTo("#"+str, 300, {offset:off});});


	 
	
	
	});

	
(function(define) {
	'use strict';

	define(['jquery'], function($) {
		var $scrollTo = $.scrollTo = function(target, duration, settings) {
			return $(window).scrollTo(target, duration, settings);
		};

		$scrollTo.defaults = {
			axis:'xy',
			duration: 0,
			limit:true
		};

		$.fn.scrollTo = function(target, duration, settings) {
			if (typeof duration === 'object') {
				settings = duration;
				duration = 0;
			}
			if (typeof settings === 'function') {
				settings = { onAfter:settings };
			}
			if (target === 'max') {
				target = 9e9;
			}

			settings = $.extend({}, $scrollTo.defaults, settings);
			// Speed is still recognized for backwards compatibility
			duration = duration || settings.duration;
			// Make sure the settings are given right
			settings.queue = settings.queue && settings.axis.length > 1;

			if (settings.queue) {
				// Let's keep the overall duration
				duration /= 2;
			}
			settings.offset = both(settings.offset);
			settings.over = both(settings.over);

			return this._scrollable().each(function() {
				// Null target yields nothing, just like jQuery does
				if (target === null) return;

				var elem = this,
					$elem = $(elem),
					targ = target, toff, attr = {},
					win = $elem.is('html,body');

				switch (typeof targ) {
					// A number will pass the regex
					case 'number':
					case 'string':
						if (/^([+-]=?)?\d+(\.\d+)?(px|%)?$/.test(targ)) {
							targ = both(targ);
							// We are done
							break;
						}
						// Relative/Absolute selector, no break!
						targ = win ? $(targ) : $(targ, this);
						if (!targ.length) return;
						/* falls through */
					case 'object':
						// DOMElement / jQuery
						if (targ.is || targ.style) {
							// Get the real position of the target
							toff = (targ = $(targ)).offset();
						}
				}

				var offset = $.isFunction(settings.offset) && settings.offset(elem, targ) || settings.offset;

				$.each(settings.axis.split(''), function(i, axis) {
					var Pos	= axis === 'x' ? 'Left' : 'Top',
						pos = Pos.toLowerCase(),
						key = 'scroll' + Pos,
						old = elem[key],
						max = $scrollTo.max(elem, axis);

					if (toff) {// jQuery / DOMElement
						attr[key] = toff[pos] + (win ? 0 : old - $elem.offset()[pos]);

						// If it's a dom element, reduce the margin
						if (settings.margin) {
							attr[key] -= parseInt(targ.css('margin'+Pos), 10) || 0;
							attr[key] -= parseInt(targ.css('border'+Pos+'Width'), 10) || 0;
						}

						attr[key] += offset[pos] || 0;

						if (settings.over[pos]) {
							// Scroll to a fraction of its width/height
							attr[key] += targ[axis === 'x'?'width':'height']() * settings.over[pos];
						}
					} else {
						var val = targ[pos];
						// Handle percentage values
						attr[key] = val.slice && val.slice(-1) === '%' ?
							parseFloat(val) / 100 * max
							: val;
					}

					// Number or 'number'
					if (settings.limit && /^\d+$/.test(attr[key])) {
						// Check the limits
						attr[key] = attr[key] <= 0 ? 0 : Math.min(attr[key], max);
					}

					// Queueing axes
					if (!i && settings.queue) {
						// Don't waste time animating, if there's no need.
						if (old !== attr[key]) {
							// Intermediate animation
							animate(settings.onAfterFirst);
						}
						// Don't animate this axis again in the next iteration.
						delete attr[key];
					}
				});

				animate(settings.onAfter);

				function animate(callback) {
					$elem.animate(attr, duration, settings.easing, callback && function() {
						callback.call(this, targ, settings);
					});
				}
			}).end();
		};

		// Max scrolling position, works on quirks mode
		// It only fails (not too badly) on IE, quirks mode.
		$scrollTo.max = function(elem, axis) {
			var Dim = axis === 'x' ? 'Width' : 'Height',
				scroll = 'scroll'+Dim;

			if (!$(elem).is('html,body'))
				return elem[scroll] - $(elem)[Dim.toLowerCase()]();

			var size = 'client' + Dim,
				html = elem.ownerDocument.documentElement,
				body = elem.ownerDocument.body;

			return Math.max(html[scroll], body[scroll]) - Math.min(html[size], body[size]);
		};

		// Returns the real elements to scroll (supports window/iframes, documents and regular nodes)
		// Used internally, available if needed (for example to animate the object or call .stop())
		$.fn._scrollable = function() {
			return this.map(function() {
				var elem = this,
					isWin = !elem.nodeName || $.inArray(elem.nodeName.toLowerCase(), ['iframe','#document','html','body']) !== -1;

				if (!isWin) return elem;

				var doc = (elem.contentWindow || elem).document || elem.ownerDocument || elem;
				// Windows Phone always scrolls via <html> #56
				if (/iemobile/i.test(navigator.userAgent)) {
					return doc.documentElement;
				}
				// Chrome is inconsistent with which one to use
				// They change across versions #101
				if (/chrome|applewebkit/i.test(navigator.userAgent)) {
					return scrolls(doc.body) || doc.documentElement;
				}
				// Every other browser follows the same rule
				return doc.compatMode === 'BackCompat' ? doc.body : doc.documentElement;
			});
		};

		function scrolls(elem) {
			// If already scrolled means it works, no need to move the scroll
			if (elem.scrollTop) return elem;
			// We already tested and this one is the one
			if ($.data(elem, '_scrolls')) return elem;
			// Changed, then it works
			elem.scrollTop++;
			if (elem.scrollTop === 1) {
				// Mark it as correct so we don't re-scroll on every call to the plugin
				$.data(elem, '_scrolls', true);
				elem.scrollTop = 0;
				return elem;
			}
			return null;
		}

		function both(val) {
			return $.isFunction(val) || $.isPlainObject(val) ? val : { top:val, left:val };
		}

		// AMD requirement
		return $scrollTo;
	});
}(typeof define === 'function' && define.amd ? define : function(deps, factory) {
	'use strict';
	if (typeof module !== 'undefined' && module.exports) {
		// Node
		module.exports = factory(require('jquery'));
	} else {
		factory(jQuery);
	}
}));
