<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 프로그램 연산에 필요한 선행함수를 실행한다
include_once($board_skin_path.'/skin.function.php');

// 접근경로를 체크한다
if(isset($_SERVER['HTTP_REFERER']) == false || preg_match("/^http[s]?:\/\/{$_SERVER['HTTP_HOST']}/i", $_SERVER['HTTP_REFERER']) == false)
{
    alert('정상적인 경로로 접근하지 않았습니다.');
}

// 객실예약의 수정이나 답변을 허용할 경우에 기간중복 등의 문제가 발생할 수 있다
if(empty($_POST['w']) == false)
{
    alert('객실예약을 수정하거나 답변을 등록할 수 없습니다.');
}

// 글쓰기의 회원권한을 검사한다.
if($member['mb_level'] < $board['bo_write_level'])
{
    alert('객실예약은 회원권한 ' + $board['bo_write_level'] + '이상만 할 수 있습니다.');
}

// 예약자 필수항목의 누락여부를 검사한다
if(preg_match('/[^[:space:]]+/', $_POST['wr_name']) == false)
{
    alert('이름을 입력해주세요.');
}
if(preg_match('/[^[:space:]]+/', $_POST['wr_password']) == false)
{
    alert('비밀번호를 입력해주세요.');
}
if(preg_match('/[^[:space:]]+/', $_POST['wr_homepage']) == false)
{
    alert('연락처를 입력해주세요.');
}

// 예약자 연락처의 유효성을 검사한다
$var = explode('-', $_POST['wr_homepage']);
$arr = array('02', '031', '032', '033', '041', '042', '043', '051', '052', '053', '054', '055', '061', '062', '063', '064', '010', '011', '016', '017', '018', '019');
if(in_array($var['0'], $arr) == false || preg_match('/^[0-9]{3,4}$/', $var['1']) == false || preg_match('/^[0-9]{4}$/', $var['2']) == false)
{
    alert('연락처가 올바른 형식이 아닙니다.');
}

// 객실의 선택여부를 검사한다
$room = $_POST['room'];
$max = count($room);
if($max == 0)
{
    alert('예약할 객실을 하나 이상 선택해주세요.');
}

// 필요한 변수를 정의하거나 예약형식에 맞게 변형한다
if($member['mb_id'])
{
    $wr_name = $member['mb_name'];
    $wr_password = $member['mb_password'];
    $wr_email = $member['mb_email'];
} 
else
{
    $wr_password = sql_password($wr_password);
}
$wr_reply = '';
$secret = 'secret';
$wr_1 = $_POST['select'];
$wr_5 = time();
$wr_7 = 'F';
$date = date('Y년 m월 d일', strtotime($_POST['select']));

// 선택한 객실과 예약정보를 데이타베이스에 저장한다
for($i = 0; $i < $max; $i++)
{
    $wr_num = get_next_num($write_table);
    $wr_8 = $room[$i];
    $arr = sql_fetch("SELECT * FROM {$g5['write_prefix']}{$board['bo_1']} WHERE wr_id = '{$wr_8}'");
    $wr_subject = '[';
    if($OBJECT['bo_use_category'] > 0 && $arr['ca_name'])
    {
        //$wr_subject .= $arr['ca_name'] . '/';
    }
    $wr_subject .= "{$arr['wr_subject']}";
    $val = sql_fetch("SELECT '{$wr_1}' + INTERVAL {$_POST['stay'][$wr_8]} DAY as day");
    $wr_2 = $val['day'];
    $wr_3 = $_POST['stay'][$wr_8];
    $wr_4 = $_POST['person'][$wr_8];
    $wr_6 = getTotal($wr_8, $wr_1, $wr_3, $wr_4);

    $query = "INSERT INTO {$write_table}
        set wr_num = '{$wr_num}', 
        wr_reply = '{$wr_reply}', 
        wr_comment = 0, 
        ca_name = '{$ca_name}', 
        wr_option = '{$html},{$secret},{$mail}', 
        wr_subject = '{$wr_subject}', 
        wr_content = '{$wr_content}', 
        wr_link1 = '{$wr_link1}', 
        wr_link2 = '{$wr_link2}', 
        wr_link1_hit = 0, 
        wr_link2_hit = 0, 
        wr_hit = 0, 
        wr_good = 0, 
        wr_nogood = 0, 
        mb_id = '{$member['mb_id']}', 
        wr_password = '{$wr_password}', 
        wr_name = '{$wr_name}', 
        wr_email = '{$wr_email}', 
        wr_homepage = '{$wr_homepage}', 
        wr_datetime = '".G5_TIME_YMDHIS."', 
        wr_last = '".G5_TIME_YMD." 23:59:59', 
        wr_ip = '{$_SERVER['REMOTE_ADDR']}', 
        wr_1 = '{$wr_1}', 
        wr_2 = '{$wr_2}', 
        wr_3 = '{$wr_3}', 
        wr_4 = '{$wr_4}', 
        wr_5 = '{$wr_5}', 
        wr_6 = '{$wr_6}', 
        wr_7 = '{$wr_7}', 
        wr_8 = '{$wr_8}', 
        wr_9 = '{$wr_9}', 
        wr_10 = '{$wr_10}'
    ";
    sql_query($query);

    $wr_id = sql_insert_id();
    sql_query("UPDATE {$write_table} SET wr_parent = '{$wr_id}' where wr_id = '{$wr_id}'");
    sql_query("INSERT INTO {$g5['board_new_table']} (bo_table, wr_id, wr_parent, bn_datetime, mb_id ) VALUES ('{$_POST['bo_table']}', '{$wr_id}', '{$wr_id}', '{$g5['time_ymdhis']}', '{$member['mb_id']}')");
    sql_query("UPDATE {$g5['board_table']} SET bo_count_write = bo_count_write + 1 WHERE bo_table = '{$_POST['bo_table']}'");
	
	
	$telnum = preg_replace("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "", $_POST['wr_homepage']);
	list($smschk['member'], $smschk['admin']) = explode('|', $board['bo_7']);
	
	
    if((int)$smschk['member'] == 1 || (int)$smschk['member'] == 3)
    {
        //smschk("{$wr_name}님 예약접수 {$date}, {$wr_subject}", $wr_homepage);
    }
    if((int)$smschk['admin'] == 1 || (int)$smschk['admin'] == 3)
    {
        //SMS("{$wr_name}님 예약접수 {$date}, {$wr_subject}");
        include_once(G5_LIB_PATH.'/icode.sms.lib.php');
        $aa = substr($wr_1,5,5);
        $bb = substr($wr_2,5,5);
		$msubj = explode('-', $wr_subject);
		$messub = $msubj[0];
        $sms_content = "{$wr_name}님 예약접수\n{$messub}\n{$wr_4}명/{$wr_6}원\n{$aa}~{$bb}";
		$sms_contentx = "{$board['bo_10']}";
        $send_number = "01084270505"; //보내는 번호
        $cust_number = $telnum; //받는 번호
		
		$SMS = new SMS; // SMS 연결
        $SMS->SMS_con($config['cf_icode_server_ip'], $config['cf_icode_id'], $config['cf_icode_pw'], $config['cf_icode_server_port']);
        $SMS->Add("01084270505", $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
        $SMS->Add($cust_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_content)), "");
        $SMS->Add($cust_number, $send_number, $config['cf_icode_id'], iconv("utf-8", "euc-kr", stripslashes($sms_contentx)), "");
        $SMS->Send();
    }


}

// 예약목록 페이지로 이동한다
$https_url = G5_BBS_URL;

alert("예약이 정상 접수되었습니다.\\n\\n예약하신 객실을 클릭하신 후 비밀번호를 입력하시면\\n\\n진행상황을 확인하실 수 있습니다.\\n\\n감사합니다.", $https_url.'/board.php?bo_table='.$_POST['bo_table'].'&amp;select='.$_POST['select']);
exit();
?>