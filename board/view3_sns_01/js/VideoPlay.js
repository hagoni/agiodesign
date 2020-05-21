/**************************************************************************************************
 * HeightFix | container의 넓이를 기준으로 레이어의 높이를 조정합니다.
 *
 * @class HeightFix
 * @constructor
 * @version 1.0
 *
 * @param {String} containerId 내부 요소 id 값
 * @param {Number} x 가로 비율
 * @param {Number} y 세로 비율
 *
 **************************************************************************************************/
 (function($) {

 	'use strict';

	window.HeightFix = function(containerId, x, y) {

		var _this = this;

		var resizeTimer = null;

		this.initialize = function() {
			this.setHandler();
			this.setHeight();
		};

		this.setHeight = function() {
			$(containerId).css({height: _this.compute()});
		};

		this.compute = function() {
			return $(containerId).parent().width() * y / x;
		};

		this.setHandler = function() {
			win.resize(function() {
				clearTimeout(resizeTimer);
				resizeTimer = setTimeout(function() {
					_this.setHeight();
				}, 100);
			});
		};

		this.initialize();
	};

}(jQuery));


(function($) {

    'use strict';

    window.VideoPlay = function() {

        var _this = this,
            body = $('body'),
            boardWrapperId = '#boardWrap',
            containerId = '#videoViewContainer',
            anchor = $('.bindVideoPlay'),
            prevBtnId = '#videoPrevBtn',
            nextBtnId = '#videoNextBtn',
            lists = $('.grid_list > li'),
            prevIndex = -1,
            index = lists.filter('.on').index(),
			offsetTop = $(containerId).offset().top - 100,
            changing = false;

        var video;

        var LENGTH = lists.length;

        this.initialize = function() {
            this.setHandler();
            //video = new HeightFix('#iframeVideo', 1160, 618);
        };

        this.setHandler = function() {
            anchor.click(function(e) {
                if(changing === false) {
                    changing = true;
                    prevIndex = index;
                    index = $(this).closest('li').index();
                    if(index !== prevIndex) _this.videoReload();
                    else _this.notice('현재 재생 중인 영상입니다.');
                }
                e.preventDefault();
            });
            body.on('click', prevBtnId, function(e) {
                if(changing === false) {
                    changing = true;
                    prevIndex = index;
                    index--;
                    if(index > -1) _this.videoReload();
                    else _this.pageReload(this);
                }
                e.preventDefault();
            });
            body.on('click', nextBtnId, function(e) {
                if(changing === false) {
                    changing = true;
                    prevIndex = index;
                    index++;
                    if(index < LENGTH) _this.videoReload();
                    else _this.pageReload(this);
                }
                e.preventDefault();
            });
        };

        this.videoReload = function() {
            $.post(location.href, {idx: lists.eq(index).attr('data-idx')}, function(response) {
                $('html, body').animate({scrollTop: offsetTop}, 200, function() {
                    changing = false;
                });
                $(containerId).html($(response).find(containerId).html());
                lists.filter('.on').removeClass('on');
                lists.eq(index).addClass('on');
                //video.setHeight();
            }, 'html').error(function(e) {
                _this.notice(e.statusText);
            });
        };

        this.pageReload = function(s) {
            $.post(location.href, {page: $(s).data('page')}, function(response) {
                $(boardWrapperId).html($(response).find(boardWrapperId).html());
                lists.filter('.on').removeClass('on');
                lists.eq(index).addClass('on');
                //video.setHeight();
                changing = false;
            }, 'html').error(function(e) {
                _this.notice(e.statusText);
            });
        };

        this.notice = function(msg) {
            changing = false;
            alert(msg);
        };

        this.initialize();
    };

    doc.ready(function() {
        new VideoPlay();
    });

}(jQuery));
