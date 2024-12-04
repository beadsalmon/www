<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 프로그램 연산에 필요한 선행함수를 실행한다
include_once($board_skin_path . '/skin.function.php');
?>

<script src="<?php echo $board_skin_url; ?>/script.js"></script>
<link rel="stylesheet" href="<?php echo $board_skin_url; ?>/style.css">
<div id="mara_view" style="width:<?php echo $width; ?>;">
    <h2 class="status"><span></span>예약내역</h2>
    <table>
    <caption>객실예약내역</caption>
    <colgroup>
        <col class="rm_grid_4"><!-- 20% -->
        <col class="rm_grid_6"><!-- 30% -->
        <col class="rm_grid_4"><!-- 20% -->
        <col class="rm_grid_6"><!-- 30% -->
    </colgroup>
    <tbody>
    <tr>
        <th scope="row">객실이름</th>
        <td><?php echo cut_hangul_last(get_text($view[wr_subject])); ?></td>
        <th scope="row">예약일자</th>
        <td><?php echo $view['wr_datetime']; ?></td>
    </tr>
    <tr>
        <th scope="row">예약자이름</th>
        <td><strong><?php echo $view['name']; ?></strong></td>
        <th scope="row">예약자연락처</th>
        <td><?php echo $view['wr_homepage']; ?></td>
    </tr>
    <tr>
        <th scope="row">숙박일자</th>
        <td><?php echo $view['wr_1']; ?> ~ <?php echo $view['wr_2']; ?></td>
        <th scope="row">숙박기간/인원</th>
        <td><?php echo $view['wr_3']; ?>박 <?php echo $view['wr_3'] + 1; ?>일 / <?php echo $view['wr_4']; ?>명</td>
    </tr>
    <tr>
        <th scope="row">이용금액</th>
        <td><strong class="red"><?php echo number_format($view['wr_6']); ?>원</strong></td>
        <th scope="row">현재상태</th>
        <td><?php if($view['wr_7'] == 'T'){ echo '예약완료'; } else{ echo '예약접수'; }?></td>
    </tr>
    <tr>
        <th scope="row">메모</th>
        <td colspan="3"><?php echo $view['content']; ?></td>
    </tr>
    </tbody>
    </table>

    <h2 class="guide"><span></span>이용안내</h2>
    <ol class="explain">
        <li>예약신청이 완료된 후 <span><?php echo $board['bo_6']; ?>일 이내에 입금</span>이 확인되지 않으면 별도의 확인절차없이 예약은 취소됩니다.</li>
        <li>입금 이전에 예약내용을 수정하시려면 기존의 예약을 취소하고 다시 예약해주시기 바랍니다.<br>(한번에 여러개의 객실을 예약하였을 경우 객실마다 취소를 해야하며 일부 객실만 취소할 수도 있습니다)</li>
        <li>입금 이후에 예약내용을 수정하시거나 취소하시려면 전화로 문의해주세요.</li>
        <li>무통장입금 계좌번호안내 : <?php echo $board['bo_10']; ?></li>
        <li>모든룸은 2인 기준인원입니다.(샤프란룸, 라일락룸 제외)</li>
    </ol>
    <div class="mara_btn_area">
        <?php if($is_admin){ ?>
        <a href="#none" onclick="checkFinish('<?php echo $view['wr_7']; ?>', '<?php echo "{$board_skin_url}/finish.control.php?bo_table={$bo_table}&amp;wr_id={$wr_id}&amp;page={$page}"; ?>');" >
            <img src="<?php echo $board_skin_url; ?>/img/b_finish.gif" alt="예약완료">
        </a>
        <a href="<?php echo $delete_href; ?>"><img src="<?php echo $board_skin_url; ?>/img/b_delete.gif" alt="예약취소"></a>
        <a href="<?php echo $copy_href; ?>"><img src="<?php echo $board_skin_url; ?>/img/b_copy.gif" alt="복사하기"></a>
        <a href="<?php echo $move_href; ?>"><img src="<?php echo $board_skin_url; ?>/img/b_move.gif" alt="이동하기"></a>
        <a href="<?php echo $list_href; ?>"><?php echo $BUTTON; ?></a>
        <?php } else{ ?>
        <a href="<?php echo $write_href; ?>"><img src="<?php echo $board_skin_url; ?>/img/b_write.gif" alt="예약하기"></a>
        <?php if($view['wr_7'] == 'T'){ echo "<a href=\"#none\" onclick=\"window.alert('입금 이후에 예약내용을 취소하시려면 전화로 문의해주세요.');\">"; } else { echo "<a href=\"{$delete_href}\" onfocus=\"this.blur();\">"; }?><img src="<?php echo $board_skin_url; ?>/img/b_delete.gif" alt="예약취소"></a>
        <a href="<?php echo $list_href; ?>&select=<?php echo $select; ?>"><?php echo $BUTTON; ?></a>
        <?php } ?>
    </div>
</div>