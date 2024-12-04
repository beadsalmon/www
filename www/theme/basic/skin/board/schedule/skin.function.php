<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 목록화면을 위한 관리자 인증세션을 저장한다
if($type == 'true')
{
    $_SESSION['admin'] = true;
    goto_url(G5_BBS_URL.'/board.php?bo_table='.$bo_table);
}

// 달력화면을 위한 관리자 인증세션을 삭제한다
if($type == 'false')
{
    unset($_SESSION['admin']);
    goto_url(G5_BBS_URL. '/board.php?bo_table=' . $bo_table);
}

// 버튼의 유형을 정의한다 (달력보기 or 목록보기)
if($is_admin && $_SESSION['admin'])
{
    $BUTTON = "<img src=\"{$board_skin_url}/img/b_list.gif\" alt=\"목록보기\">";
}
else
{
    $BUTTON = "<img src=\"{$board_skin_url}/img/b_calendar.gif\" alt=\"달력보기\">";
}

// 객실정보게시판이 정의되지 않았다면 실행을 중지한다
$OBJECT = sql_fetch("SELECT * FROM {$g5['board_table']} WHERE bo_table = '{$board['bo_1']}'");
if(isset($OBJECT['bo_table']) == false)
{
    alert('객실정보게시판이 정의되지 않았습니다.');
}

// 필요한 변수값이 정의되지 않았다면 기본값으로 설정한다
if((int)$board['bo_3'] < 1)
{
    $board['bo_3'] = 1;
}
if((int)$board['bo_4'] < 1)
{
    $board['bo_4'] = 90;
}
if((int)$board['bo_5'] < 1)
{
    $board['bo_5'] = 10;
}
if((int)$board['bo_6'] < 1)
{
    $board['bo_6'] = $board['bo_3'];
}

// 예약내역삭제일이 경과한 미입금 예약목록은 삭제한다
$result = sql_query("SELECT wr_id FROM {$write_table} WHERE wr_last < DATE_SUB(now(), INTERVAL {$board['bo_6']} DAY) AND wr_7 = 'F'");
while($row = sql_fetch_array($result))
{
    sql_query("DELETE FROM {$write_table} WHERE wr_parent = '{$row['wr_id']}'");
    sql_query("DELETE FROM {$g5['board_new_table']} WHERE bo_table = '{$bo_table}' AND wr_parent = '{$row['wr_id']}'");
    sql_query("UPDATE {$g5['board_table']} SET bo_count_write = bo_count_write - 1 WHERE bo_table = '{$bo_table}'");
}

// 예약이 가능한 일자를 추출하여 선택박스로 출력한다
function optionDate($select = null)
{
    global $g5, $board;
    $arr = array('0' => '(월)', '1' => '(화)', '2' => '(수)', '3' => '(목)', '4' => '(금)', '5' => '(토)', '6' => '(일)');
    for($i = 0; $i < $board['bo_4']; $i++) // for($i = $board['bo_3']; $i < $board['bo_4']; $i++)
    {
        $date = sql_fetch("SELECT '".G5_TIME_YMD."' + INTERVAL {$i} DAY AS this");
        $week = sql_fetch("SELECT weekday('{$date['this']}') AS this");

        echo "<option value=\"{$date['this']}\"";
        if($date['this'] == $select)
        {
            echo ' selected';
        }
        echo ">{$date['this']} {$arr[$week['this']]}</option>";

    }
    return;

}

// 숙박이 가능한 일자를 추출하여 선택박스로 출력한다
function optionStay($max)
{
    for($i = 1; $i <= $max; $i++)
    {
        $var = $i + 1;
        echo "<option value=\"{$i}\">{$i}박 {$var}일</option>";
    }
    return;
}

// 숙박이 가능한 인원을 추출하여 선택박스로 출력한다
function optionPerson($min, $max)
{
    for($i = $min; $i <= $max; $i++)
    {
        echo "<option value=\"{$i}\">{$i}명</option>";
    }
    return;
}

// 선택한 일자가 성수기인지를 추출한다 (성수기 : 1000, 비성수기 : 2000)
function getSeason($select)
{
    global $board;
    $result = 2000;
    $var = substr($select, 5, 5);
    $arr = explode('|', $board['bo_2']);
    $max = count($arr);
    for($i = 0; $i < $max; $i++)
    {
        list($open, $close) = explode('~', $arr[$i]);
        //if($open <= $var || $var <= $close)
        if($open <= $var && $var <= $close)
        {
            $result = 1000;
            break;
        }
    }
    return $result;
}

// 선택한 일자가 주말(금,토요일)인지를 추출한다 (토요일 : 1000, 주중 : 2000, 금요일 : 3000)
function getWeek($select)
{
    global $config;
    $val = sql_fetch("SELECT weekday('{$select}') as week");
    $var = $val['week'];
    if($var == 4 || $var == 5)
    {
        $result = 3000;
    }
    else if($var == 6)
    {
        $result = 1000;
    }
    else
    {
        $result = 2000;
    }

    return $result;
}

// 선택한 일자의 이용요금을 추출한다 (이용요금을 추출할 수 있는 테이블의 필드명을 리턴한다)
function getPrice($select)
{
    $arr = array(
        '1000' => array('1000' => 'wr_6', '2000' => 'wr_6', '3000' => 'wr_7'),
        '2000' => array('1000' => 'wr_4', '2000' => 'wr_4', '3000' => 'wr_5')
    );
    $season = getSeason($select);
    $week = getWeek($select);
    $result = $arr[$season][$week];
    return $result;
}

// 인원별, 기간별 이용요금을 산출한다
function getTotal($wr_id, $select, $stay, $person)
{
    global $g5, $board;
    $result = 0;
    $sql = "SELECT * FROM {$g5['write_prefix']}{$board['bo_1']} WHERE wr_id = '{$wr_id}'";
    $write = sql_fetch($sql);
    for($i = 0; $i < $stay; $i++)
    {
        $val = sql_fetch("SELECT '{$select}' + INTERVAL {$i} DAY as day");
        $date = $val['day'];
        $field = getPrice($date);
        $result += $write[$field];
    }
    $result += (($person - $write['wr_2']) * $write['wr_8'] * $stay);
    return $result;
}

// 선택일자에 예약된 객실의 개수를 산출한다
function getRoom($day, $number)
{
    global $class, $room;
    $result = 0;
    $max = count($class[$number]);
    for($i = 0; $i < $max; $i++)
    {
        $var = $class[$number][$i];
        $result += count($room[$day][$var]);
    }
    return $result;
}

// 문자메시지를 전송합니다 (아이코드 클래스)
function SMS($message, $receive = null)
{
    global $board;
    list($id, $password) = explode('|', $board['bo_8']);
    list($phone, $mobile) = explode('|', $board['bo_9']);
    if(isset($receive) == false)
    {
        $receive = $mobile;
    }
    $SMS = new ICODE;
    $SMS -> Connect($id, $password);
    $SMS -> Add($phone, $receive, $message);
    $SMS -> Send();
    return;
}

function BLANK($string, $size)
{
    for($i = 0; $i < $size; $i++)
    {
        $string .= ' ';
    }
    $result = substr($string, 0, $size);
    return $result;
}

class ICODE
{
    var $ID;
    var $PASSWORD;
    var $SERVER;
    var $PORT;
    var $DATA;

    function Connect($id, $password)
    {
        $this -> ID = BLANK($id, 10);
        $this -> PASSWORD = BLANK($password, 10);
        $this -> SERVER = '211.172.232.124';
        $this -> PORT = rand(7192, 7195);
        return;
    }

    function Add($send, $mobile, $message)
    {
        $send = str_replace('-', null, $send);
        $send = BLANK($send, 33);
        $mobile = str_replace('-', null, $mobile);
        $mobile = BLANK($mobile, 11);
        $message = stripslashes($message);
        $message = BLANK($message, 80);
        $this -> DATA = '01144 ' . $this -> ID . $this -> PASSWORD . $mobile . $send . $message;
        return;
    }

    function Send()
    {
        $fgets = null;
        $fsockopen = fsockopen($this -> SERVER, $this -> PORT);
        fputs($fsockopen, $this -> DATA);
        while(isset($fgets) == false)
        {
            $fgets = fgets($fsockopen, 30);
        }
        fclose($fsockopen);
        $result = substr($fgets, 0, 19);
        $key = '0223  00' . substr($this -> DATA, 26, 11);
        $this -> DATA = null;
        if($result != $key)
        {
            return false;
        }
        return true;
    }
}
?>