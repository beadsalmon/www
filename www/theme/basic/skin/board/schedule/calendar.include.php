<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 선택일자로부터 필요한 변수를 정의한다
if(!$select)
{
    $select = G5_TIME_YMD;
}

list($year, $month, $date) = explode('-', $select);
$start = '01';
$end = date('t', strtotime($select . ' 00:00:00'));

// 선택일자가 최소일자와 최대일자의 사이값인지 검사한다
//list($limit['min']) = sql_fetch("SELECT '".G5_TIME_YMD."' + INTERVAL {$board['bo_3']} DAY");
//list($limit['max']) = sql_fetch("SELECT '".G5_TIME_YMD."' + INTERVAL {$board['bo_4']} DAY");
$limit = sql_fetch("SELECT '".G5_TIME_YMD."' + INTERVAL {$board['bo_3']} DAY as min, '".G5_TIME_YMD."' + INTERVAL {$board['bo_4']} DAY as max");


if(substr($select, 0, 7) < substr(G5_TIME_YMD, 0, 7) || substr($select, 0, 7) > substr($limit['max'], 0, 7))
{
    //alert('이용할 수 없는 예약일자를 선택하였습니다.');
}

// 이전버튼과 다음버튼을 정의한다
$val = sql_fetch("SELECT '{$year}-{$month}-{$start}' - INTERVAL 1 DAY as prev");
$prev = $val['prev'];
$val = sql_fetch("SELECT '{$year}-{$month}-{$end}' + INTERVAL 1 DAY as next");
$next = $val['next'];
if(substr($prev, 0, 7) < substr(G5_TIME_YMD, 0, 7))
{
    $prev   = null;
}
if(substr($next, 0, 7) > substr($limit['max'], 0, 7))
{
    $next   = null;
}

// 달력에 표시되는 객실그룹이름, 객실그룹개수, 해당일자의 예약개수를 추출하기 위한 객실그룹아이디를 추출한다 (객실정보게시판의 분류설정여부에 따라 구분)
/*
if($OBJECT['bo_use_category'] > 0 && $OBJECT['bo_category_list'])
{

    // 객실그룹이름 : 객실정보게시판의 분류명
    $group = explode('|', $OBJECT['bo_category_list']);
    $count = count($group);
    for($i = 0; $i < $count; $i++)
    {
        // 객실그룹개수 : 각 분류에 등록된 객실(게시글)의 개수
        $val = sql_fetch("SELECT COUNT(wr_id) as cnt FROM {$g5['write_prefix']}{$OBJECT['bo_table']} WHERE wr_is_comment = 0 AND ca_name = '{$group[$i]}'");
        $amount[$i] = $val['cnt'];
        // 객실그룹아이디 : 각 분류에 등록된 객실(게시글)의 아이디
        $val = sql_fetch("SELECT wr_id,wr_subject FROM {$g5['write_prefix']}{$OBJECT['bo_table']} WHERE wr_is_comment = 0 AND ca_name = '{$group[$i]}'");
        $class[$i] = $val['wr_id'];
        //$result = sql_query("SELECT * FROM {$g5['write_prefix']}{$OBJECT['bo_table']} WHERE wr_is_comment = 0");
        
        $name[$i] = $val['wr_subject'];
    }
}
else
{
*/
    $count = 0;
    $result = sql_query("SELECT * FROM {$g5['write_prefix']}{$OBJECT['bo_table']} WHERE wr_is_comment = 0 ORDER BY wr_9 ASC");
    while($row = sql_fetch_array($result))
    {
        // 객실그룹이름 : 등록된 객실(게시글)의 제목
        $group[$count] = $row['wr_subject'];
        $group[$count]['name'] = $row['wr_subject'];
        // 객실그룹개수 : 등록된 객실(게시글)의 개수
        $amount[$count] = 1;
        // 객실그룹아이디 : 등록된 객실(게시글)의 아이디
        $class[$count] = array($row['wr_id']);
        
        $count++;
    }
	
//}

// 예약된 객실을 일자별, 객실별로 구분되는 2차배열로 선언한다 (예 : $room['일자']['객실아이디'])
$result = sql_query("SELECT * FROM {$write_table} WHERE wr_is_comment = 0 AND ((wr_1 != '' AND wr_1 >= '{$year}-{$month}-{$start}' AND wr_1 <= '{$year}-{$month}-{$end}') OR (wr_2 != '' AND wr_2 > '{$year}-{$month}-{$start}' AND wr_2 <= '{$year}-{$month}-{$end}'))");
while($row = sql_fetch_array($result))
{
    // 숙박시작일자가 선택일자 이전달일 경우에는 선택일자의 1일부터 선언되도록 조정한다
    if($row['wr_1'] < "{$year}-{$month}-{$start}")
    {
        $val = sql_fetch("SELECT TO_DAYS('{$prev}') - TO_DAYS('{$row['wr_1']}') as temp");
        $temp = $val['temp'];
        $row['wr_1'] = "{$year}-{$month}-{$start}";
        $row['wr_3'] = $row['wr_3'] - $temp - 1;
    }

    // 숙박시작일자부터 숙박기간만큼 배열을 선언한다
    $var = explode('-', $row['wr_1']);
    $open = (int)$var['2'];
    $close = $open + $row['wr_3'] - 1;
    for($i = $open; $i <= $close; $i++)
    {
        $room[$i][$row['wr_8']] = $row['wr_id'];
    }
}

// 달력출력에 필요한 변수를 정의한다
$val = sql_fetch("SELECT weekday('{$year}-{$month}-{$start}') as week");
$min = $val['week'];
if($min == 6)
{
    $min = 0;
}
else
{
    $min++;
}
$max = $min + $end;
if($max % 7 > 0)
{
    $total = $max + (7 - ($max % 7));
}
else
{
    $total = $max;
}
$day = 1;

?>