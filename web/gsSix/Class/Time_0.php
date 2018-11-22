<?php
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");
include ("../include/lottery_time.php");

@session_start();

//开始读取期数
//开始读取赔率
$sql		= "select * from c_odds_17 order by id asc";
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
$sql		= "select * from c_opentime_17 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
if($qs){
	$qishu	= date("Ymd",$lottery_time).BuLings($qs['qishu']);
	$close	=   strtotime(date("Y-m-d",$lottery_time).' '.$qs['kaijiang'])-$lottery_time;
	$kj_time = date("Y-m-d",$lottery_time).' '.$qs['kaijiang'];
}else{
		$qishu		= -1;
		$close	= -1;
		$kj_time	= -1;
}



$uid=$_SESSION['uid'];
if($uid!=null && $uid!=""){
	$sql="select sum(money) as money from c_bet where uid=$uid and qishu=$qishu and type='五分六合彩' and mingxi_1='四全中'";
	$query = $mysqli->query($sql);
	$rowm  = $query->fetch_array();
	$money = $rowm['money'];
	if($money==null){
		$money=0;
	}
}

//十期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7 from c_auto_17 where ok=1 order by id desc limit 10";
$query = $mysqli->query($sql);
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}

//返回数据
$result = array(
    'number' => $qishu,
    'close' => $close,
    'kj_time' => $kj_time,
    'kj_list' => $kj_list,
	'money'   => $money
);
echo json_encode($result);

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
		$num = '00'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '0'.$num;
	}
	
	return $num;
}