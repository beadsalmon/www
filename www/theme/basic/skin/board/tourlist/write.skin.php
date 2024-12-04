<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


$result = " SELECT * FROM g5_write_tournament WHERE wr_id = $wr_no ";
$row = sql_fetch($result);

$categories = explode("/", $row['wr_1']);
for ($i=0; $i<count($categories); $i++) {
	$category = trim($categories[$i]);
	if (!$category) continue;

	$str .= "<option value=\"$categories[$i]\"";
	if ($category == $ca_name) {
		$str .= ' selected="selected"';
	}
	$str .= ">$categories[$i]</option>\n";
}

?>

<style>
#wrapper_title { display:none; }
#bo_w > h2 {  font-size:32px; color:#333; font-family:'GS_B'; margin-top:80px; text-align:center; margin-bottom:25px; }

.bo_title { background-color:#09c; color:#fff; text-align:center; padding:10px; font-size:24px; font-family:'GS_M'; }
.bo_w_info { border:1px solid #ddd; box-shadow:0 0 10px rgba(0,0,0,0.1); margin:5px 0; }
.bo_w_info h2 { padding:15px; border-bottom:1px solid #eee; background-color:#f6f6f6; }
.bo_w_info ul { padding:20px; display:grid; grid-template-columns:repeat(2, 1fr); column-gap:14px; row-gap:14px; }
.bo_w_info ul li { display:flex; }
.bo_w_info ul li label { width:100px; height:40px; line-height:40px; }
.bo_w_info ul li span { width:calc(100% - 100px); }
.bo_w_info ul li span font { display:inline-block; vertical-align:top; height:40px; line-height:40px; }
.bo_w_info ul li .third_input { width:calc(33.3333% - 14px); }
</style>

<section id="bo_w">
    <h2>참가신청서 작성</h2>

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
    <input type="hidden" name="wr_subject" value="<?php echo $subject ?>">
    <input type="hidden" name="wr_content" value="<?php echo $subject ?>">
    
    <div class="bo_title"><?php echo $row['wr_subject'] ?></div>
    <div class="bo_w_info">
      <ul>
        <li>
        <label for="ca_name">출전부서</label>
        <span>
        <select name="ca_name" class="frm_input full_input" required>
            <option value="">부서를 선택하세요</option>
            <?php echo $str ?>
        </select>
        </span>
        </li>
      </ul>
    </div>

    <div class="bo_w_info">
      <h2>참가자 정보</h2>
      <ul>
        <li>
        <label for="wr_name">이름</label>
        <span><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input full_input required" placeholder="이름을 입력하세요."></span>
        </li>
        <li>
        <label for="wr_homepage">휴대폰번호</label>
	    <span>
        <select class="frm_input third_input">
          <option>010</option>
          <option>011</option>
          <option>016</option>
          <option>017</option>
          <option>018</option>
          <option>019</option>
        </select> <font>-</font>
        <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input third_input"> <font>-</font> 
        <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input third_input">
        </span>
        </li>
        
        <li>
	    <label for="wr_email">기본클럽</label>
		<span><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input full_input" placeholder="기본소속명을 입력(1개 클럽)"></span>
	    </li>
        <li>
	    <label for="wr_homepage">기타클럽</label>
	    <span><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_1" class="frm_input full_input" placeholder="기타소속명을 입력(1개 클럽)"></span>
        </li>
      </ul>
	</div>
    
    <div class="bo_w_info">
      <h2>파트너 정보</h2>
      <ul>
        <li>
        <label for="wr_name">이름</label>
        <span><input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input full_input required" placeholder="이름을 입력하세요."></span>
        </li>
        <li>
        <label for="wr_homepage">휴대폰번호</label>
	    <span>
        <select class="frm_input third_input">
          <option>010</option>
          <option>011</option>
          <option>016</option>
          <option>017</option>
          <option>018</option>
          <option>019</option>
        </select> <font>-</font>
        <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input third_input"> <font>-</font> 
        <input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_homepage" class="frm_input third_input">
        </span>
        </li>
        
        <li>
	    <label for="wr_email">기본클럽</label>
		<span><input type="text" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input full_input" placeholder="기본소속명을 입력(1개 클럽)"></span>
	    </li>
        <li>
	    <label for="wr_homepage">기타클럽</label>
	    <span><input type="text" name="wr_homepage" value="<?php echo $homepage ?>" id="wr_1" class="frm_input full_input" placeholder="기타소속명을 입력(1개 클럽)"></span>
        </li>
      </ul>
	</div>

    <div class="btn_confirm write_div">
        <a href="<?php echo get_pretty_url($bo_table); ?>" class="btn_cancel btn">취소</a>
        <button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn">신청완료</button>
    </div>
    </form>

    <script>
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