<?php
set_time_limit(0);
ini_set('max_execution_time','100');

header('Content-Type:text/html; charset=utf-8');
require_once("../mysqli.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cache/website.php");
include_once("./js/prejs_gssix.php");
$lottery_time = time()-300;
$sql		= "select * from c_opentime_17 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();

$tempNum="";
$num1="";
$num2="";
$num3="";
$num4="";
$num5="";
$num6="";
$num7="";

if($qs){	
		$qishu	= date("Ymd",$lottery_time).BuLings($qs['qishu']);

		$sql2="select * from c_auto_17 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql2);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			//生成开奖号码
			$time   = date('Y-m-d H:i:s',strtotime("-1 minute",strtotime(date('Y-m-d ',$lottery_time).$qs['kaijiang'])));
			if($web_site['gailv']<=0){
				getCodes();
			}else{
				$result=false;
				do{
					getCodes();
					$result=preJs($qishu,$tempNum);
				}while($result);
			}

			var_dump("start");
			var_dump($tempNum);
			$tquery = $mysqli->query($sql2);
			$tcou	= $mysqli->affected_rows;
			if($tcou==0){
				$sql3 	= "insert into c_auto_17(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7) values ('$qishu','$time','$num1','$num2','$num3','$num4','$num5','$num6','$num7')";	
				$mysqli->query($sql3);
			}

		}else{
			$tqs		= $tquery->fetch_array();
			$num1= $tqs['ball_1'];$num2= $tqs['ball_2'];$num3= $tqs['ball_3'];$num4= $tqs['ball_4'];$num5= $tqs['ball_5'];$num6= $tqs['ball_6'];$num7= $tqs['ball_7'];
		}
		$txt="采集到($qishu 期:$num1,$num2,$num3,$num4,$num5,$num6,$num7)";
		// echo $txt;
	
}

function getCodes(){
	global $tempNum;
	global $num1;
	global $num2;
	global $num3;
	global $num4;
	global $num5;
	global $num6;
	global $num7;
	$tempNum=explode(",",randKeys());
	$num1		= $tempNum[0];
	$num2		= $tempNum[1];
	$num3		= $tempNum[2];
	$num4		= $tempNum[3];
	$num5		= $tempNum[4];
	$num6		= $tempNum[5];
	$num7		= $tempNum[6];
	
}
		
function randKeys($len=7){
	$array    = array(
        "01",
        "02",
        "03",
        "04",
        "05",
        "06",
        "07",
        "08",
        "09",
        "10",
        "11",
        "12",
        "13",
        "14",
        "15",
        "16",
        "17",
        "18",
        "19",
        "20",
        "21",
        "22",
        "23",
        "24",
        "25",
        "26",
        "27",
        "28",
        "29",
        "30",
        "31",
        "32",
        "33",
        "34",
        "35",
        "36",
        "37",
        "38",
        "39",
        "40",
        "41",
        "42",
        "43",
        "44",
        "45",
        "46",
        "47",
        "48",
        "49"
    );
    shuffle($array);
    $output = "";
	for($i=0; $i<$len; $i++){
	  
       $output .= $array[$i].",";
    }  
    return rtrim($output, ',');
}
function BuLings ( $num ) {
	if ( $num<10 ) {
		$num = '00'.$num;
	}
	if ( $num>=10 && $num<100 ) {
		$num = '0'.$num;
	}
	
	return $num;
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<style type="text/css">
<!--
body,td,th {
    font-size: 12px;
}
body {
    margin-left: 0px;
    margin-top: 0px;
    margin-right: 0px;
    margin-bottom: 0px;
}
#timeinfo{color:#C60}
-->
</style></head>
<body>
<script>
window.parent.is_open = 1;
</script>
<script> 
<!-- 
<? $limit= 5;?>
var limit="<?=$limit?>" 
if (document.images){ 
	var parselimit=limit
} 
function beginrefresh(){ 
if (!document.images) 
	return 
if (parselimit==1) 
	window.location.reload() 
else{ 
	parselimit-=1 
	curmin=Math.floor(parselimit) 
	if (curmin!=0) 
		curtime=curmin+"秒后自动获取!" 
	else 
		curtime=cursec+"秒后自动获取!" 
		timeinfo.innerText=curtime 
		setTimeout("beginrefresh()",1000) 
	} 
} 
window.onload=beginrefresh
</script>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()">
      五分六合彩<br><?=$txt?>&nbsp;
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="./js/js_gssix.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>