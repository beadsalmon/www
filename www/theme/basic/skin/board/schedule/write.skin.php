<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<script>
var g5_bbs_skin_url = "<?php echo $board_skin_url; ?>";
</script>
<script src="<?php echo $board_skin_url; ?>/script.js"></script>
<link rel="stylesheet" href="<?php echo $board_skin_url; ?>/style.css">
<form id="mara_write" name="fwrite" method="post" action="<?php echo G5_BBS_URL; ?>/write_update.php" enctype="multipart/form-data" onsubmit="return checkWrite(this);" style="width:<?php echo $width; ?>;">
    <input type="hidden" name="wr_subject" value="tmp_text">
    <input type="hidden" name="w" value="<?php echo $w; ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table; ?>">

    <h2 class="guide"><span></span>이용안내</h2>
    <ol class="explain">
        <li>인터넷예약이 가능한 기간은 <strong><?php echo $date['min']; ?>부터 <?php echo $date['max']; ?>까지</strong>이며, 그 외의 기간은 전화로 문의해주세요.</li>
        <li>1회 예약시 숙박이 가능한 기간은 <strong>최대 <?php echo $board['bo_5']; ?>박 <?php echo $board['bo_5'] + 1; ?>일</strong>이며, 그 이상의 기간은 전화로 문의해주세요.</li>
        <li>선택한 숙박일자에 이용할 수 없는 객실은 선택할 수 없거나 숙박기간이 조정되어 보여질 수 있습니다.</li>
        <li>예약신청이 완료된 후 <strong><?php echo $board['bo_6']; ?>일 이내에 입금</strong>이 확인되지 않으면 별도의 확인절차없이 예약은 취소됩니다.</li>
        <li>무통장입금 계좌번호안내 : <?php echo $board['bo_10']; ?></li>
        <li>모든룸은 2인 기준인원입니다.(샤프란룸, 라일락룸 제외)</li>
    </ol>

    <h2 class="rm_select"><span></span>객실선택</h2>
    <p class="select">
        <span class="sound_only">날짜를 변경하시면 입력한 내용이 초기화 됩니다.</span>
        <label for="if_day" class="sound_only">날짜</label>
        <select name="select" id="if_day" class="day_select"><?php echo optionDate($select); ?></select>
    </p>
    <table class="mara_rw">
    <caption>객실 선택</caption>
    <colgroup>
        <col class="rm_grid_5"><!-- 25% -->
        <col class="rm_grid_2"><!-- 10% -->
        <col class="rm_grid_3"><!-- 15% -->
        <col>
        <col class="rm_grid_2"><!-- 10% -->
        <col class="rm_grid_2"><!-- 10% -->
    </colgroup>
    <thead>
    <tr>
        <th scope="col">객실정보</th>
        <th scope="col">기준/최대</th>
        <th scope="col">숙박일자</th>
        <th scope="col">숙박기간/인원</th>
        <th scope="col">이용금액</th>
        <th scope="col">선택</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="4">총 결제금액</td>
        <td class="red" colspan="2"><span id="total">0</span>원</td>
    </tr>
    </tfoot>
    <tbody>
    <?php for($i = 0;$i < $max; $i++){ ?>
    <tr>
        <td class="left">
            <input type="hidden" name="use[<?php echo $ROOM[$i]['wr_id']; ?>]" value="<?php echo $ROOM[$i]['disabled']; ?>">
            <a href="#none" onclick="window.open('<?php echo $ROOM[$i]['link']; ?>');"><img src="<?php echo $board_skin_url; ?>/img/b_room.gif" alt="상세정보"></a>
            [<?php if($ROOM[$i]['ca_name']){ echo $ROOM[$i]['ca_name']; } ?> <?php echo $ROOM[$i]['wr_subject']; ?>
        </td>
        <td><?php echo $ROOM[$i]['wr_2']; ?>명/<?php echo $ROOM[$i]['wr_3']; ?>명</td>
        <td><?php echo $select; ?></td>
        <td>
            <p>
            <label for="if_stay[<?php echo $ROOM[$i]['wr_id']; ?>]" class="sound_only">숙박기간</label>
            <select name="stay[<?php echo $ROOM[$i]['wr_id']; ?>]" id="if_stay[<?php echo $ROOM[$i]['wr_id']; ?>]" onchange="checkPrice('<?php echo $ROOM[$i]['wr_id']; ?>');" <?php echo $ROOM[$i]['disabled']; ?>>
                <?php optionStay($ROOM[$i]['stay']); ?>
            </select>
            </p>
            <p>
            <label for="if_person[<?php echo $ROOM[$i]['wr_id']; ?>]" class="sound_only">인원선택</label>
            <select name="person[<?php echo $ROOM[$i]['wr_id']; ?>]" id="if_person[<?php echo $ROOM[$i]['wr_id']; ?>]" onchange="checkPrice('<?php echo $ROOM[$i]['wr_id']; ?>');" <?php echo $ROOM[$i]['disabled']; ?>>
                <?php optionPerson($ROOM[$i]['wr_2'], $ROOM[$i]['wr_3']); ?>
            </select>
            </p>
        </td>
        <td><span id="price[<?php echo $ROOM[$i]['wr_id']; ?>]"><?php echo number_format($ROOM[$i]['price']); ?></span>원</td>
        <td>
            <?php if(isset($ROOM[$i]['inquiry']) == true){ ?>
            <a href="<?php echo $ROOM[$i]['inquiry']; ?>"><img src="<?php echo $board_skin_url; ?>/img/b_inquiry.gif" alt="예약확인"></a>
            <?php } else{ ?>
            <input type="checkbox" name="room[]" value="<?php echo $ROOM[$i]['wr_id']; ?>" onclick="checkTotal();" <?php echo $ROOM[$i]['disabled']; ?>>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>

    <h2 class="info"><span></span>예약자정보</h2>
    <table class="mara_info" style="width:100%;">
    <caption>예약자정보 입력</caption>
    <colgroup>
        <col width="150">
        <col>
    </colgroup>
    <tbody>
    <tr>
        <th scope="row"><label for="if_name">이름</label></th>
        <td><input type="text" name="wr_name" id="if_name" value="" required></td>
    </tr>
    <tr>
        <th scope="row"><label for="if_pw">비밀번호</label></th>
        <td><input type="password" id="if_pw" name="wr_password" value="" <?php echo $password_required; ?>></td>
    </tr>
    <tr>
        <th scope="row"><label for="if_phone" class="frm_essential">연락처</label></th>
        <td>
            <span class="frm_info">(반드시 010-3456-7890과 같은 형식으로 입력해주세요)</span>
            <input type="text" name="wr_homepage" value="<?php echo $homepage; ?>" id="if_phone" class="required" required>
        </td>
    </tr>
    <tr>
        <th scope="row"><label for="if_memo" class="frm_essential">메모</label></th>
        <td><textarea name="wr_content" id="if_memo" class="required" cols="10" rows="5"><?php echo $content; ?></textarea></td>
    </tr>
    </tbody>
    </table>
    <?php if($guide){ ?>

    <h2 class="important"><span></span>준수사항</h2>
    <p class="explain"><?php echo get_text($guide, 1); ?></p>
    <?php } ?>
    <div class="mara_btn_area">
        <input type="image" src="<?php echo $board_skin_url; ?>/img/b_write.gif" alt="예약하기">
        <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>&amp;select=<?php echo $select; ?>"><?php echo $BUTTON; ?></a>
    </div>
</form>

<script>
$(document).ready(function(){
    var day_trigger = $(".day_select");
    day_trigger.each(function(){
        var currentVal = $(this).val();
        day_trigger.change(function(){
            var day_selVal = $(this).val();
            if (! confirm("날짜를 변경하시면 입력한 내용이 초기화 됩니다. 변경하시겠습니까?")) {
                $(".day_select").val(currentVal);
            }
            else{
                location.replace('<?php echo G5_BBS_URL; ?>/write.php?bo_table=<?php echo $bo_table; ?>&select='+day_selVal);
            }
        });
    });
});
</script>