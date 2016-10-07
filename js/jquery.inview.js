;(function(window, $, undefined) {

	var wh;
	var $w = $(window);
	var st = $w.scrollTop();

	$(document).ready(function() {
		wh = $w.height();
		st = $w.scrollTop();

		$w.on('resize inview-recalc', $.throttle(300, function(e) {
			wh = $w.height();
			$w.trigger('inview--internal-resize'); // never trigger manually
		}));

		$w.on('scroll fp-scroll load ajaxload imageload resize inview-recalc', $.throttle(300, function(e) {
			st = $w.scrollTop();
			$w.trigger('inview--internal-scroll'); // never trigger manually
		}));
	});


	$.fn.is_inview = function() {
		var result = false;
		this.each(function() {
			var top, h, offset;
			var $self = $(this);

			st = $w.scrollTop();
			wh = $w.height();
			h = $self.height();
			top = $self.offset().top;
			offset = Math.min(Math.round(h / 10), 80);

			if ((st + wh >= top + offset && st <= top + h - offset && $self.is(':visible')) || h > wh) {
				result = true;
			}
		});

		return result;
	};

	$.fn.inview = function(options, callback, callbackOut) {
		if (typeof(options) !== 'object' && callbackOut === undefined) {
			callbackOut = callback;
			callback = options;
			options = {};
		}

		return this.each(function() {
			var top, h, offset;
			var onceE = false;
			var onceL = false;
			var $self = $(this);
			var log   = options.log === true ? true : false;

			if (typeof(callback) == 'function') {
				$self.on('inview', callback);
			}

			if (typeof(callbackOut) == 'function') {
				$self.on('inview-out', callbackOut);
			}

			var _onResize = function() {
				if ($self) {
					h = $self.height();
					top = $self.offset().top;
					offset = Math.min(Math.round(h / 10), 80);
					_onScroll();
				}
			}.bind(this);

			var _onScroll = function() {
				if ($self) {
					if (log) {
						console.log(st + wh, top + offset);
					}

					if (st + wh >= top + offset && st <= top + h - offset) {//} && $self.is(':visible')) {
						if (!onceE) {
							$self.trigger('inview');
							onceE = true;
							onceL = false;

							if (callbackOut === undefined) {
								$w.off('inview--internal-resize', _onResize); // experimental
								$w.off('inview--internal-scroll', _onScroll); // experimental
							}
						}
					} else {
						if (!onceL && (callbackOut !== undefined && callbackOut !== false)) {
							$self.trigger('inview-out');
							onceE = false;
							onceL = true;
						}
					}
				}
			}.bind(this);

			var _onDestroy = function() {
				$w.off('inview--internal-resize', _onResize);
				$w.off('inview--internal-scroll', _onScroll);
				$self.off('inview-destroy', _onDestroy);
				$self.off('inview');
				$self.off('inview-out');
				$self = null;
			};

			$w.on('inview--internal-resize', _onResize); // never trigger manually
			$w.on('inview--internal-scroll', _onScroll); // never trigger manually
			_onResize();
			_onScroll();
			$self.on('inview-destroy', _onDestroy);
			$self.data('inview-applied', true);
		});
	};

})(window, window.jQuery);
