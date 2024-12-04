<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

include_once(G5_PLUGIN_PATH.'/jquery-ui/datepicker.php');

if (empty($fr_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $fr_date) ) $fr_date = G5_TIME_YMD;
if (empty($to_date) || ! preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $to_date) ) $to_date = G5_TIME_YMD;

$qstr = "fr_date=".$fr_date."&amp;to_date=".$to_date;
$query_string = $qstr ? '?'.$qstr : '';


?>

<section id="bo_w">
    <h2 class="sound_only"><?php echo $g5['title'] ?></h2>

    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) { 
        $option = '';
        if ($is_notice) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="notice" name="notice"  class="selec_chk" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice"><span></span>공지</label></li>';
        }
        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" class="selec_chk" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html"><span></span>html</label></li>';
            }
        }
        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="secret" name="secret"  class="selec_chk" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret"><span></span>비밀글</label></li>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }
        if ($is_mail) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="mail" name="mail"  class="selec_chk" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail"><span></span>답변메일받기</label></li>';
        }
    }
    echo $option_hidden;
    ?>

    <?php if ($is_category) { ?>
    <div class="bo_w_select write_div">
        <label for="ca_name" class="sound_only">분류<strong>필수</strong></label>
        <select name="ca_name" id="ca_name" required>
            <option value="">분류를 선택하세요</option>
            <?php echo $category_option ?>
        </select>
    </div>
    <?php } ?>

    <div class="bo_w_info write_div">
	    <?php if ($is_name) { ?>
	        <label for="wr_name" class="sound_only">이름<strong>필수</strong></label>
	        <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input half_input required" placeholder="이름">
	    <?php } ?>
	
	    <?php if ($is_password) { ?>
	        <label for="wr_password" class="sound_only">비밀번호<strong>필수</strong></label>
	        <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input half_input <?php echo $password_required ?>" placeholder="비밀번호">
	    <?php } ?>
	</div>
    
	<!--
    <?php if ($option) { ?>
    <div class="write_div">
        <span class="sound_only">옵션</span>
        <ul class="bo_v_option">
        <?php echo $option ?>
        </ul>
    </div>
    <?php } ?>
    -->

    <div class="bo_w_infox write_div">
      <ul>
        <li>
        <label for="wr_subject">제목</label>
        <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="frm_input full_input required" size="50" maxlength="255" placeholder="제목">
        <p> </p>
        </li>
        
        <li>
        <label for="wr_1">대회요강</label>
        <input type="text" name="wr_1" value="<?php echo $write['wr_1'] ?>" id="wr_1" required class="frm_input full_input required" size="50" maxlength="255" placeholder="간단설명">
        <p> </p>
        </li>
    
        <li>
        <label for="wr_2">부서</label>
        <input type="text" name="wr_2" value="<?php echo $write['wr_2'] ?>" id="wr_2" required class="frm_input full_input required" size="50" maxlength="255" placeholder="부서">
        <p>부서별로 ","를 통해 분류할 수 있습니다.</p>
        </li>
      </ul>
    </div>
    
    <style>
	.bo_w_infox ul { display:flex; }
	.bo_w_infox ul li { width:calc(33.3333% - 20px); margin-right:20px; }
	.bo_w_infox ul li:last-child { width:33.3333%; margin:0px; }
	.bo_w_infox ul li label { display:block; font-weight:bolder; margin-bottom:2px; font-size:15px; color:#666; }
	.bo_w_infox ul li p { color:#666; }
	.bo_w_date ul { display:flex; }
	.bo_w_date ul li { width:calc(50% - 50px); margin-right:50px; }
	.bo_w_date ul li:last-child { width:50%; margin:0px; }
	.bo_w_date ul li label { display:block; font-weight:bolder; margin-bottom:2px; font-size:15px; color:#666; }
	.bo_w_date ul li p { color:#666; }
	.shalf_input { width:calc(33.3333% - 9px); }
	.fours_input { width:calc(25% - 9px); }
	</style>
    
    <?php
	$wr_3a = substr($write['wr_3'], 0, 10);
	$wr_3s = substr($write['wr_3'], 11, 16);
	$wr_4a = substr($write['wr_4'], 0, 10);
	$wr_4s = substr($write['wr_4'], 11, 16);
	$wr_6a = substr($write['wr_6'], 0, 10);
	$wr_6s = substr($write['wr_6'], 11, 16);
	$wr_7a = substr($write['wr_7'], 0, 10);
	$wr_7s = substr($write['wr_7'], 11, 16);
	?>
    
    <div class="bo_w_date write_div">
      <ul>
        <li>
            <label for="wr_2">대회신청기간</label>
            <p>
            <input type="text" name="wr_3a" value="<?php echo $wr_3a; ?>" id="wr_3a" class="frm_input fours_input" size="11" maxlength="10" readonly placeholder="대회 접수시작일">
            <select class="frm_input fours_input" name="wr_3s" id="wr_3s">
              <option value="06:00" <?php if($wr_3s == "06:00"){ echo "selected"; } ?>>AM 06:00</option>
              <option value="07:00" <?php if($wr_3s == "07:00"){ echo "selected"; } ?>>AM 07:00</option>
              <option value="08:00" <?php if($wr_3s == "08:00"){ echo "selected"; } ?>>AM 08:00</option>
              <option value="09:00" <?php if($wr_3s == "09:00"){ echo "selected"; } ?>>AM 09:00</option>
              <option value="10:00" <?php if($wr_3s == "10:00"){ echo "selected"; } ?>>AM 10:00</option>
              <option value="11:00" <?php if($wr_3s == "11:00"){ echo "selected"; } ?>>AM 11:00</option>
              <option value="12:00" <?php if($wr_3s == "12:00"){ echo "selected"; } ?>>AM 12:00</option>
              <option value="13:00" <?php if($wr_3s == "13:00"){ echo "selected"; } ?>>PM 13:00</option>
              <option value="14:00" <?php if($wr_3s == "14:00"){ echo "selected"; } ?>>PM 14:00</option>
              <option value="15:00" <?php if($wr_3s == "15:00"){ echo "selected"; } ?>>PM 15:00</option>
              <option value="16:00" <?php if($wr_3s == "16:00"){ echo "selected"; } ?>>PM 16:00</option>
              <option value="17:00" <?php if($wr_3s == "17:00"){ echo "selected"; } ?>>PM 17:00</option>
              <option value="18:00" <?php if($wr_3s == "18:00"){ echo "selected"; } ?>>PM 18:00</option>
              <option value="19:00" <?php if($wr_3s == "19:00"){ echo "selected"; } ?>>PM 19:00</option>
              <option value="20:00" <?php if($wr_3s == "20:00"){ echo "selected"; } ?>>PM 20:00</option>
              <option value="21:00" <?php if($wr_3s == "21:00"){ echo "selected"; } ?>>PM 21:00</option>
              <option value="22:00" <?php if($wr_3s == "22:00"){ echo "selected"; } ?>>PM 22:00</option>
              <option value="23:00" <?php if($wr_3s == "23:00"){ echo "selected"; } ?>>PM 23:00</option>
              <option value="24:00" <?php if($wr_3s == "24:00"){ echo "selected"; } ?>>PM 24:00</option>
            </select>
            ~
            <input type="text" name="wr_4a" value="<?php echo $wr_4a; ?>" id="wr_4a" class="frm_input fours_input" size="11" maxlength="10" readonly placeholder="대회 접수마지막일">
            <select class="frm_input fours_input" name="wr_4s" id="wr_4s">
              <option value="06:00" <?php if($wr_4s == "06:00"){ echo "selected"; } ?>>AM 06:00</option>
              <option value="07:00" <?php if($wr_4s == "07:00"){ echo "selected"; } ?>>AM 07:00</option>
              <option value="08:00" <?php if($wr_4s == "08:00"){ echo "selected"; } ?>>AM 08:00</option>
              <option value="09:00" <?php if($wr_4s == "09:00"){ echo "selected"; } ?>>AM 09:00</option>
              <option value="10:00" <?php if($wr_4s == "10:00"){ echo "selected"; } ?>>AM 10:00</option>
              <option value="11:00" <?php if($wr_4s == "11:00"){ echo "selected"; } ?>>AM 11:00</option>
              <option value="12:00" <?php if($wr_4s == "12:00"){ echo "selected"; } ?>>AM 12:00</option>
              <option value="13:00" <?php if($wr_4s == "13:00"){ echo "selected"; } ?>>PM 13:00</option>
              <option value="14:00" <?php if($wr_4s == "14:00"){ echo "selected"; } ?>>PM 14:00</option>
              <option value="15:00" <?php if($wr_4s == "15:00"){ echo "selected"; } ?>>PM 15:00</option>
              <option value="16:00" <?php if($wr_4s == "16:00"){ echo "selected"; } ?>>PM 16:00</option>
              <option value="17:00" <?php if($wr_4s == "17:00"){ echo "selected"; } ?>>PM 17:00</option>
              <option value="18:00" <?php if($wr_4s == "18:00"){ echo "selected"; } ?>>PM 18:00</option>
              <option value="19:00" <?php if($wr_4s == "19:00"){ echo "selected"; } ?>>PM 19:00</option>
              <option value="20:00" <?php if($wr_4s == "20:00"){ echo "selected"; } ?>>PM 20:00</option>
              <option value="21:00" <?php if($wr_4s == "21:00"){ echo "selected"; } ?>>PM 21:00</option>
              <option value="22:00" <?php if($wr_4s == "22:00"){ echo "selected"; } ?>>PM 22:00</option>
              <option value="23:00" <?php if($wr_4s == "23:00"){ echo "selected"; } ?>>PM 23:00</option>
              <option value="24:00" <?php if($wr_4s == "24:00"){ echo "selected"; } ?>>PM 24:00</option>
            </select>
            </p>
        </li>
        
        <li>
            <label for="wr_tit">대회기간</label>
            <p>
            <input type="text" name="wr_6a" value="<?php echo $wr_6a; ?>" id="wr_6a" class="frm_input fours_input" size="11" maxlength="10" readonly placeholder="대회 시작일">
            <select class="frm_input fours_input" name="wr_6s" id="wr_6s">
              <option value="06:00" <?php if($wr_6s == "06:00"){ echo "selected"; } ?>>AM 06:00</option>
              <option value="07:00" <?php if($wr_6s == "07:00"){ echo "selected"; } ?>>AM 07:00</option>
              <option value="08:00" <?php if($wr_6s == "08:00"){ echo "selected"; } ?>>AM 08:00</option>
              <option value="09:00" <?php if($wr_6s == "09:00"){ echo "selected"; } ?>>AM 09:00</option>
              <option value="10:00" <?php if($wr_6s == "10:00"){ echo "selected"; } ?>>AM 10:00</option>
              <option value="11:00" <?php if($wr_6s == "11:00"){ echo "selected"; } ?>>AM 11:00</option>
              <option value="12:00" <?php if($wr_6s == "12:00"){ echo "selected"; } ?>>AM 12:00</option>
              <option value="13:00" <?php if($wr_6s == "13:00"){ echo "selected"; } ?>>PM 13:00</option>
              <option value="14:00" <?php if($wr_6s == "14:00"){ echo "selected"; } ?>>PM 14:00</option>
              <option value="15:00" <?php if($wr_6s == "15:00"){ echo "selected"; } ?>>PM 15:00</option>
              <option value="16:00" <?php if($wr_6s == "16:00"){ echo "selected"; } ?>>PM 16:00</option>
              <option value="17:00" <?php if($wr_6s == "17:00"){ echo "selected"; } ?>>PM 17:00</option>
              <option value="18:00" <?php if($wr_6s == "18:00"){ echo "selected"; } ?>>PM 18:00</option>
              <option value="19:00" <?php if($wr_6s == "19:00"){ echo "selected"; } ?>>PM 19:00</option>
              <option value="20:00" <?php if($wr_6s == "20:00"){ echo "selected"; } ?>>PM 20:00</option>
              <option value="21:00" <?php if($wr_6s == "21:00"){ echo "selected"; } ?>>PM 21:00</option>
              <option value="22:00" <?php if($wr_6s == "22:00"){ echo "selected"; } ?>>PM 22:00</option>
              <option value="23:00" <?php if($wr_6s == "23:00"){ echo "selected"; } ?>>PM 23:00</option>
              <option value="24:00" <?php if($wr_6s == "24:00"){ echo "selected"; } ?>>PM 24:00</option>
            </select>
            ~
            <input type="text" name="wr_7a" value="<?php echo $wr_7a; ?>" id="wr_7a" class="frm_input fours_input" size="11" maxlength="10" readonly placeholder="대회 종료일">
            <select class="frm_input fours_input" name="wr_7s" id="wr_7s">
              <option value="06:00" <?php if($wr_7s == "06:00"){ echo "selected"; } ?>>AM 06:00</option>
              <option value="07:00" <?php if($wr_7s == "07:00"){ echo "selected"; } ?>>AM 07:00</option>
              <option value="08:00" <?php if($wr_7s == "08:00"){ echo "selected"; } ?>>AM 08:00</option>
              <option value="09:00" <?php if($wr_7s == "09:00"){ echo "selected"; } ?>>AM 09:00</option>
              <option value="10:00" <?php if($wr_7s == "10:00"){ echo "selected"; } ?>>AM 10:00</option>
              <option value="11:00" <?php if($wr_7s == "11:00"){ echo "selected"; } ?>>AM 11:00</option>
              <option value="12:00" <?php if($wr_7s == "12:00"){ echo "selected"; } ?>>AM 12:00</option>
              <option value="13:00" <?php if($wr_7s == "13:00"){ echo "selected"; } ?>>PM 13:00</option>
              <option value="14:00" <?php if($wr_7s == "14:00"){ echo "selected"; } ?>>PM 14:00</option>
              <option value="15:00" <?php if($wr_7s == "15:00"){ echo "selected"; } ?>>PM 15:00</option>
              <option value="16:00" <?php if($wr_7s == "16:00"){ echo "selected"; } ?>>PM 16:00</option>
              <option value="17:00" <?php if($wr_7s == "17:00"){ echo "selected"; } ?>>PM 17:00</option>
              <option value="18:00" <?php if($wr_7s == "18:00"){ echo "selected"; } ?>>PM 18:00</option>
              <option value="19:00" <?php if($wr_7s == "19:00"){ echo "selected"; } ?>>PM 19:00</option>
              <option value="20:00" <?php if($wr_7s == "20:00"){ echo "selected"; } ?>>PM 20:00</option>
              <option value="21:00" <?php if($wr_7s == "21:00"){ echo "selected"; } ?>>PM 21:00</option>
              <option value="22:00" <?php if($wr_7s == "22:00"){ echo "selected"; } ?>>PM 22:00</option>
              <option value="23:00" <?php if($wr_7s == "23:00"){ echo "selected"; } ?>>PM 23:00</option>
              <option value="24:00" <?php if($wr_7s == "24:00"){ echo "selected"; } ?>>PM 24:00</option>
            </select>
            </p>
        </li>
      </ul>
    </div>
    
    
    <br /><br /><br />
    
    
    <div class="bo_w_infox write_div">
      <ul>
        <li>
        <label for="wr_9">코트명</label>
        <input type="text" name="wr_9" value="<?php echo $write['wr_9'] ?>" id="wr_9" required class="frm_input full_input required" size="50" maxlength="255" placeholder="코트명">
        </li>
    
        <li>
        <label for="wr_10">세부코트</label>
        <input type="text" name="wr_10" value="<?php echo $write['wr_10'] ?>" id="wr_10" required class="frm_input full_input required" size="50" maxlength="255" placeholder="세부코트">
        </li>
      </ul>
    </div>
    

    <div class="write_div">
        <label for="wr_content" class="sound_only">내용<strong>필수</strong></label>
        <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?>">
            <?php if($write_min || $write_max) { ?>
            <!-- 최소/최대 글자 수 사용 시 -->
            <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
            <?php } ?>
            <?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
            <?php if($write_min || $write_max) { ?>
            <!-- 최소/최대 글자 수 사용 시 -->
            <div id="char_count_wrap"><span id="char_count"></span>글자</div>
            <?php } ?>
        </div>
        
    </div>

    <?php for ($i=1; $is_link && $i<=G5_LINK_COUNT; $i++) { ?>
    <div class="bo_w_link write_div">
        <label for="wr_link<?php echo $i ?>"><i class="fa fa-link" aria-hidden="true"></i><span class="sound_only"> 링크  #<?php echo $i ?></span></label>
        <input type="text" name="wr_link<?php echo $i ?>" value="<?php if($w=="u"){echo$write['wr_link'.$i];} ?>" id="wr_link<?php echo $i ?>" class="frm_input full_input" size="50">
    </div>
    <?php } ?>

    <?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
    <div class="bo_w_flie write_div">
        <div class="file_wr write_div">
            <label for="bf_file_<?php echo $i+1 ?>" class="lb_icon"><i class="fa fa-folder-open" aria-hidden="true"></i><span class="sound_only"> 파일 #<?php echo $i+1 ?></span></label>
            <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" class="frm_file ">
        </div>
        <?php if ($is_file_content) { ?>
        <input type="text" name="bf_content[]" value="<?php echo ($w == 'u') ? $file[$i]['bf_content'] : ''; ?>" title="파일 설명을 입력해주세요." class="full_input frm_input" size="50" placeholder="파일 설명을 입력해주세요.">
        <?php } ?>

        <?php if($w == 'u' && $file[$i]['file']) { ?>
        <span class="file_del">
            <input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')';  ?> 파일 삭제</label>
        </span>
        <?php } ?>
        
    </div>
    <?php } ?>


    <?php if ($is_use_captcha) { //자동등록방지  ?>
    <div class="write_div">
        <?php echo $captcha_html ?>
    </div>
    <?php } ?>

    <div class="btn_confirm write_div">
        <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn_cancel btn">취소</a>
        <button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn">작성완료</button>
    </div>
    </form>

    <script>
	$(function(){
		$("#wr_3a, #wr_4a").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", minDate: "+0d" });
		$("#wr_6a, #wr_7a").datepicker({ changeMonth: true, changeYear: true, dateFormat: "yy-mm-dd", showButtonPanel: true, yearRange: "c-99:c+99", minDate: "+0d" });
	});

    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });
    });

    <?php } ?>
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->