/* *******************************************************
 * filename : nav.js
 * description : 네비게이션 및 사이드바 on 등 메뉴에 관련된 JS
 * date : 2020-11-25
******************************************************** */

var $snb = $(".snb");
var $snbMenu = $(".cm-top-menu");
// PC
var $gnb = $("#gnb");
var $gnbList = $("#gnb > ul");
var $gnb_dep1 = $("#gnb > ul > li");
var $gnb_dep2 = $("#gnb > ul > li .gnb-2dep");
var $gnbBg = $('.gnb-overlay-bg');
// 모바일
var $menuBtn = $("#header .nav-open-btn");
var $gnbM = $("#gnbM");
var $gnbMList = $gnbM.find("#navigation").children("li");
var $gnbMBg = $('.gnb-overlay-bg-m');
var menuState = false;

// 모바일 gnb열린 후 창 크게했을때 스크롤바 생성
$(window).resize(function  () {
	if ( menuState ) {
		if ( getWindowWidth() > tabletWidth ) {
			$("body").css({'height':'auto', 'overflow':'auto'});
		}
	}
});

/* *********************** PC NAV ************************ */
// gnb 전체메뉴
function gnb_total_on () {
	$gnbList.children("li").children("a").on("mouseenter focus",function  () {
		if (!($gnb.is(".open"))) {
			$("#gnb").addClass("open");
			$gnbBg.stop().fadeIn();
		}
	})

	$gnbList.on("mouseleave",gnb_return);
	$gnbList.find("a").last().on("focusout",gnb_return);
	
	function gnb_return () {
		$("#gnb").removeClass("open");
		$gnbBg.hide();
		if ( dep1 > 0 && dep2 ) {
			$gnbList.children("li").eq(dep1-1).addClass("active");
		}
	}
}

// gnb 각각메뉴
function gnb_each_on () {
	$gnbList.children("li").children("a").on("mouseenter focus",function  () {
		$gnbList.children("li").removeClass("on").children(".gnb-2dep").removeClass("open"); //.hide();
		$(this).parent("li").addClass("on").children(".gnb-2dep").stop().addClass("open"); //.slideDown(500);
	})

	$gnbList.children("li").on("mouseleave",gnb_return);
	$gnbList.find("a").last().on("focusout",gnb_return);
	
	function gnb_return () {
		// if (!$gnb.find('*').is(':animated')) {
			$gnbList.children("li").removeClass("on").children(".gnb-2dep").removeClass("open"); //.hide();
		// }
		if ( dep1 > 0 && dep2 ) {
			$gnbList.children("li").eq(dep1-1).addClass("active");
		}
	}
}



/* *********************** MOBILE NAV ************************ */
//  메뉴열기
function menuOpen () {
	menuState = true;
	$menuBtn.addClass("active");
	$gnbM.addClass("open");
	$gnbMBg.fadeIn();
	$("body").css({'height':$(window).height(), 'overflow':'hidden'});
}
// 메뉴닫기
function menuClose () {
	menuState = false;
	$menuBtn.removeClass("active");
	$gnbM.removeClass("open");
	$gnbMBg.hide();
	$("body").css({'height':'auto', 'overflow':'auto'});
}

$(function(){
	//  gnb 메뉴열기
	if ( $gnb.is(".total-menu") ) {
		gnb_total_on();
	}else if ( $gnb.is(".each-menu") ) {
		gnb_each_on();
	}

});


/* *********************** Sub 공통 ************************ */
// 이전페이지,다음페이지 링크걸기 ( 2depth 이동 )
function checkPrevNextLink () {
	var $sub_prev_page_btn = $(".sub-prev-page-btn");
	var $sub_next_page_btn = $(".sub-next-page-btn");
	var $dep1_menu = $("#gnb > ul > li");
	var dep1_menu_lang = $dep1_menu.length;

	$sub_prev_page_btn.attr("href",$dep1_menu.eq(dep1-2).children("a").attr("href"));
	$sub_next_page_btn.attr("href",$dep1_menu.eq(dep1).children("a").attr("href"));

	$sub_prev_page_btn.find(".sub-page-name").text($dep1_menu.eq(dep1-2).children("a").text());
	$sub_next_page_btn.find(".sub-page-name").text($dep1_menu.eq(dep1).children("a").text());

	if ( dep1 == dep1_menu_lang ) {
		$sub_next_page_btn.attr("href",$dep1_menu.eq(0).children("a").attr("href"));
		$sub_next_page_btn.find(".sub-page-name").text($dep1_menu.eq(0).children("a").text());
	}else if ( dep1 == 1 ) {
		$sub_prev_page_btn.attr("href",$dep1_menu.eq(dep1_menu_lang-1).children("a").attr("href"));
		$sub_prev_page_btn.find(".sub-page-name").text($dep1_menu.eq(dep1_menu_lang-1).children("a").text());
	}
}

