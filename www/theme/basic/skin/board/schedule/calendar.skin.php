<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 달력출력에 필요한 종속파일을 실행한다
include_once($board_skin_path . '/calendar.include.php');
?>

<script src="<?php echo $board_skin_url; ?>/script.js"></script>
<script>
$(function(){
	var winDw = $(window).width();
	
	if(winDw > 900){
	  $("table tbody tr td").hover(
		function(){
			$(this).find("div").fadeIn();
		},function(){
			$(this).find("div").css("display","none");
		}
	  );
	}
});
</script>
<link rel="stylesheet" href="<?php echo $board_skin_url; ?>/style.css">

<style>
table tbody tr td { position:relative; }
.cnt_room { color:#666; text-align:center; margin-top:15px; }
.roomlist { position:absolute; top:25px; left:5px; background-color:#392300; color:#fff; width:300px; z-index:1005; padding:10px; display:none; border-radius:0 12px 0 12px; box-shadow:5px 5px 5px rgba(0,0,0,0.2); }
.roomlist a span { color:#ccc; }
</style>

<div id="mara_cal" style="width:<?php echo $width; ?>; padding:50px 0 150px;">
    <div class="title">
        <a href="#none" onclick="movePage('<?php echo $prev; ?>');"><img src="<?php echo $board_skin_url; ?>/img/b_prev.gif" alt="이전달"></a>
        &nbsp;<?php echo $year; ?>년 <?php echo $month; ?>월&nbsp;
        <a href="#none" onclick="movePage('<?php echo $next; ?>');"><img src="<?php echo $board_skin_url; ?>/img/b_next.gif" alt="다음달"></a>
    </div>

    <p class="explain">달력에서 원하는 일자를 클릭한 후 예약접수 및 예약확인/취소를 할 수 있습니다.</p>
    <table>
    <caption>예약 현황</caption>
    <col class="rm_grid_3"><!-- 15% -->
    <col class="rm_grid_19"><!-- 14% -->
    <col class="rm_grid_19"><!-- 14% -->
    <col class="rm_grid_19"><!-- 14% -->
    <col class="rm_grid_19"><!-- 14% -->
    <col class="rm_grid_19"><!-- 14% -->
    <col class="rm_grid_3"><!-- 15% -->
    <thead>
    <tr>
        <th scope="col" class="red">일요일</th>
        <th scope="col">월요일</th>
        <th scope="col">화요일</th>
        <th scope="col">수요일</th>
        <th scope="col">목요일</th>
        <th scope="col">금요일</th>
        <th scope="col">토요일</th>
    </tr>
    </thead>
    <tbody>
    <tr>
    <?php
    for($i = 0; $i < $total; $i++)
    {
        if($i > 0 && $i % 7 == 0)
        {
            echo '</tr><tr>';
        }
        if($i >= $min && $i < $max)
        {
            $var = "{$year}-{$month}-" . sprintf('%02d', $day);
            if($var < G5_TIME_YMD || $var > $limit['max'])
            {
                echo '<td class="gray">'.$day.'일</td>';
            }
            else
            {
                echo '<td>';
                echo "<p class=\"title_day\"><strong class=\"day\">{$day}일</strong></p>";
				
				$link = G5_BBS_URL."/write.php?bo_table={$bo_table}&amp;select={$var}";
				
				
				
				echo "<div class='roomlist'>";
				
				$countx = 0;
                for($k = 0; $k < $count; $k++)
                {
                    $number = getRoom($day, $k);
                    if($var >= 0 && $number < $amount[$k]) // if($var >= $limit['min'] && $number < $amount[$k])
                    {
                        $icon = $style = 'open';
                        $icon_alt = '예약가능';
                    }
                    else
                    {
                        $icon = $style = 'close';
                        $icon_alt = '예약불가';
                    }
					
					
                    if($number == 1 && $number == $amount[$k])
                    {
                        $link = G5_BBS_URL."/board.php?bo_table={$bo_table}&amp;wr_id={$room[$day][$class[$k]['0']]}&amp;select={$var}";
						
                    }
                    else
                    {
                        $link = G5_BBS_URL."/write.php?bo_table={$bo_table}&amp;select={$var}";
						$countx++;
                    }
                    echo '<p>';
                    echo "<img src=\"{$board_skin_url}/img/i_{$icon}.gif\" alt=\"$icon_alt\"> ";
                    echo "<a href=\"{$link}\">";
                    echo "<span class=\"{$style}\">{$group[$k]}({$number}/{$amount[$k]})</span>";
                    echo '</a>';
                    echo '</p>';
                }
				echo "</div>";
				
				echo "<a href=\"{$link}\">";
				echo "<p class=\"cnt_room\">예약가능({$countx})</p>";
				echo '</a>';
				
                echo '</td>';
            }
            $day++;
        }
        else
        {
            echo '<td class="null">&nbsp;</td>';
        }
    }
?>
    </tr>
    </tbody>
    </table>

    <?php if($is_admin){ ?>
    <div class="mara_btn_area">
        <a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $bo_table; ?>&amp;type=true"><img src="<?php echo $board_skin_url; ?>/img/b_list.gif" alt="목록보기"></a>
    </div>
    <?php } ?>
</div>