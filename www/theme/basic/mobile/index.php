<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_MSHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_MOBILE_PATH.'/head.php');
?>

<link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_URL ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo G5_THEME_URL ?>/css/styles.css">



<div class="fluidHeight">
	<div class="sliderContainer">
		<div class="iosSlider">
			<div class="slider">
                <div class="item item1">
					<div class="inner">
                      <div class="INpos">
                        <div class="text1"><span><img src="<?php echo G5_THEME_URL ?>/img/slide/text1.png" border="0" /></span></div>
                      </div>
                    </div>
				</div>
            
				<div class="item item2">
					<div class="inner">
                      <div class="INpos">
                        <div class="text1"><span><img src="<?php echo G5_THEME_URL ?>/img/slide/text1.png" border="0" /></span></div>
                      </div>
                    </div>
				</div>
			</div>
		</div>
		
		<div class="slideSelectors">
			<div class="item selected" cnt="0"></div>
			<div class="item" cnt="1"></div>
		</div>
        
        <div class="sliside">
          <p id="lefts"></p>
          <p id="rights"></p>
        </div>
	</div>
</div>





<script type="text/javascript">
$(document).ready(function() {
	
	$('.iosSlider').iosSlider({
		desktopClickDrag: true,
		snapToChildren: true,
		navSlideSelector: '.sliderContainer .slideSelectors .item',
		onSlideComplete: slideComplete,
		onSliderLoaded: sliderLoaded,
		onSlideChange: slideChange,
		scrollbar: false,
		autoSlide: true,
		autoSlideTimer: 3300,
    infiniteSlider: true
	});
	
	$(".sliside #lefts").click(function(){
		var cnt = $('.sliderContainer .slideSelectors').find('.selected').attr("cnt");
		if(cnt == 0){
			$('.sliderContainer .slideSelectors div').eq(2).click();
		}else {
			$('.sliderContainer .slideSelectors div').eq(cnt-1).click();
		}
	});
	
	$(".sliside #rights").click(function(){
		var cnt = $('.sliderContainer .slideSelectors').find('.selected').attr("cnt");
		if(cnt == 2){
			$('.sliderContainer .slideSelectors div').eq(0).click();
		}else if(cnt == 1){
			$('.sliderContainer .slideSelectors div').eq(2).click();
		}else{
			$('.sliderContainer .slideSelectors div').eq(1).click();
		}
	});
	
});



function slideChange(args) {
			
	$('.sliderContainer .slideSelectors .item').removeClass('selected');
	$('.sliderContainer .slideSelectors .item:eq(' + (args.currentSlideNumber - 1) + ')').addClass('selected');

}

function slideComplete(args) {
	
	if(!args.slideChanged) return false;
	
	$(args.sliderObject).find('.text1, .text2').attr('style', '');
	
	$(args.currentSlideObject).find('.text1').animate({
		left: '0%',
		opacity: '1'
	}, 400, 'easeOutQuint');
	
	$(args.currentSlideObject).find('.text2').delay(200).animate({
		left: '0%',
		opacity: '1'
	}, 400, 'easeOutQuint');
}

function sliderLoaded(args) {
		
	$(args.sliderObject).find('.text1, .text2').attr('style', '');
	
	$(args.currentSlideObject).find('.text1').animate({
		left: '0%',
		opacity: '1'
	}, 400, 'easeOutQuint');
	
	$(args.currentSlideObject).find('.text2').delay(200).animate({
		left: '0%',
		opacity: '1'
	}, 400, 'easeOutQuint');
	
	slideChange(args);
	
}
</script>



<div class="content">


    <div class="scene-1">
        <div class="cont_wrap">
            <div class="inner">
                <div class="main_txt">
                    <div><img src="/theme/basic/img/product.png" /></div>
                </div>
                
                <div class="sub_txt">
                    <h5>세상에 없던 새로운 비누 탄생!!</h5>
                    <h2>올인원 미용비누<br /><font>#유황시대</font></h2>
                    <p>도대체 정체가 뭐니?<br />완벽한 폼클렌징은 기본, 바디 클렌저에 샴푸까지</p>
                    <div><a href="">유황시대 바로가기 →</a></div>
                </div>
            </div>
        </div>
                        
        <div class="number_case">
            <div class="inner"></div>
        </div>

    </div>
    
    
    <div class="scene-2">
        <div class="cont_wrap">
            <div class="inner">
                <div class="main_txt">
                    <h2>NATURE <font>SOAP</font></h2>
                    <p>천연 연료가 함유되어 피부 재생력과 미백효과가 뛰어난 유황시대 고급 미용비누</p>
                </div>
                
                <div class="sub_txt">
                    <div>
                      <ul>
                        <li><img src="/theme/basic/img/icon01.png" /><br />피부탄력</li>
                        <li><img src="/theme/basic/img/icon02.png" /><br />미 백</li>
                        <li><img src="/theme/basic/img/icon03.png" /><br />탈모예방</li>
                        <li><img src="/theme/basic/img/icon04.png" /><br />각질제거</li>
                        <li><img src="/theme/basic/img/icon05.png" /><br />피부진정</li>
                        <li><img src="/theme/basic/img/icon06.png" /><br />모발재생</li>
                      </ul>
                    </div>
                </div>
                
                <div class="mobile_wrap">
                    <div>
                    유황시대 올인원 비누는 일반 비누와 달리, <font>풍성한 거품을 내고 피부를 진정시켜주는 효과</font>가 있으며,
                    <font>세정력이 우수하여 세안후 산뜻한 느낌</font>을 줍니다.<br />
                    <font>미백 및 피부탄력, 탈모예방이 강화</font>되는 고급 미용 비누입니다.
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    
    <div class="scene-3">
        <div class="cont_wrap">
            <div class="inner">
                <div class="main_txt">
                  <div>
                    <h3>#유황시대</h3>
                    <h2>NATURE SOAP</h2>
                    <p>천연 연료가 함유되어 피부 재생력과 미백효과가 뛰어난 유황시대 고급 미용 비누</p>
                  </div>
                </div>
                
                <div class="sub_txt">
                    <div></div>
                </div>
            </div>
        </div>

    </div>
    
    
    <div class="scene-4">
        <div class="cont_wrap">
            <div class="inner">
            
                <div class="main_txt">
                    <h2>유황시대</h2>
                    <p>작두콩 추출물 및 발효 줄기세포 활성화제 성분이 함유되어 원초적인 피부를 개선하고 민감성 피부타입을 위해 개발된 격조높은 비누입니다.</p>
                    <div>
                      <ul>
                        <li>
                          <h4>40가지 천연 한방 추출물</h4>
                          <p>천연 한방 추출물 40가지 이상이 함유되어 있어 우수한 세정력은 물론 각질 제거, 트러블 진정, 탈모감소에 도움을 줍니다.</p>
                        </li>
                        
                        <li>
                          <h4>13가지 천연 원료 주성분</h4>
                          <p>국내 농장에서 직접 유기농으로 재배한 천연원료를 사용하여 피부에 안전하고 효과적으로 가꾸어 줍니다.</p>
                        </li>
                      </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    
</div>

<?php
include_once(G5_THEME_MOBILE_PATH.'/tail.php');
?>