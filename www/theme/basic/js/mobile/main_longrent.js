function sceneMotionFn(el, num) {
    var $scene = el;

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


    }else if(num === 5){
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

    }else if(num === 6){
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
        }
    }


}

