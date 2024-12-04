<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

if(G5_COMMUNITY_USE === false) {
    include_once(G5_THEME_SHOP_PATH.'/shop.head.php');
    return;
}
include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

if($co_id == "greeting" || $co_id == "organization" || $co_id == "history" || $co_id == "articles" || $co_id == "location"){ 
    $btitle = "KPPA 소개"; 
	$leftmn = "1"; 
	$rootx = ".."; 
	
}else if($co_id == "rankinfo" || $bo_table == "rankrule" || $bo_table == "ranking"){ 
    $btitle = "KPPA 랭킹"; 
	$leftmn = "2"; 
	$rootx = ".."; 
	
}else if($bo_table == "tournament" || $bo_table == "tourdate" || $bo_table == "result" || $bo_table == "tourinfo"){ 
    $btitle = "대회정보"; 
	$leftmn = "3";
	$rootx = ".."; 
	
}else if($bo_table == "tourlist" || $bo_table == "comin"){ 
    $btitle = "참가신청"; 
	$leftmn = "4";
	$rootx = ".."; 
	 
}else if($bo_table == "notice" || $bo_table == "free" || $bo_table == "qa"){ 
    $btitle = "커뮤니티"; 
	$leftmn = "5";
	$rootx = ".."; 
	 
}else if($bo_table == "coat" || !$bo_table){ 
    $btitle = "코트안내"; 
	$leftmn = "6";
	$rootx = ".."; 
	 
}
?>


<!-- 상단 시작 { -->
<div id="hd">
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>
    
    
    <div id="hd_wrapper">
        <button type="button" id="gnb_open" class="hd_opener"><i class="fa fa-bars" aria-hidden="true"></i><span class="sound_only"> 메뉴열기</span></button>
        <div id="logo"><a href="<?php echo G5_URL ?>"><img src="<?php echo G5_THEME_URL ?>/img/logo.png" alt="<?php echo $config['cf_title']; ?>"></a></div>
        <a href="tel:+82-43-753-8822" id="user_btn" class="hd_opener"><i class="fa fa-phone" aria-hidden="true"></i><span class="sound_only">사용자메뉴</span></a>
        
        <div id="tnb">
            <ul id="hd_qnb">
                <?php if ($is_member) {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/member_confirm.php?url=<?php echo G5_BBS_URL ?>/register_form.php">Mypage</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                <?php if ($is_admin) {  ?>
                <li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a></li>
                <?php }  ?>
                <?php } else {  ?>
                <li><a href="<?php echo G5_BBS_URL ?>/register.php">회원가입</a></li>
                <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
                <?php }  ?>
            </ul>
        </div>
        
        
        <nav id="gnb" class="hd_div">
        <h2><img src="<?php echo G5_THEME_URL ?>/img/logo.png" alt="<?php echo $config['cf_title']; ?>" width="70%" style="margin:10px 0;"></h2>
        <div class="gnb_wrap">
            <ul id="gnb_1dul">
                <?php
				$menu_datas = get_menu_db(0, true);
				$gnb_zindex = 999; // gnb_1dli z-index 값 설정용
                $i = 0;
                foreach( $menu_datas as $row ){
                    if( empty($row) ) continue;
                    $add_class = (isset($row['sub']) && $row['sub']) ? 'gnb_al_li_plus' : '';
                ?>
                <li class="gnb_1dli <?php echo $add_class; ?>" style="z-index:<?php echo $gnb_zindex--; ?>">
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
                        echo '</ul></div>'.PHP_EOL;
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
        
        
        <div id="gnb_all_bg"></div>
    </div>
</div>
<!-- } 상단 끝 -->


<script>
    
    $(function(){
        $(".gnb_menu_btn").click(function(){
            $("#gnb_all").slideDown();
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
			$("#gnb_all_bg").show();
		});

		$("#gnb_all_bg").on("click", function() {
			if($(window).width() < 901){
			  $(".hd_div").hide();
			  $("#gnb_all_bg").hide();
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
	    $(".svisual p").delay("200").fadeIn();
		
		$('a[href*="#"]:not([href="#"])').click(function() {
			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
				var target = $(this.hash);
				target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
				if (target.length) {
					$('html, body').animate({
						scrollTop: target.offset().top
					}, 500);
					return false;
				}
			}
		});
		
		/*
		$(".contitle ul li").click(
		   function(){
			   var cond = $(this).attr("cond");
			   if(!cond || cond == "off"){
			     $(this).find("#subboxs").fadeIn();
				 $(this).attr("cond","on");
			   }else{
				 $(this).find("#subboxs").css("display","none");
				 $(this).attr("cond","off");
			   }
		   }
		);
		 
		$(".contitle ul li a").click(
		   function(){
			  src = $(this).attr("href");
			  window.location.href = src;
		   }
		);
		*/
		
		$(".linksel").change(
		   function(){
			  src = $(this).val();
			  window.open(src);
		   }
		);
		
		$("#top_btn").on("click", function() {
			$("html, body").animate({scrollTop:0}, '500');
			return false;
		});
		
		$(window).scroll(function(){
			var scrTop = $(window).scrollTop();
			if($(window).width() > 901){
			  if(scrTop > 0){
				  $("#hd").css({"background-color":"rgba(0,0,0,0.9)","box-shadow":"3px 3px 3px rgba(0,0,0,0.1)"});
			  }else{
				  $("#hd").css({"background-color":"","box-shadow":"3px 3px 3px rgba(0,0,0,0)"});
			  }
			}else{
			  if(scrTop > 0){
				  $("#hd").css({"background-color":"rgba(0,0,0,0.9)","box-shadow":"3px 3px 3px rgba(0,0,0,0.1)"});
			  }else{
				  $("#hd").css({"background-color":"","box-shadow":"3px 3px 3px rgba(0,0,0,0)"});
			  }
			}
			
			
			if(scrTop > 100){
			  $('.nums').each(function () {
				  const $this = $(this),
					  countTo = $this.attr('data-count');
	  
				  $({
					  countNum: $this.text()
				  }).animate({
					  countNum: countTo
				  }, {
					  duration: 1000,
					  easing: 'linear',
					  step: function () {
						  $this.text(Math.floor(this.countNum));
					  },
					  complete: function () {
						  $this.text(this.countNum);
					  }
				  });
			  });
			}
		});
		
		
		
    });

    </script>


<?php if (!defined("_INDEX_")) { ?>
<div class="svisual" id="subvisual<?php echo $leftmn; ?>">
  <div>
    <h2>한국피클볼협회</h2>
    <p>피클볼 대회 일정과 정보, 참가 및 각종 정보를 한국피클볼대회에서 자세히 확인하실 수 있습니다.</p>
  </div>
</div>
<?php } ?>



<div id="wrapper">

    
    <!-- 콘텐츠 시작 { -->
    <div id="<?php if(defined("_INDEX_")){ echo "container"; }else{ echo "container_wr"; } ?>">
    
        
    
        <?php if ($bo_table || $ca_id) { ?><div id="wrapper_title"><?php echo $g5['title'] ?></div><?php } ?>