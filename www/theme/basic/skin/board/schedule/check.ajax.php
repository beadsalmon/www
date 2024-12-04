<?php
// 프로그램 연산에 필요한 공통파일을 실행한다
include_once('./_common.php');

// 프로그램 연산에 필요한 선행함수를 실행한다
include_once($board_skin_path.'/skin.function.php');

// 인원별, 기간별 이용요금을 출력한다
$result = getTotal($wr_id, $select, $stay, $person);
echo number_format($result);
exit;
?>