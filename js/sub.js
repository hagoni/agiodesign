(function($) {
	$(document).ready(function() {
        (function() {
            function scrollHandler() {
                var scrollTop = win.scrollTop(),
                    fixOffset = doc.innerHeight() - window.innerHeight - $diffElems.height(),
                    botoffset = doc.innerHeight() - window.innerHeight;

                if(scrollTop > fixOffset) $headElems.css({bottom: scrollTop - fixOffset + $headElems.bottom});
                else $headElems.css({bottom: $headElems.bottom});

                if(show === false && scrollTop >= showOffset) {
                    $headElems.addClass('fixed');
                    show = true;
                } else if(show === true && scrollTop < showOffset) {
                    $headElems.removeClass('fixed');
                    show = false;
                }


                TweenMax.to($('#bot_top_scroll'), 0.5, {strokeDashoffset: btnR * (botoffset - scrollTop) / botoffset})
                TweenMax.to($('#bot_top_bg'), 0.5, {strokeDashoffset: -btnR * scrollTop / botoffset})
            }

            var $headElems = $('.bot_top_btn'),
                $diffElems = $('.footer_wrap'),
                btnR = $headElems.width() * 3.14;

            $headElems.heigth = parseInt($headElems.css('height'), 10);
            $headElems.bottom = parseInt($headElems.css('bottom'), 10);

            var showOffset = doc.innerHeight() - win.innerHeight() >= 200 ? 200 : 0,
                show = false;

            win.scroll(scrollHandler).load(scrollHandler);
            scrollHandler();

            $headElems.click(function(e) {
    			$('html, body').stop().animate({scrollTop: 0}, 200);
    			e.preventDefault();
    		});
            
            TweenMax.set($('#bot_top_bg, #bot_top_scroll'), {strokeDasharray: btnR})

            win.resize(function(){
                var scrollTop = win.scrollTop(),
                    botoffset = doc.innerHeight() - window.innerHeight;
                btnR = $headElems.width() * 3.14;
                TweenMax.set($('#bot_top_bg, #bot_top_scroll'), {strokeDasharray: btnR})
                TweenMax.to($('#bot_top_scroll'), 0.5, {strokeDashoffset: btnR * (botoffset - scrollTop) / botoffset})
                TweenMax.to($('#bot_top_bg'), 0.5, {strokeDashoffset: -btnR * scrollTop / botoffset})
            });
        }());
	});
}(jQuery));
