<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 프로그램 연산에 필요한 선행함수를 실행한다
include_once($board_skin_path . '/skin.function.php');

// 객실예약의 수정이나 답변을 허용할 경우에 기간중복 등의 문제가 발생할 수 있다
if(empty($w) == false)
{
    alert('객실예약을 수정하거나 답변을 등록할 수 없습니다.');
}

// 프로그램 연산에 필요한 일자를 추출한다
//list($date['min']) = mysql_fetch_array(sql_query("SELECT '".G5_TIME_YMD."' + INTERVAL {$board['bo_3']} DAY"));
//list($date['max']) = mysql_fetch_array(sql_query("SELECT '".G5_TIME_YMD."' + INTERVAL {$board['bo_4']} DAY"));
$date = sql_fetch("SELECT '".G5_TIME_YMD."' + INTERVAL {$board['bo_3']} DAY as min, '".G5_TIME_YMD."' + INTERVAL {$board['bo_4']} DAY as max");
if(isset($select) == false)
{
    $select = $date['min'];
}
$val = sql_fetch("SELECT '{$select}' + INTERVAL {$board['bo_5']} DAY as last");
$date['last'] = $val['last'];

// 이용일자가 최대일자보다 작은지 검사한다
if($select > $date['max'])
{
    alert('이용할 수 없는 예약일자를 선택하였습니다.');
}

// 객실정보게시판에 등록된 객실정보를 추출한다
$max = 0;
$result = sql_query("SELECT * FROM {$g5['write_prefix']}{$OBJECT['bo_table']} WHERE wr_is_comment = 0 ORDER BY wr_9 ASC");
while($row = sql_fetch_array($result))
{
    $field = getPrice($select);
    $row['price'] = $row[$field];
    $row['link'] = G5_BBS_URL."/board.php?bo_table={$OBJECT['bo_table']}&amp;wr_id={$row['wr_id']}";
    if($OBJECT['bo_use_category'] == 0)
    {
        $row['ca_name'] = null;
    }

    $val = sql_fetch("SELECT COUNT(wr_id) AS total FROM {$write_table} WHERE wr_8 = '{$row['wr_id']}' AND wr_1 != '' AND wr_2 != '' AND wr_1 <= '{$select}' AND wr_2 > '{$select}'");
    $count = $val['total'];
    if($count == 0)
    {
        if($select < 0) // $select < $date['min']
        {
            $row['stay'] = $board['bo_5'];
            $row['disabled'] = 'disabled';
            $row['inquiry'] = null;
        }
        else
        {
            $var = sql_fetch("SELECT wr_1 FROM {$write_table} WHERE wr_8 = '{$row['wr_id']}' AND wr_1 != '' AND wr_1 > '{$select}' AND wr_1 < '{$date['last']}' ORDER BY wr_1 ASC LIMIT 0, 1");
            if($var['wr_1'])
            {
                $val = sql_fetch("SELECT TO_DAYS('{$var['wr_1']}') - TO_DAYS('{$select}') as stay");
                $row['stay'] = $val['stay'];
            }
            else
            {
                $row['stay'] = $board['bo_5'];
            }
            $row['disabled'] = $row['inquiry'] = null;
        }
    }
    else
    {
        $row['stay'] = $board['bo_5'];
        $row['disabled'] = 'disabled';
        $val = sql_fetch_array(sql_query("SELECT wr_id FROM {$write_table} WHERE wr_8 = '{$row['wr_id']}' AND wr_1 != '' AND wr_2 != '' AND wr_1 <= '{$select}' AND wr_2 > '{$select}'"));
        $var = $val['wr_id'];
        $row['inquiry'] = G5_BBS_URL."/board.php?bo_table={$bo_table}&amp;wr_id={$var}&amp;select={$select}";
    }

    $ROOM[$max] = $row;
    $max++;
}

// 객실예약에 필요한 각종 변수를 정의한다
$guide = $board['bo_insert_content'];
$board['bo_insert_content'] = null;

if(isset($member['mb_id']) == true)
{
    $readonly = 'readonly';
    $password = '******';
    $write['wr_name'] = $member['mb_name'];
    if($member['mb_hp'])
    {
        $member['mb_homepage'] = $member['mb_hp'];
    }
    else if($member['mb_tel'])
    {
        $member['mb_homepage'] = $member['mb_tel'];
    }
    else
    {
        $member['mb_homepage'] = null;
    }
}
else
{
    $readonly = $password = null;
}
?>