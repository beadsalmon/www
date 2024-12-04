function sceneMotionFn(el, num) {
    var $scene = el;

    if(num ===  3){
        TweenMax.fromTo($scene.find('.main_txt div'),1.5,{
            'margin-top':70
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });

        TweenMax.fromTo($scene.find('.sub_txt div'),1.5,{
            'margin-top':20
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'delay':.4
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });

        TweenMax.fromTo($scene.find('.mobile_wrap div'),1.5,{
            'margin-left':-100
            ,	'opacity':0
        },{
            'margin-left':0
            ,	'delay':1.3
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });
		
		
    }else if(num === 4){
        TweenMax.fromTo($scene.find('.main_txt div'),1.5,{
            'margin-top':70
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'delay':.4
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });

        TweenMax.fromTo($scene.find('.sub_txt div'),1.5,{
            'margin-top':0
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'delay':.8
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });
        TweenMax.fromTo($scene.find('.mobile_wrap div'),1.5,{
            'margin-top':0
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'opacity':1
            ,	'delay':1.3
            ,	'ease':'easeOutExpo'
        });
		TweenMax.fromTo($scene.find('.vi_wrap div'),1.5,{
            'margin-top':0
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'opacity':1
            ,	'delay':1.3
            ,	'ease':'easeOutExpo'
            ,	onComplete:function(){
                motionChk = false;
            }
        });
		
	}else if(num === 5){
        TweenMax.fromTo($scene.find('.main_txt div'),1.5,{
            'margin-top':70
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'delay':.4
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });

        TweenMax.fromTo($scene.find('.sub_txt div'),1.5,{
            'margin-top':0
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'delay':.8
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });
        TweenMax.fromTo($scene.find('.mobile_wrap div'),1.5,{
            'margin-top':0
            ,	'opacity':0
        },{
            'margin-top':20
            ,	'opacity':1
            ,	'delay':1.3
            ,	'ease':'easeOutExpo'
            ,	onComplete:function(){
                motionChk = false;
            }
        });
		
	}else if(num === 6){
        TweenMax.fromTo($scene.find('.main_txt div'),1.5,{
            'margin-top':70
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'delay':.4
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });

        TweenMax.fromTo($scene.find('.sub_txt div'),1.5,{
            'margin-top':0
            ,	'opacity':0
        },{
            'margin-top':0
            ,	'delay':.8
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });
        TweenMax.fromTo($scene.find('.mobile_wrap div'),1.5,{
            'margin-top':0
            ,	'opacity':0
        },{
            'margin-top':20
            ,	'opacity':1
            ,	'delay':1.3
            ,	'ease':'easeOutExpo'
            ,	onComplete:function(){
                motionChk = false;
            }
        });	

    }else{
        TweenMax.fromTo($scene.find('.main_txt div'),1.5,{
            'margin-top':70
            ,	'opacity':0
            ,	'ease':'easeOutExpo'
        },{
            'margin-top':0
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });
        TweenMax.fromTo($scene.find('.sub_txt div'),1.5,{
            'margin-top':20
            ,	'opacity':0
            ,	'ease':'easeOutExpo'
        },{
            'margin-top':0
            ,	'delay':.4
            ,	'opacity':1
            ,	'ease':'easeOutExpo'
        });
		TweenMax.fromTo($scene.find('.mobile_wrap div'),1.5,{
			'margin-top':0
			,	'opacity':0
			,	'ease':'easeOutExpo'
		},{
			'margin-top':20
			,	'delay':.8
			,	'opacity':1
			,	'ease':'easeOutExpo'
			,	onComplete:function(){
				motionChk = false;
			}
		});
		
        if(num === 1){
			TweenMax.fromTo($scene.find('.main_txt div'),1.5,{
            'margin-top':70
            ,	'opacity':0
            ,	'ease':'easeOutExpo'
			},{
				'margin-top':0
				,	'opacity':1
				,	'ease':'easeOutExpo'
			});
			TweenMax.fromTo($scene.find('.sub_txt div'),1.5,{
				'margin-top':20
				,	'opacity':0
				,	'ease':'easeOutExpo'
			},{
				'margin-top':0
				,	'delay':.4
				,	'opacity':1
				,	'ease':'easeOutExpo'
			});
            TweenMax.fromTo($scene.find('.mobile_wrap div'),1.5,{
                'margin-left':270
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
			TweenMax.fromTo($scene.find('.vi_wrap div'),1.5,{
                'margin-right':270
                ,	'opacity':0
                ,	'ease':'easeOutExpo'
            },{
                'margin-right':0
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

