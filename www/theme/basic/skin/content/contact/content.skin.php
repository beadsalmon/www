<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$content_skin_url.'/style.css">', 0);
?>


<script language="JavaScript">
<!--
function fun_member(){
		var agreePrivacyChk=$("input:checkbox[name='agreePrivacy']").is(":checked");
		
		ms = eval('document.fregisterform');
		if( ms.nt_name.value == '' ) {
			alert("이름을 입력해 주세요.");
			ms.namet.focus();
			return false;
		}else if( ms.nt_tel1.value.length < 3 ) {
			alert("연락처를 입력해 주세요.");
			ms.nt_tel1.focus();
			return false;
		}else if( isNaN( ms.nt_tel1.value ) ) {
			alert("연락처는 숫자만 입력이 가능 합니다.");
			ms.nt_tel1.focus();
			return false;
		}else if( isNaN( ms.nt_tel2.value ) ) {
			alert("연락처는 숫자만 입력이 가능 합니다.");
			ms.nt_tel2.focus();
			return false;
		}else if( isNaN( ms.nt_tel3.value ) ) {
			alert("연락처는 숫자만 입력이 가능 합니다.");
			ms.nt_tel3.focus();
			return false;
		}else if(agreePrivacyChk==false){
				alert('개인정보 수집에 동의해주세요.');
				return false;
		}else {
			ms.submit();
		}
	}
//-->
</script>
<script type="text/javascript" src="/theme/basic/js/TweenMax.js"></script>
<script type="text/javascript" src="/theme/basic/js/main.js"></script>
<script type="text/javascript" src="/theme/basic/js/main_longrent.js"></script>

<div class="content">
    
    <div class="scene-1">
        <div class="cont_wrap">
            <div class="inner">
            
                <div class="main_txt">
                    <div>
                      <h1>CONTACT US</h1>
                      <p>제품관련해서 문의사항이 있다면 아래에 입력해서 보내주시면 바로 확인하여 답변드리겠습니다.</p>
                    </div>
                    
                    <div>
                      <ul>
                        <li>
                          <h3>Address</h3>
                          <p>서울특별시 성동구 자동차시장 1길 49 화성빌딩 3층 (04808)</p>
                        </li>
                        
                        <li>
                          <h3>TEL.</h3>
                          <p>02-2282-0301</p>
                        </li>
                        
                        <li>
                          <h3>FAX.</h3>
                          <p>02-2282-0301</p>
                        </li>
                        
                        <li>
                          <h3>E-mail</h3>
                          <p>inno@labinno.ai</p>
                        </li>
                      </ul>
                    </div>
                </div>
                
                <div class="sub_txt">
                    <div id="ctt_forms">
                      <form id="fregisterform" name="fregisterform" action="/form/form_update.php" onsubmit="return fun_member();" method="post" enctype="multipart/form-data">
              
                      <ul id="formsx">
                        <li>
                          <p>업체명</p>
                          <p><input type="text" name="nt_category" id="inputs" /></p>
                        </li>
                        
                        <li>
                          <p>성함</p>
                          <p><input type="text" name="nt_name" id="inputs" /></p>
                        </li>
                        
                        <li>
                          <p>연락처</p>
                          <p><input type="text" name="nt_tel1" id="inputx" /> - <input type="text" name="nt_tel2" id="inputx" /> - <input type="text" name="nt_tel3" id="inputx" /></p>
                        </li>
                        
                        <li>
                          <p>E-mail</p>
                          <p><input type="text" name="nt_email" id="inputs" /></p>
                        </li>
                        
                        <li id="tarea">
                          <p>문의내용</p>
                          <p><textarea name="nt_memo"></textarea></p>
                        </li>
                      </ul>
                      
                      <!-- 개인정보 수집 / 이용 동의 -->
                      <div class="agree">
                        <label for="agreePrivacy" class="cklabel ck_mail" style="cursor:pointer;">
                            [필수] 개인정보 수집 / 이용 동의
                            <input type="checkbox" id="agreePrivacy" name="agreePrivacy" value="T" class="ckbox ck_mail checkConsult" />
                        </label>
                      </div>
                      <!-- 개인정보 수집 / 이용 동의 -->
                      
                      <div class="btn_confirm"><a href="#" onclick="fun_member();">문의하기</a></div>
                      
                      </form>
                  </div>
                </div>
                
                    
            </div>
        </div>
                        
        <div class="number_case">
            <div class="inner"></div>
        </div>

    </div>
    

</div>

