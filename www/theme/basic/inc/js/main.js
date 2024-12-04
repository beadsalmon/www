/* *******************************************************
 * filename : main.js
 * description : 메인에만 사용되는 JS
 * date : 2020-11-25
******************************************************** */

$(document).ready(function  () {
	/* ************************
	* Func : fullpage 레이아웃 사용시
	* fullpage.js, checkOffset(), toFit() 필요
	************************ */
	if ($.exists('#fullpage')) {
		var $fullPage = $("#fullpage");
		var $fullPageSection = $fullPage.children(".section");
		if ( detectBrowser() === "ie") {
			var scroll_speed = 500;
		}else {
			var scroll_speed = 800;
		}
		$fullPage.fullpage({
			css3: true,
			fitToSection: false,
			navigation: true,
			scrollBar:false,
			scrollingSpeed:scroll_speed,
			navigationPosition: 'right',
			//navigationTooltips: ['Content01', 'Content02', 'Content03', 'Content04'],
			responsiveWidth: tabletWidth,
			responsiveHeight : 750,
			onLeave : function(origin, destination, direction){
				if ( !($fullPageSection.eq(origin).is(".active-section")) ) {
					setTimeout(function  () {
						$(".section").eq(origin).addClass("active-section");
					},500);
				}
				if ( destination == 1 ) {
					$("#header").removeClass("hide");
					$("#fp-nav").removeClass("hide");
					$(".fixed-right-bar").removeClass("hide");
					$(".fixed-left-bar").removeClass("hide");
					$(".fixed-left-bar span").removeClass("main02 main03 main04").addClass("main01");
				}else if( destination == 2 ){
					$(".fixed-left-bar span").removeClass("main01 main03 main04").addClass("main02");
					setTimeout(function  () {
						$("#mainAboutCon .main-about-tit-box .inner").addClass("aos-animate");
						$("#mainAboutCon .main-about-sub-tit").addClass("aos-animate");
						$(".main-about-con").addClass("aos-animate");
					},200);
				}else if( destination == 3 ){
					$(".fixed-left-bar span").removeClass("main01 main03 main04").addClass("main03");
					setTimeout(function  () {
						$("#mainProductCon .main-tit-box").addClass("aos-animate effect-start");
						$(".main-prd-wrapper").addClass("aos-animate");
					},200);
				}else if( destination == 4 ){
					$(".fixed-left-bar span").removeClass("main01 main02 main04").addClass("main04");
					setTimeout(function  () {
						$("#mainNewsCon .main-tit-box").addClass("aos-animate");
						$(".main-news-list").addClass("aos-animate");
						$(".main-invest-item").addClass("aos-animate");
					},200);
				}else if( destination == 5 ){
					$("#header").removeClass("hide");
					$("#fp-nav").removeClass("hide");
					$(".fixed-right-bar").removeClass("hide");
					$(".fixed-left-bar").removeClass("hide");
					$(".fixed-left-bar span").removeClass("main01 main02 main03").addClass("main05");
					setTimeout(function  () {
						$("#mainRecruitCon .main-tit-box").addClass("aos-animate effect-start");
						$(".main-recruit-item").addClass("aos-animate");
					},200);
				}else if( destination == 6 ){
					$("#header").addClass("hide");
					$("#fp-nav").addClass("hide");
					$(".fixed-right-bar").addClass("hide");
					$(".fixed-left-bar").addClass("hide");
				}

				// 사이드바 색상변경
				if ( destination > 1 && destination != 2 && destination != 3 && destination != 5 && destination != 6 ) {
					$("#header").addClass("black");
					$("#fp-nav").addClass("black");
					$(".header-lang03").removeClass("black");
					$(".fixed-right-bar").removeClass("top").addClass("black");
				}else if ( destination > 1 && destination == 2 ) {
					$("#header").removeClass("black");
					$(".header-lang03").addClass("black");
					$("#fp-nav").addClass("black");
					$(".fixed-right-bar").removeClass("top").removeClass("black");
				}else if ( destination > 1 && destination == 3 ) {
					$("#header").removeClass("black");
					$(".header-lang03").addClass("black");
					$("#fp-nav").addClass("black");
					$(".fixed-right-bar").removeClass("top").removeClass("black");
				}else if ( destination > 1 && destination == 5 ) {
					$("#header").removeClass("black");
					$("#fp-nav").removeClass("black");
					$(".header-lang03").removeClass("black");
					$(".fixed-right-bar").removeClass("black").addClass("top");
				}else if ( destination > 1 && destination == 6 ) {
					$("#header").removeClass("black");
					$("#fp-nav").removeClass("black");
					$(".header-lang03").removeClass("black");
					$(".fixed-right-bar").removeClass("black").addClass("top");
				}else {
					$("#header").removeClass("black");
					$("#fp-nav").removeClass("black");
					$(".header-lang03").removeClass("black");
					$(".fixed-right-bar").removeClass("top black");
				}
			}
		});
	}
	/* *********************** 메인 비주얼 ************************ */
	// fadeIn
	$(".ms-preloader").animate({"opacity":"0"},1000,"easeInOutCubic",function  () {
		$(".ms-preloader").css("visibility", "hidden");
	});
	
	// 메인 비주얼 높이값 설정
	if ($.exists('#mainVisual.full-height')) {
		mainVisualHeight();
		$(window).on('resize', mainVisualHeight);

		function mainVisualHeight () {
			var visual_height = getWindowHeight()	- $("#header").height();	// header가 fixed or absolute일경우 - $("#header").height() 삭제
			if ( getWindowWidth() > 800 ) {
				$("#mainVisual").height(visual_height);
			}else {
				$("#mainVisual").css("height","auto");
			}
		}
	}

	//메인 비주얼 슬라이드
	var $mainVisual = $(".main-visual-slider");
	var $mainVisualItem = $mainVisual.find(".main-visual-item");
	var $mainLoadingBar = $(".main-visual-loading-bar > span");
	var $mainCounter = $mainVisual.find(".main-visual-conuter");
	var mainVisualLength = $mainVisualItem.length;
	
	if ( detectBrowser () === "ie" ) {
		$(".main-visual-slider .overlay").remove();
	}

	var interleaveOffset = 0.75;
	var autoPlaySpeed = 4000;
	var swiperOptions = {
		loop: true,
		speed: 1200,
		parallax: false,
		draggable: false,
		autoplay: {
			delay: autoPlaySpeed,
			disableOnInteraction: false 
		},
		allowTouchMove:false,
		watchSlidesProgress: true,
		navigation: {
			nextEl: '.main-visual-slider .slide-next-btn',
			prevEl: '.main-visual-slider .slide-prev-btn'
		},
		on: {
			init : function  () {
				$mainCounter.find(".total-num").text(mainVisualLength);
			},
			progress: function () {
				var swiper = this;
				for (var i = 0; i < swiper.slides.length; i++) {
					var slideProgress = swiper.slides[i].progress;
					var innerOffset = swiper.width * interleaveOffset;
					var innerTranslate = slideProgress * innerOffset;
					/* swiper.slides[i].querySelector(".slide-inner").style.transform =
					"translate3d(" + innerTranslate + "px, 0, 0)"; */
					if ( detectBrowser () !== "ie" ) {
						TweenMax.set(swiper.slides[i].querySelector(".slide-inner"), {
							x: innerTranslate,
						});
					}
				} 
			},
			slideChange : function  () {
			},
			slideChangeTransitionStart : function(){
				var cur_idx = $(this.slides[this.activeIndex]).data("swiper-slide-index");
				
				// Zoom in
				$mainVisualImage = $(".swiper-slide-active").find(".visual-img");
				TweenMax.killTweensOf($mainVisualImage);
				TweenMax.fromTo($mainVisualImage, 2, { transform: "scale(1.4)" }, {transform: "scale(1) rotate(0.002deg)",force3D: true,ease: Circ.easeOut,delay: 0});
		
				// Counter
				$mainCounter.find(".cur-num").text(cur_idx+1);

				// Loading Motion
				TweenMax.killTweensOf($mainLoadingBar);
				TweenMax.set($mainLoadingBar, { height: "0%" });
				TweenMax.to($mainLoadingBar, autoPlaySpeed / 1000, { height: "100%" });

				// Text Motion
				$mainVisualText1 = $(".swiper-slide-active").find(".main-visual-tit span");
				$mainVisualText2 = $(".swiper-slide-active").find(".main-visual-txt span");
				$mainVisualButton = $(".swiper-slide-active").find(".main-visual-btn");
				TweenMax.fromTo($mainVisualText1, 1, {transform: "translateY(100%)",autoAlpha: 0}, {transform: "translateY(0%)",autoAlpha: 1,force3D: true,ease: Circ.easeOut,delay: 0.3});
				TweenMax.fromTo($mainVisualText2, 1, {transform: "translateY(100%)",autoAlpha: 0}, {transform: "translateY(0%)",autoAlpha: 1,force3D: true,ease: Circ.easeOut,delay: 0.7});
				TweenMax.fromTo($mainVisualButton, 0.5, {transform: "translateY(100%)",autoAlpha: 0}, {transform: "translateY(0%)",autoAlpha: 1,force3D: true,ease: Circ.easeOut,delay: 1});
			},
			touchStart: function () {
				var swiper = this;
				for (var i = 0; i < swiper.slides.length; i++) {
					swiper.slides[i].style.transition = "";
				}
			},
			setTransition: function (speed) {
				var swiper = this;
				if ( detectBrowser () !== "ie") {
					for (var i = 0; i < swiper.slides.length; i++) {
						swiper.slides[i].style.transition = speed + "ms";
						swiper.slides[i].querySelector(".slide-inner").style.transition =
						speed + "ms";
					}
				}
			}
		} 
	};

	var swiper = new Swiper(".swiper-container", swiperOptions);

	/* *********************** 메인 갤러리 슬라이드 ************************ */
	$('.main-prd-list').slick({
		slidesToShow: 4,
		slidesToScroll: 1,
		arrows: false,
		fade: false,
		dots:false,
		autoplay: true,
		speed:1000,
		infinite:true,
		autoplaySpeed: 3000,
		easing: 'easeInOutQuint',
		pauseOnHover:false,
		responsive: [
					{
					  breakpoint: 1025,
					  settings: {
						slidesToShow: 2,
						slidesToScroll: 1
					  }
					},
					{
					  breakpoint: 801,
					  settings: {
						slidesToShow: 1,
						slidesToScroll: 1
					  }
					}
				  ]
	});
});
