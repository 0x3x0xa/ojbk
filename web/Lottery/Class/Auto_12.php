<?php
session_start();
header('Content-Type:text/html; charset=utf-8');
include ("../../include/mysqli.php");

$uid = $_SESSION['uid'];

//用户输赢
$n_date=date("Y-m-d");
$sql = "select round(SUM(daymoney), 2) as yk from c_bet where uid='$uid'and bet_date='$n_date' ";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_money = $rs['yk'];
$sql = "select round(SUM(daywin), 2) as yk from c_bet where uid='$uid' and win >= 0 and bet_date='$n_date'";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$z_win = $rs['yk'];
$sy = round($z_win - $z_money, 2);

//十期开奖结果
$sql = "select qishu,ball_1,ball_2,ball_3,ball_4 from c_auto_12 where ok=1 order by id desc limit 10";
$query = $mysqli->query($sql);
$kj_list = array();
while($row = $query->fetch_assoc()) {
    $kj_list[] = $row;
}

//返回数据
$result = array(
    'shuying' => $sy,
    'kj_list' => $kj_list
);
echo json_encode($result);