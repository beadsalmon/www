$(function(){
	// smoothScrollPage();
	// scrollMagicFn();
	if($('.form-text').length) placeholderJs();
	if($('.form-select').length) selectJs();//focus관련.....
	if($('.form-file').length) formFileFocusJs();//focus관련.....
	// dimdFn();
	gnbFn();

	$(window).on('resize',function(){
		// $('.header_wrap .gnb_wrap').height($(this).innerHeight());
	});

	$('header .top_btn a').on('click',function(){
		TweenMax.to(window,.5,{
			scrollTo:0
			,	onComplete:function(){
			}
		});
	})
});




/*
function imgEff(obj){
	if($(obj).data('efChk') != true){
		$(obj).data('efChk',true);
		TweenMax.to($(obj).find('.c_bg'),.9,{
		'scaleX':1
		,	'ease':'easeInOutExpo'
		,	onComplete:function(){

			if($(this.target).closest('.eff_img').hasClass('left')){
				$(this.target).css({
					'transform-origin':'right center'
				});
			}else if($(this.target).closest('.eff_img').hasClass('right')){
				$(this.target).css({
					'transform-origin':'left center'
				});
			}

			$(obj).find('.img_mask').css({
				'opacity':1
			})
			TweenMax.to($(this.target),1,{
				'scaleX':0
				,	'ease':'easeInOutExpo'
			});

		}
	});
	}
}
*/

function gnbFn(){
	// $('.open_btn')header .header_wrap .gnb_wrap .close_btn
	var gnbObj = {
		$openWrap : null,
		$gnbWrap:null,
		openChk : false,
		gnbSwiper : null,
		// mScroll : null,
		setLayout : function(){
			gnbObj.init();

			// gnbObj.$gnbWrap.find('.overflow_gnb').height(parseInt($(this).height()) - 111);

			winResize($(window).height());
			$(window).on('resize',function(){
				winResize($(this).height());
			})

			function winResize(num){
				// gnbObj.$gnbWrap.find('.overflow_gnb').height(parseInt($(this).height()) - 166);
			}
			gnbObj.gnbSlider();
		},
		init : function(){
			gnbObj.$openWrap = $('header .header_wrap .open_wrap');
			gnbObj.$gnbWrap = $('header .header_wrap #gnb');
		},
		addEvent : function(){
			gnbObj.$openWrap.on('click','.open_btn',function(){
				gnbObj.openFn();
			});
			gnbObj.$gnbWrap.on('click','.close_btn a',function(){
				gnbObj.closeFn();
			});

			/*gnbObj.$gnbWrap.find('.d_1').on('click',function(){
				var $li = $(this).closest('li')
				,	idx = $li.index();
				if(!motionChk){
					mainTransFn(idx);
				}
				gnbObj.closeFn();
			});*/
		},
		openFn : function(){
			 $('body').on('scroll touchmove mousewheel', function(e){e.preventDefault()}); //스크롤방지
			dimdFn(50,gnbObj.closeFn);
			TweenMax.to(gnbObj.$gnbWrap,1,{
				'left':'0%'
				,	'ease':'easeOutExpo'
				,	onComplete:function(){
					gnbObj.scrollRefreshFn();
				}
			});

			gnbObj.$gnbWrap.addClass('active');
		},
		closeFn : function(){
			$('body').off('scroll touchmove mousewheel'); //스크롤방지 해제
			TweenMax.to(gnbObj.$gnbWrap,.5,{
				'left':'-100%'
				,	'ease':'easeOutExpo'
				,	onComplete:function(){

				}
			});
			gnbObj.$gnbWrap.removeClass('active');
			dimdFn();
		},
		gnbSlider : function(){
			gnbObj.gnbSwiper = new Swiper('#gnb .swiper-container', {
			     direction: 'vertical',
			     slidesPerView: 'auto',
			     mousewheelControl: true,
			     freeMode: true
			});
		},
		scrollRefreshFn : function(){
			gnbObj.gnbSwiper.onResize();
		}
	}
	gnbObj.setLayout();
	gnbObj.addEvent();





}

function smoothScrollPage(){
	var $window = $(window);
	var scrollTime = .5;
	var scrollDistance = 300;

	$window.on("mousewheel DOMMouseScroll", function(event){
		event.preventDefault();
		if(!$('header .header_wrap #gnb').hasClass('active')){
			var delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3;
			var scrollTop = $window.scrollTop();
			var finalScroll = scrollTop - parseInt(delta*scrollDistance);

			TweenMax.to($window, scrollTime, {
				scrollTo : { y: finalScroll, autoKill:true },
					ease: Power1.easeOut,
					overwrite: 5
			});
		}

	});


}

function placeholderJs(){
	$('.form-text').each(function(){
		var $this = $(this),
			$input = $this.find('input'),
			$placeholder = $this.find('label.placeholder');

		if($input.val() != ""){
			$placeholder.hide();
		}

		if(!$input.attr('readOnly')){
			$input.focus(function(){
				$placeholder.hide();
			}).blur(function(){
				if($input.val() != ""){
					$placeholder.hide();
				}else{
					$placeholder.show();
				}
			});
		}else{
			$input.change(function(){
				$placeholder.hide();
			});
		}

	});

    $('.form-textarea.type02').each(function(){
        var $this = $(this),
            $input = $this.find('textarea'),
            $placeholder = $this.find('label.placeholder');

        if($input.val() != ""){
            $placeholder.hide();
        }

        if(!$input.attr('readOnly')){
            $input.focus(function(){
                $placeholder.hide();
            }).blur(function(){
                if($input.val() != ""){
                    $placeholder.hide();
                }else{
                    $placeholder.show();
                }
            });
        }else{
            $input.change(function(){
                $placeholder.hide();
            });
        }

    })
}

function selectJs(){
	$('.form-select').each(function(){
		var $this = $(this),
			$select = $this.find('select'),
			defVal = $this.find('option:selected').text();

		if($this.find('.virtual_select').length != 0){
			$this.find('.virtual_select').remove();
		}
		$this.prepend('<span class="virtual_select">'+defVal+'</span>');

		$select.on('focus',function(){
			$this.addClass('active');
		}).on('blur',function(){
			$this.removeClass('active');
		})

		$select.change(function(){
			$this.find('span').text($this.find("option:selected").text());
		});
	});
}

function formFileFocusJs(){
	$('.form-file').each(function(){
		var $this = $(this);

		$this.find('input[type="file"]').on('focus',function(){
			$this.addClass('active');
		}).on('blur',function(){
			$this.removeClass('active');
		})
	})
}

function dimdFn(zNum,func){
		if(!$('.dimd').length){
			$('<div class="dimd"></div>').appendTo($('#wrap'));

			$('.dimd').css({
				'position':'fixed'
				,	'top':0
				,	'left':0
				,	'opacity':0
				,	'z-index':zNum!=null ? zNum : 50
				,	'width':$(window).width()
				,	'height':$(window).height()
				,	'background-color':'rgba(0,0,0,.5)'
				,	'display':'block'
			});

			$(window).on('resize',function(){
				$('.dimd').css({
					'width':$(window).width()
					,	'height':$(window).height()
				});
			});

			TweenMax.to($('.dimd'),.3,{
				'opacity':1
			})
			$('.dimd').on('click',function(){
				if(func != null){
					func();
				}
			})
		}else{
			TweenMax.to($('.dimd'),.3,{
				'opacity':0
				, onComplete:function(){
					$('.dimd').remove();
				}
			})

			$(window).off('resize',function(){
				$('.dimd').css({
					'width':$(window).width()
					,	'height':$(window).height()
				});
			});

			$('.dimd').off('click');
		}
}
