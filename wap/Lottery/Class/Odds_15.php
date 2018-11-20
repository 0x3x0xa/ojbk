<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");
//开始读取赔率
$sql		= "select * from c_odds_15 order by id asc";
$query		= $mysqli->query($sql);
$list 		= array();
$s 			= 1;
while ($odds = $query->fetch_array()) {
	for($i = 1; $i<16; $i++){
		$list['ball'][$s][$i] = $odds['h'.$i];
	}
	$s++;
}
//开始读取期数
$sql		= "select * from c_opentime_15 where kaipan<='".date("H:i:s",$lottery_timeffc)."' and kaijiang>='".date("H:i:s",$lottery_timeffc)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();


if($qs){
	// $qishu		= $lastno + $qs['qishu'];
	$qishu		= date("Ymd",$lottery_timeffc).BuLings($qs['qishu']);
	$fengpan	= strtotime(date("Y-m-d",$lottery_timeffc).' '.$qs['fengpan'])-$lottery_timeffc;
	$kaijiang	= strtotime(date("Y-m-d",$lottery_timeffc).' '.$qs['kaijiang'])-$lottery_timeffc;
}else{
		$qishu		= -1;
		$fengpan	= -1;
		$kaijiang	= -1;
}
$arr = array(   
    // 'number' => $qishu+9279, 
    'number' => $qishu, 
	'endtime' => $fengpan,
	'opentime' => $kaijiang,
	'oddslist' => $list,  


);  
$json_string = json_encode($arr);   
echo $json_string; 
/*
数字补0函数，当数字小于10的时候在前面自动补0
*/
function BuLing ( $num ) {
	if ( $num<10 ) {
		$num = '0'.$num;
	}
	return $num;
}
/*
数字补0函数2，当数字小于10的时候在前面自动补00，当数字大于10小于100的时候在前面自动补0
*/
function BuLings ( $num ) {
	if ( $num<10 ) {
		$num = '000'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '00'.$num;
	}
	if ( $num>=100 && $num<1000 ) {
		$num = '0'.$num;
	}
	return $num;
}
?> 