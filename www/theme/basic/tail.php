<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/shop.tail.php');
    return;
}
?>

    </div>
    <!-- } 콘텐츠 끝 -->

<!-- 하단 시작 { -->
</div>

<div id="ft">
  <div id="ft_wr">
     <div class="ft_info">
        <h3><img src="/theme/basic/img/logo.png" /></h3>
        <ul>
          
          <li>
            <div id="infos">
              <span><font>회사명</font> 한국피클볼협회</span>
              <span><font>주소</font> 서울특별시 성동구 자동차시장 1길 49 화성빌딩 3층 (04808)</span>
              <span><font>TEL.</font> 02-2282-0301</span>
              <span><font>FAX.</font> 02-2282-0301</span>
              <span><font>E-MAIL</font> info@kppa.co.kr</span>
            </div>
          </li> 
        </ul>
     </div>
  </div>
  
  <div class="ft_copy">Copyright &copy; <b>2024 KPPA</b>. All Rights Reserved.</div>

  <button type="button" id="top_btn"><i class="fa fa-arrow-up" aria-hidden="true"></i><span class="sound_only">상단으로</span></button>
</div>



<?php if ($co_id) { ?>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/TweenMax.js"></script>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/main.js"></script>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/main_longrent.js"></script>
<?php } ?>



<?php
if(G5_DEVICE_BUTTON_DISPLAY && !G5_IS_MOBILE) { ?>
<?php
}

if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/inc/js/nav.js"></script>

<?php
include_once(G5_THEME_PATH."/tail.sub.php");
?>