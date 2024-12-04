<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$select = G5_TIME_YMD;
list($year, $month, $date) = explode('-', $select);
$start = '01';
$end = date('t', strtotime($select . ' 00:00:00'));


$sqls = " SELECT * FROM g5_write_tournament WHERE ((wr_3 >= '{$year}-{$month}-{$start}') AND (wr_4 >= '{$year}-{$month}-{$start}')) ";
$results = sql_query($sqls);

?>

<style>
#wrapper_title { display:none; }
#bo_list > h2 {  font-size:32px; color:#333; font-family:'GS_B'; margin-top:80px; text-align:center; margin-bottom:25px; }
#bo_list .bo_list_box {}
#bo_list .bo_list_box ul {}
#bo_list .bo_list_box ul li { padding:0; border:1px solid #ddd; border-left:3px solid #09C; box-shadow:0 0 10px rgba(0,0,0,0.1); margin:5px 0; display:flex; }
#bo_list .bo_list_box ul li .bo_tits { width:300px; font-size:21px; color:#333; font-family:'GS_M'; height:60px; line-height:60px; text-align:center; }
#bo_list .bo_list_box ul li .bo_date { width:calc(100% - 750px); height:60px; line-height:60px; font-size:14px; border-left:1px solid #ddd; border-right:1px solid #ddd; text-align:center; }
#bo_list .bo_list_box ul li .bo_btns { width:450px; line-height:60px; text-align:center; }
#bo_list .bo_list_box ul li .bo_btns a { display:inline-block; vertical-align:middle; background-color:#09C; color:#fff; width:90px; height:30px; line-height:30px; text-align:center; border-radius:5px; }
</style>

<!-- 게시판 목록 시작 { -->
<div id="bo_list" style="width:<?php echo $width; ?>">

    <h2>참가접수중인 대회</h2>
    <div class="bo_list_box">
      <ul>
        <?php for ($i=0; $rows = sql_fetch_array($results); $i++) { ?>
        <li>
            <div class="bo_tits"><a href=""><?php echo $rows['wr_subject'] ?></a></div>
            <div class="bo_date">참가접수기간 : <?php echo $rows['wr_3'] ?> ~ <?php echo $rows['wr_4'] ?></div>
            <div class="bo_btns">
              <a href="/bbs/write.php?bo_table=tourlist&wr_no=<?php echo $rows['wr_id'] ?>"><i class="fa fa-pencil" aria-hidden="true"></i> 참가신청</a>
              <a href="<?php echo $write_href ?>"><i class="fa fa-pencil" aria-hidden="true"></i> 신청목록</a>
              <a href="<?php echo $write_href ?>"><i class="fa fa-pencil" aria-hidden="true"></i> 변경요청</a>
              <a href="<?php echo $write_href ?>"><i class="fa fa-pencil" aria-hidden="true"></i> 요강보기</a>
            </div>
        </li>
        <?php } ?>
        <?php if ($i == 0) { echo '<li class="empty_table">게시물이 없습니다.</li>'; } ?>
      </ul>
    </div>
	<!-- 페이지 -->
	<?php echo $write_pages; ?>
	<!-- 페이지 -->
</div>