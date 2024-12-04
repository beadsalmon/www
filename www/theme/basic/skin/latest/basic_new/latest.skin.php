<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$latest_skin_url.'/style.css">', 0);

$thumb_width = 500;
$thumb_height = 250;
$list_count = (is_array($list) && $list) ? count($list) : 0;
?>

<div class="lat_new">
    <ul>
    <?php for ($i=0; $i<$list_count; $i++) {  
	    $thumb = get_list_thumbnail($bo_table, $list[$i]['wr_id'], $thumb_width, 0, false, true);

		if($thumb['src']) {
			$img = $thumb['src'];
		} else {
			$img = G5_IMG_URL.'/no_img.png';
			$thumb['alt'] = '이미지가 없습니다.';
		}
	    $datex = explode("-", $list[$i]['datetime']); // 구분자가 | 로 되어 있음
		
		$img_content = '<img src="'.$img.'" alt="'.$thumb['alt'].'" >';
	?>
        <li class="basic_li">
            <div class="lt_date">
              <b><?php echo $datex[2]; ?></b>
              <span><?php echo $datex[0]; ?>. <?php echo $datex[1]; ?>.</span>
            </div>
            <?php
            echo "<a href=\"".$list[$i]['href']."\"> ";
            if ($list[$i]['is_notice'])
                echo "<strong>".$list[$i]['subject']."</strong>";
            else
                echo $list[$i]['subject'];
            echo "</a>";
            ?>
            <h6 class="lt_img"><?php echo run_replace('thumb_image_tag', $img_content, $thumb); ?></h6>
            <p class="lt_more"><a href="<?php echo $list[$i]['href']; ?>">Learn more ></a></p>
        </li>
    <?php }  ?>
    <?php if ($list_count == 0) { //게시물이 없을 때  ?>
    <li class="empty_li">게시물이 없습니다.</li>
    <?php }  ?>
    </ul>
    
    <p class="lt_allmore"><a href="<?php echo get_pretty_url($bo_table); ?>">Learn more ></a></p>
</div>
