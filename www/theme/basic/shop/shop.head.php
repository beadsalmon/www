<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

if(G5_IS_MOBILE) {
    include_once(G5_THEME_MSHOP_PATH.'/shop.head.php');
    return;
}

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

if($it_id){ 
    $btitle = "유황비누 구매하기"; 
	$leftmn = "1"; 
	$rootx = ".."; 
	
}else if($bo_table == "notice"){ 
    $btitle = "유황시대 소식"; 
	$leftmn = "2"; 
	$rootx = ".."; 
	
}else if($fm_id){ 
    $btitle = "자주있는 질문"; 
	$leftmn = "3";
	$rootx = ".."; 
	
}else if($co_id == "service"){ 
    $btitle = "사업소개"; 
	$leftmn = "4";
	$rootx = ".."; 
	 
}else if($co_id == "company" || $co_id == "brandstory" || $bo_table == "certification" || $co_id == "history" || $co_id == "location"){ 
    $btitle = "회사소개"; 
	$leftmn = "5";
	$rootx = ".."; 
	 
}
?>

<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/jquery-1.12.4.min.js"></script>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/jquery.iosslider.min.js"></script>


<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>

    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
     } ?>
    <div id="tnb">
        <h3>회원메뉴</h3>
        <ul>
            <?php if(G5_COMMUNITY_USE) { ?>
            <li class="tnb_left"><a href="<?php echo G5_SHOP_URL; ?>/"><i class="fa fa-shopping-bag" aria-hidden="true"></i> 즐겨찾기</a></li>
            <li class="tnb_left"><a href="<?php echo G5_URL; ?>/"><i class="fa fa-home" aria-hidden="true"></i> 바로가기</a></li>
            <?php } ?>
            
            <li class="tnb_cart"><a href="<?php echo G5_SHOP_URL; ?>/cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> 장바구니</a></li>            
            <li><a href="<?php echo G5_SHOP_URL; ?>/mypage.php">마이샵</a></li>
            <?php if ($is_member) { ?>
            <li><a href="<?php echo G5_BBS_URL; ?>/member_confirm.php?url=register_form.php">정보수정</a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/logout.php?url=shop">로그아웃</a></li>
            <?php if ($is_admin) {  ?>
            <li class="tnb_admin"><a href="<?php echo G5_ADMIN_URL; ?>/shop_admin/"><b>관리자</b></a></li>
            <?php }  ?>
            <?php } else { ?>
            <li><a href="<?php echo G5_BBS_URL; ?>/login.php?url=<?php echo $urlencode; ?>"><b>로그인</b></a></li>
            <li><a href="<?php echo G5_BBS_URL; ?>/register.php">회원가입</a></li>
            <?php } ?>
        </ul>
    </div>
    <div id="hd_wrapper">
        <button type="button" id="gnb_open" class="hd_opener"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only"> 메뉴열기</span></button>
        <div id="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_URL ?>/img/logo.png" alt="<?php echo $config['cf_title']; ?>"></a></div>
        <a href="tel:010-4499-3552" id="user_btn" class="hd_opener"><i class="fa fa-phone" aria-hidden="true"></i><span class="sound_only">사용자메뉴</span></a>
    
        <nav id="gnb" class="hd_div">
        <h2>메인메뉴</h2>
        <div class="gnb_wrap">
            <ul id="gnb_1dul">
                <?php
                    $sql = " select *
                                from {$g5['menu_table']}
                                where me_use = '1'
                                  and length(me_code) = '2'
                                order by me_order, me_id ";
                    $result = sql_query($sql, false);
                    $gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                    $menu_datas = array();
    
                    for ($i=0; $row=sql_fetch_array($result); $i++) {
                        $menu_datas[$i] = $row;
    
                        $sql2 = " select *
                                    from {$g5['menu_table']}
                                    where me_use = '1'
                                      and length(me_code) = '4'
                                      and substring(me_code, 1, 2) = '{$row['me_code']}'
                                    order by me_order, me_id ";
                        $result2 = sql_query($sql2);
                        for ($k=0; $row2=sql_fetch_array($result2); $k++) {
                            $menu_datas[$i]['sub'][$k] = $row2;
                        }
    
                    }
    
                    $i = 0;
                    foreach( $menu_datas as $row ){
                        if( empty($row) ) continue; 
                    ?>
                    <li class="gnb_1dli" style="z-index:<?php echo $gnb_zindex--; ?>">
                        <a href="<?php echo $row['me_link']; ?>" target="_<?php echo $row['me_target']; ?>" class="gnb_1da"><?php echo $row['me_name'] ?></a>
                        <?php
                        $k = 0;
                        foreach( (array) $row['sub'] as $row2 ){
    
                            if( empty($row2) ) continue; 
    
                            if($k == 0)
                                echo '<button type="button" class="btn_gnb_op">하위분류</button><div class="gnb_2dul"><ul class="gnb_2dul_box">'.PHP_EOL;
                        ?>
                            <li class="gnb_2dli"><a href="<?php echo $row2['me_link']; ?>" target="_<?php echo $row2['me_target']; ?>" class="gnb_2da"><?php echo $row2['me_name'] ?></a></li>
                        <?php
                        $k++;
                        }   //end foreach $row2
    
                        if($k > 0)
                            echo '</ul>'.PHP_EOL;
                        ?>
                    </li>
                    <?php
                    $i++;
                    }   //end foreach $row
    
                    if ($i == 0) {  ?>
                        <li class="gnb_empty">메뉴 준비 중입니다.<?php if ($is_admin) { ?> <a href="<?php echo G5_ADMIN_URL; ?>/menu_list.php">관리자모드 &gt; 환경설정 &gt; 메뉴설정</a>에서 설정하실 수 있습니다.<?php } ?></li>
                    <?php } ?>
            </ul>
        </div>
        </nav>
    </div>
</div>


<script>
    
    $(function(){
        $(".gnb_menu_btn").click(function(){
            $("#gnb_all").show();
        });
        $(".gnb_close_btn").click(function(){
            $("#gnb_all").hide();
        });
		
		$(".hd_opener").on("click", function() {
			var $this = $(this);
			var $hd_layer = $(".hd_div");

			if($hd_layer.is(":visible")) {
				$hd_layer.hide();
				$this.find("span").text("열기");
			} else {
				var $hd_layer2 = $(".hd_div:visible");
				$hd_layer2.prev(".hd_opener").find("span").text("열기");
				$hd_layer2.hide();

				$hd_layer.show();
				$this.find("span").text("닫기");
			}
		});

		$("#container").on("click", function() {
			if($(window).width() < 701){
			  $(".hd_div").hide();
			}
		});

		$(".btn_gnb_op").click(function(){
			$(this).toggleClass("btn_gnb_cl").next(".gnb_2dul").slideToggle(300);
			
		});

		$(".hd_closer").on("click", function() {
			var idx = $(".hd_closer").index($(this));
			$(".hd_div:visible").hide();
			$(".hd_opener:eq("+idx+")").find("span").text("열기");
		});
		
		$(".svisual h1").fadeIn();
		$(".svisual h2").fadeIn();
		
		if($(window).width() > 700){
	      $(".svisual p").delay("200").fadeIn();
		}
    });

    </script>


<?php if (!defined("_INDEX_")) { ?>
<div class="svisual" id="subvisual1">
  <div>
    <h1>#유황시대</h1>
    <h2>NATURE SOAP</h2>
    <p>천연 연료가 함유되어 피부 재생력과 미백효과가 뛰어난 유황시대 고급 미용비누</p>
  </div>
</div>

<div class="contitle">
  <ul>
    <li><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_URL ?>/img/home.png" id="homeimg" /></a></li>
    <li><?php echo $btitle; ?> <span><img src="<?php echo G5_THEME_URL ?>/img/gnb_bg.gif" /></span></li>
    <li><?php echo $g5['title']; ?> <span><img src="<?php echo G5_THEME_URL ?>/img/gnb_bg.gif" /></span></li>
  </ul>
</div>
<?php } ?>


<div id="wrapper">

    <?php if (!defined("_INDEX_")) { ?>
    <script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/TweenMax.js"></script>
	<script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/main.js"></script>
    <script type="text/javascript" src="<?php echo G5_THEME_URL ?>/js/main_longrent.js"></script>
    <?php } ?>

    <!-- 콘텐츠 시작 { -->
    <div id="<?php if(!defined("_INDEX_")){ echo "container_wr"; }else{ echo "container"; } ?>">
        <?php if ($bo_table || $ca_id) { ?>
        
        
        <div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?>