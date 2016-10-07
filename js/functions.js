(function($, undefined) {
	function throttle(fn, threshhold, scope) {
		threshhold || (threshhold = 250);
		var last;
		var deferTimer;

		return function () {
			var context = scope || this;

			var now = +new Date;
			var args = arguments;

			if (last && now < last + threshhold) {
				// hold on to it
				clearTimeout(deferTimer);
				deferTimer = setTimeout(function () {
					last = now;
					fn.apply(context, args);
				}, threshhold);
			} else {
				last = now;
				fn.apply(context, args);
			}
		};
	}

	$.throttle = function(threshhold, fn, scope) {
		return throttle(fn, threshhold, scope);
	};

	function msieversion() {
        var ua = window.navigator.userAgent;
        var msie = ua.indexOf("MSIE ");
        if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./)) return true;
        else return false;
    }

	/* InView Fade starts here */

    function inviewFadeInit() {
	    $('[inview-fade]:not(.inview-fade-applied)').each(function() {
	        var once = false;
	        var $element = $(this);
	        var $target = $element;

	        if ($element.attr('inview-target-parent')) {
	        	$target = $element.parents($element.attr('inview-target-parent'));
	        }

	        $target.inview(function() {
	        	if (!once) {
	        		$element.addClass('inview-fade-visible');
	        		$element.trigger('inview-fade-visible')
                    once = true;
                }
	        });

	        $(window).on('load resize', $.throttle(500, function(e) {
	            if ($(window).width() <= 1024) {
	                if (!once) {
	                    $element.addClass('inview-fade-visible');
	                    $element.trigger('inview-fade-visible')
	                    once = true;
	                }
	            }
	        }));
	    }).addClass('inview-fade-applied');
	}

    /* InView Fade end */


	$(document).ready(function() {

		inviewFadeInit();

		$('.burger').click(function() {
			$('.header').toggleClass('menu-visible');
		});

		$('.arrow:not(.arrow-rotated)').click(function(e) {
			e.preventDefault();
			$('html,body').animate({
	            scrollTop: 0
	        }, 1000, 'easeInOutQuint');
		});

		$('.print').click(function() {
			window.print();
		});

	});
})(window.jQuery);
