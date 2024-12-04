<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>


<link rel="stylesheet" href="<?php echo G5_THEME_URL ?>/css/main.css">




<div class="content">
    
    <div class="scene-1">
        <div class="cont_wrap">
            <div class="inner">
            
                <div class="main_txt topbox">
                    <div>
                      <h2>한국피클볼진흥협회</h2>
                      <p>피클볼 대회 일정과 정보, 참가 및 각종 정보를<BR />한국피클볼대회에서 자세히 확인하실 수 있습니다.</p>
                      <a href="">자세히보기</a>
                    </div>
                </div>
                
                <div class="sub_txt">
                    <div><?php echo latest('theme/result', 'result', 4, 23); ?></div>
                    <div><?php echo latest('theme/table', 'table', 4, 23); ?></div>
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
                    <div>
                      <ul>
                        <li>
                          <span><img src="/theme/basic/img/icon/ic01.png" /></span>
                          <h5>선수랭킹</h5>
                          <p>Rankings</p>
                        </li>
                        <li>
                          <span><img src="/theme/basic/img/icon/ic02.png" /></span>
                          <h5>참가신청</h5>
                          <p>Application</p>
                        </li>
                        <li>
                          <span><img src="/theme/basic/img/icon/ic03.png" /></span>
                          <h5>랭킹규정</h5>
                          <p>Ranking Rules</p>
                        </li>
                        <li>
                          <span><img src="/theme/basic/img/icon/ic04.png" /></span>
                          <h5>1:1문의</h5>
                          <p>1:1 Q&A</p>
                        </li>
                        <li>
                          <span><img src="/theme/basic/img/icon/ic05.png" /></span>
                          <h5>코트안내</h5>
                          <p>Coat Guide</p>
                        </li>
                        <li>
                          <span><img src="/theme/basic/img/icon/ic06.png" /></span>
                          <h5>대회운영</h5>
                          <p>Management</p>
                        </li>
                      </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    
    <div class="scene-3">
        <div class="cont_wrap">
            <div class="inner">
                
                <div class="main_txt">
                    <div><?php echo latest('theme/basic', 'notice', 4, 23); ?></div>
                    <div><?php echo latest('theme/basic', 'free', 4, 23); ?></div>
                    <div><?php echo latest('theme/ranking', 'ranking', 4, 23); ?></div>
                </div>
                
            </div>
        </div>
    </div>
    
    
    <div class="scene-4">
        <div class="cont_wrap">
            <div class="inner">
            
                <div class="main_txt">
                    <div>
                      <h2>피클볼 대회 일정과 정보, 참가 및 각종 정보를 한국피클볼대회에서 자세히 확인하실 수 있습니다.</h2>
                      <p>피클볼에 관심이 있으시다면 지금 바로 확인해보세요.</p>
                      <a href="">대회정보 보기 →</a>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</div>




<script>
$(function(){
	if($(window).width() > 900){
		if($(window).height() > 800){
	      $(".scene-1 .cont_wrap .inner").css("height",$(window).height());
		}else{
		  $(".scene-1 .cont_wrap .inner").css("height","900px");
		}
	}
	$(window).resize(function(){
		if($(window).width() > 900){
			if($(window).height() > 800){
			  $(".scene-1 .cont_wrap .inner").css("height",$(window).height());
			}else{
			  $(".scene-1 .cont_wrap .inner").css("height","900px");
			}
		}
	});
});
</script>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/TweenMax.js"></script>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/main_longrent.js"></script>



<?php
include_once(G5_THEME_PATH.'/tail.php');
?>