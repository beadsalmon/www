<?php
// 프로그램 연산에 필요한 공통파일을 실행한다
include_once('./_common.php');

// 프로그램 연산에 필요한 선행함수를 실행한다
include_once($board_skin_path . '/skin.function.php');

// 예약완료는 관리자만 처리할 수 있다
if($is_admin)
{
    list($SMS['member'], $SMS['admin']) = explode('|', $board['bo_7']);
    if($_POST['sw'])
    {
        $max = count($_POST['chk_wr_id']);
        for($i = 0; $i < $max; $i++)
        {
            $result = sql_fetch("SELECT * FROM {$write_table} WHERE wr_id = '{$_POST['chk_wr_id'][$i]}'");
            $date = date('Y년 m월 d일', strtotime($result['wr_1']));
            if((int)$SMS['member'] > 1)
            {
                SMS("{$result['wr_name']}님 예약완료 {$date}, {$result['wr_subject']}", $result['wr_homepage']);
            }
            if((int)$SMS['admin'] > 1)
            {
                SMS("{$result['wr_name']}님 예약완료 {$date}, {$result['wr_subject']}");
            }
            sql_query("UPDATE {$write_table} SET wr_7 = 'T' WHERE wr_id = '{$_POST['chk_wr_id'][$i]}'");
        }
        goto_url(G5_BBS_URL."/board.php?bo_table={$_POST['bo_table']}&amp;page={$_POST['page']}");
    }
    else
    {
        $result = sql_fetch("SELECT * FROM {$write_table} WHERE wr_id = '{$_GET['wr_id']}'");
        $date = date('Y년 m월 d일', strtotime($result['wr_1']));
        if((int)$SMS['member'] > 1)
        {
            SMS("{$result['wr_name']}님 예약완료 {$date}, {$result['wr_subject']}", $result['wr_homepage']);
        }
        if((int)$SMS['admin'] > 1)
        {
            SMS("{$result['wr_name']}님 예약완료 {$date}, {$result['wr_subject']}");
        }
        sql_query("UPDATE {$write_table} SET wr_7 = 'T' WHERE wr_id = '{$_GET['wr_id']}'");
        goto_url(G5_BBS_URL."/board.php?bo_table={$_GET['bo_table']}&amp;wr_id={$_GET['wr_id']}&amp;page={$_GET['page']}");
    }
}
?>