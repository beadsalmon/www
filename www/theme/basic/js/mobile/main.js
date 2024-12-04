var motionChk = false;

$(function(){
	partnerLogoFn();
});

$(window).load(function(){
	// if($('.main').length) {
		scrollMotionChk();
		sceneMotion(1);
		tabFn();
	// }
});

function partnerLogoFn(){
	var defNum = 3-($('.scene-5 .cont_wrap ul li').length%3);
	for(var i = 0; i<defNum; i++){
		$('.scene-5 .cont_wrap ul').append('<li></li>');
	}
}

function tabFn(){
	$('.tab_list').find('li').on('click','a',function(){
		var $this = $(this).closest('li')
		,	idx = $this.index();
		// console.log('motionChk',motionChk);
		if(!motionChk){
			motionChk = true;
			$this.addClass('active').siblings().removeClass('active');
			mainTransFn(idx);
		}
	})
}

function mainTransFn(num){
	var sceneStr = ['long_rent','lease', 'commercial'];
	var $scene = $("[class^='scene-']");
	$('.tab_list').find('li').eq(num).addClass('active').siblings().removeClass('active');
	/*$scene.find('.main_txt').css({
		'visibility':'hidden'
	});
	$scene.find('.sub_txt').css({
		'visibility':'hidden'
	});
	$scene.find('.mobile_wrap').css({
		'visibility':'hidden'
	});
	$scene.find('.info_grap').css({
		'visibility':'hidden'
	});

	$scene.find('.info_wrap').css({
		'visibility':'hidden'
	});*/

	$scene.removeClass('active');
	$('.number_case').removeClass('active');

	$('html, body').scrollTop(0);
	$('#wrap.main > #status_wrap').removeClass();
	$('#wrap.main > #status_wrap').addClass(sceneStr[num]);
	sceneMotion(1);
}

function scrollMotionChk(){
	$(window).on('scroll',function(e){
		var $this = $(this)
		,	scrTop = $this.scrollTop()
		,	scrollOriH = $this.scrollHeight
		,	scrollOffsetH = $this.offsetHeight
		,	scrollHeight = scrTop + $this.height();
		sceneChkFn(scrTop, scrollHeight);
	});

	sceneChkFn($(window).scrollTop(), $(window).scrollTop() + $(window).height());
	function sceneChkFn(scrTop, scrH){
		var winLoc = 1.2;
		$('.content').find('[class^="scene-"]').each(function(i){
			if($(this).css('display') != 'none'){
				if(i != 0){//첫화면이 아닐때!
					if(scrTop > $(this).offset().top-($(window).height()/winLoc) && scrTop <= ($(this).offset().top + $(this).height()) -($(window).height()/winLoc)){
						sceneMotion(i+1);
					}
				}
			}

		})
		if(scrH >= $('.number_case').offset().top + $('.number_case').outerHeight(true)){
			countFn();
		}
	}
}

function countFn() {
	if(!$('.number_case').hasClass('active')){
		$('.number_case').addClass('active');
		$('.number_case  ul li strong').each(function () {
			countTo = $(this).attr('data-count');
			$(this).prop('Counter', 0).animate({
				Counter: countTo
			}, {
				duration: 2000,
				easing: 'swing',
				step: function (now) {
					var number = Math.ceil(now).toLocaleString('en');
					$(this).text(number);
				}
			});
		});
	}
}

function sceneMotion(num){
	var $scene = null;

	// if(num < 5){
		$scene = $('.scene-'+num);
	// }
	/*if($('#wrap.main > #status_wrap').attr('class') == "commercial"){
		if(num == 5){
		     $scene = $('.scene-sp_1');
	     }else if(num == 6){
		     $scene = $('.scene-sp_2');
	     }
	}else if($('#wrap.main > #status_wrap').attr('class') == "lease"){
		if(num == 7){
			$scene = $('.scene-lease_1');
		}
	}else if($('#wrap.main > #status_wrap').attr('class') == "long_rent"){
		if(num == 8){
			$scene = $('.scene-long_rent_1');
		}else if(num == 9){
			$scene = $('.scene-long_rent_2');
		}
	}*/

	 if($scene != null){
		 if(!$scene.hasClass('active')){
			$scene.addClass('active');
             sceneMotionFn($scene, num);
			/*
			if(num ===  3){
				TweenMax.fromTo($scene.find('.main_txt .status_wrap-main_txt'),1.5,{
					'margin-top':70
					,	'opacity':0
				},{
					'margin-top':0
					,	'opacity':1
					,	'ease':'easeOutExpo'
				});

				TweenMax.fromTo($scene.find('.sub_txt .status_wrap-sub_txt'),1.5,{
					'margin-top':20
					,	'opacity':0
				},{
					'margin-top':0
					,	'delay':.4
					,	'opacity':1
					,	'ease':'easeOutExpo'
				});

				TweenMax.fromTo($scene.find('.mobile_wrap .status_wrap-mobile'),1.5,{
					'margin-left':-100
					,	'opacity':0
				},{
					'margin-left':0
					,	'delay':1.3
					,	'opacity':1
					,	'ease':'easeOutExpo'
				});
				if(!$('#wrap.main > #status_wrap').hasClass('installment')){
					$scene.find('.info_grap').css({
						'visibility':'visible'
					});
					TweenMax.fromTo($scene.find('.info_grap'),1.5,{
						'margin-top':30
						,	'opacity':0
					},{
						'margin-top':0
						,	'delay':.7
						,	'opacity':1
						,	'ease':'easeOutExpo'
					});
				}
			}else if(num === 4){
				TweenMax.fromTo($scene.find('.main_txt .status_wrap-main_txt'),1.5,{
					'margin-top':70
					,	'opacity':0
				},{
					'margin-top':0
					,	'delay':.4
					,	'opacity':1
					,	'ease':'easeOutExpo'
				});

				TweenMax.fromTo($scene.find('.sub_txt .status_wrap-sub_txt'),1.5,{
					'margin-top':20
					,	'opacity':0
				},{
					'margin-top':0
					,	'delay':.8
					,	'opacity':1
					,	'ease':'easeOutExpo'
				});
				TweenMax.fromTo($scene.find('.mobile_wrap .status_wrap-mobile'),1.5,{
					'margin-left':-100
					,	'opacity':0
				},{
					'margin-left':0
					,	'opacity':1
					,	'delay':1.3
					,	'ease':'easeOutExpo'
					,	onComplete:function(){
						motionChk = false;
					}
				});

				if($('#wrap.main > #status_wrap').hasClass('installment')){
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_1_3'),1,{
						right:30
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:2.1
					});
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_1_4'),1,{
						right:-10
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.6
					});
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_1_5'),1,{
						left:0
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.8
					});
				}else if($('#wrap.main > #status_wrap').hasClass('long_rent')){
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_2_3'),1,{
						right:0
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:2.1
					});
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_2_4'),1,{
						right:-40
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.6
					});
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_2_5'),1,{
						left:0
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.8
					});
				}else if($('#wrap.main > #status_wrap').hasClass('lease')){
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_3_3'),1,{
						right:0
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.6
					});
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_3_4'),1,{
						right:-40
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.8
					});
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_3_5'),1,{
						left:0
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:2.1
					});
				}else if($('#wrap.main > #status_wrap').hasClass('commercial')){
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_4_3'),1,{
						right:30
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:2.1
					});
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_4_4'),1,{
						right:-60
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.6
					});
					TweenMax.from($('.mobile_wrap .card_wrap').find('.nc_4_5'),1,{
						left:0
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.8
					});
				}
			}else if(num === 5){


                if($('#wrap.main > #status_wrap').hasClass('long_rent')){
                    TweenMax.fromTo($scene.find('.main_txt p'),1.5,{
                        'margin-top':70
                        ,	'opacity':0
                    },{
                        'margin-top':0
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });

                    TweenMax.fromTo($scene.find('.sub_txt p'),1.5,{
                        'margin-top':20
                        ,	'opacity':0
                    },{
                        'margin-top':0
                        ,	'delay':.4
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });


                    TweenMax.fromTo($scene.find('.info_wrap div'),1.5,{
                        'margin-top':20
                        ,	'opacity':0
                    },{
                        'margin-top':0
                        ,	'delay':.8
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });
                } else if($('#status_wrap').hasClass('lease')){
                    TweenMax.fromTo($scene.find('.main_txt p'),1.5,{
                        'margin-top':70
                        ,	'opacity':0
                    },{
                        'margin-top':0
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });

                    TweenMax.fromTo($scene.find('.sub_txt p'),1.5,{
                        'margin-top':20
                        ,	'opacity':0
                    },{
                        'margin-top':0
                        ,	'delay':.4
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });


                    TweenMax.fromTo($scene.find('.info_wrap div'),1.5,{
                        'margin-top':20
                        ,	'opacity':0
                    },{
                        'margin-top':0
                        ,	'delay':.8
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });
                } else if($('#status_wrap').hasClass('commercial')){
                    var $before = $scene.find('.commercial-before')
                        ,	$after = $scene.find('.commercial-after');
                    TweenMax.to($before.find('.car_img img'),1.5,{
                        'scale':1
                        ,	'ease':'easeOutExpo'
                    });

                    TweenMax.fromTo($before.find('.main_txt'),1.5,{
                        'margin-top':70
                        ,	'opacity':0
                        ,	'ease':'easeOutExpo'
                    },{
                        'margin-top':40
                        ,	'delay':.7
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });

                    TweenMax.fromTo($before.find('.sub_txt p'),1.5,{
                        'margin-top':70
                        ,	'opacity':0
                        ,	'ease':'easeOutExpo'
                    },{
                        'margin-top':0
                        ,	'delay':.9
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });
                    //////////////////////////////////////////////////////////////////////////
                    TweenMax.to($after.find('.car_img img'),1.5,{
                        'margin-left':0
                        ,	'ease':'easeOutExpo'
                    });

                    TweenMax.fromTo($after.find('.main_txt'),1.5,{
                        'margin-top':70
                        ,	'opacity':0
                        ,	'ease':'easeOutExpo'
                    },{
                        'margin-top':0
                        ,	'delay':.7
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });

                    TweenMax.fromTo($after.find('.sub_txt p'),1.5,{
                        'margin-top':70
                        ,	'opacity':0
                        ,	'ease':'easeOutExpo'
                    },{
                        'margin-top':0
                        ,	'delay':.9
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });
                }

			}else if(num === 6){
                if($('#wrap.main > #status_wrap').hasClass('long_rent')){
                    TweenMax.fromTo($scene.find('.main_txt p'),1.5,{
                        'margin-top':70
                        ,	opacity:0
                    },{
                        'margin-top':0
                        ,	opacity:1
                        ,	ease:'easeOutExpo'
                    });

                    TweenMax.fromTo($scene.find('.info_wrap'),1.5,{
                        opacity:0
                    },{
                        opacity:1
                        ,	ease:'easeOutExpo'
                    });

                    TweenMax.from($scene.find('.sub_txt .info_txt'),1,{
                        opacity:0
                        ,	delay:1.2
                    });
                    TweenMax.from($scene.find('.sub_txt .info_title_txt p'),1,{
                        opacity:0
                        ,	marginTop:150
                        ,	delay:1.5
                        ,	ease:'easeOutExpo'
                    });
                    TweenMax.from($scene.find('.car'),1,{
                        top:187
                        ,	opacity:0
                        ,	delay:.8
                        ,	ease:'easeOutExpo'
                    });
                    TweenMax.from($scene.find('.doc_left'),1,{
                        left:-215
                        ,	opacity:0
                        ,	delay:.8
                        ,	ease:'easeOutExpo'
                    });
                    TweenMax.from($scene.find('.doc_right'),1,{
                        left:240
                        ,	opacity:0
                        ,	delay:.8
                        ,	ease:'easeOutExpo'
                    });
                } else if($('#status_wrap').hasClass('commercial')){
                    TweenMax.to($scene.find('.txt_wrap'),1.5,{
                        'margin-top':40
                        ,	'opacity':1
                    });
                    TweenMax.to($scene.find('.vs_wrap .cont_wrap'),1.5,{
                        'margin-top':30
                        ,	'delay':.5
                        ,	'opacity':1
                        ,	'ease':'easeOutExpo'
                    });

                    TweenMax.fromTo($scene.find('.lease_car img'),1,{
                        'scale':.9
                        ,	'margin-left':15
                    },{
                        'scale':1
                        ,	'delay':1.2
                        ,	'margin-left':0
                        ,	'opacity':1
                        ,	'transformOrigin':"407px 53px"
                    });
                }
			}else{
				TweenMax.fromTo($scene.find('.main_txt .status_wrap-main_txt'),1.5,{
					'margin-top':70
					,	'opacity':0
					,	'ease':'easeOutExpo'
				},{
					'margin-top':0
					,	'opacity':1
					,	'ease':'easeOutExpo'
				});
				TweenMax.fromTo($scene.find('.sub_txt .status_wrap-sub_txt'),1.5,{
					'margin-top':20
					,	'opacity':0
					,	'ease':'easeOutExpo'
				},{
					'margin-top':0
					,	'delay':.4
					,	'opacity':1
					,	'ease':'easeOutExpo'
				});
				if(num === 1){
					if($('#wrap.main > #status_wrap').hasClass('installment')){
					TweenMax.from($('.mobile_wrap .status-installment .card_wrap').find('.nc_1_1'),.7,{
						top:17
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.5
						,	onComplete:function(){
							motionChk = false;
						}
					});
					TweenMax.from($('.mobile_wrap .status-installment .card_wrap').find('.nc_1_2'),.7,{
						top:125
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.3
					});
					TweenMax.fromTo($scene.find('.mobile_wrap .status_wrap-mobile'),1.5,{
						'margin-left':100
						,	'opacity':0
						,	'ease':'easeOutExpo'
					},{
						'margin-left':0
						,	'delay':.8
						,	'opacity':1
						,	'ease':'easeOutExpo'
						,	onComplete:function(){
							motionChk = false;
						}
					});
				}else if($('#wrap.main > #status_wrap').hasClass('long_rent')){
					TweenMax.from($('.mobile_wrap .status-long_rent .card_wrap').find('.nc_2_1'),.7,{
						top:17
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.3
					});
					TweenMax.from($('.mobile_wrap .status-long_rent .card_wrap').find('.nc_2_2'),.7,{
						top:120
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.5
					});
					TweenMax.fromTo($scene.find('.mobile_wrap .status_wrap-mobile'),1.5,{
						'margin-left':-100
						,	'opacity':0
						,	'ease':'easeOutExpo'
					},{
						'margin-left':0
						,	'delay':.8
						,	'opacity':1
						,	'ease':'easeOutExpo'
						,	onComplete:function(){
							motionChk = false;
						}
					});
				}else if($('#wrap.main > #status_wrap').hasClass('lease')){
					TweenMax.from($('.mobile_wrap .status-lease .card_wrap').find('.nc_3_1'),.7,{
						top:17
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.3
					});
					TweenMax.from($('.mobile_wrap .status-lease .card_wrap').find('.nc_3_2'),.7,{
						top:125
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.5
					});
					TweenMax.fromTo($scene.find('.mobile_wrap .status_wrap-mobile'),1.5,{
						'margin-left':100
						,	'opacity':0
						,	'ease':'easeOutExpo'
					},{
						'margin-left':0
						,	'delay':.8
						,	'opacity':1
						,	'ease':'easeOutExpo'
						,	onComplete:function(){
							motionChk = false;
						}
					});
				}else if($('#wrap.main > #status_wrap').hasClass('commercial')){
					TweenMax.from($('.mobile_wrap .status-commercial .card_wrap').find('.nc_4_1'),.7,{
						top:17
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.3
					});
					TweenMax.from($('.mobile_wrap .status-commercial .card_wrap').find('.nc_4_2'),.7,{
						top:125
						,	opacity:0
						,	ease:'easeOutExpo'
						,	delay:1.5
					});
					TweenMax.fromTo($scene.find('.mobile_wrap .status_wrap-mobile'),1.5,{
						'margin-left':100
						,	'opacity':0
						,	'ease':'easeOutExpo'
					},{
						'margin-left':0
						,	'delay':.8
						,	'opacity':1
						,	'ease':'easeOutExpo'
						,	onComplete:function(){
							motionChk = false;
						}
					});
				}
				}
			}*/
		}
	 }


}
