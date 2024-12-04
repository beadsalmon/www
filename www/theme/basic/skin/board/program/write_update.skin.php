<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 


$wr_3 = $_POST['wr_3a']." ".$_POST['wr_3s'];
$wr_4 = $_POST['wr_4a']." ".$_POST['wr_4s'];
$wr_6 = $_POST['wr_6a']." ".$_POST['wr_6s'];
$wr_7 = $_POST['wr_7a']." ".$_POST['wr_7s'];


$sql = " update {$write_table}
			 set wr_3 = '{$wr_3}',
				 wr_4 = '{$wr_4}',
				 wr_6 = '{$wr_6}',
				 wr_7 = '{$wr_7}' 
		   where wr_id = '{$wr_id}' ";
sql_query($sql);
?>
