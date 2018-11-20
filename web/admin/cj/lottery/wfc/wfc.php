<?php
header('Content-Type:text/html; charset=utf-8');
require_once("../mysqli.php");
require_once(JKCACHE."/website.php");

if(21==1){
$st_time=strtotime("2014-10-09 00:00:00");
echo $st_time."<br>";
$ppx="";
for($i=1;$i<=288;$i++){
	echo $i."===";
	$sqls="select * from c_opentime_16 where qishu='$i'";
	echo $sqls;
	$tquery=$mysqli->query($sqls);
	$rs = $tquery->fetch_array();
	$add_num=4;
	$add_num2=5;
	$actiontime=date("H:i:s",$st_time);
	$fengpan=date("H:i:s", $st_time+$add_num*60);
	$kaijiang=date("H:i:s", $st_time+($add_num+1)*60);
	if($rs['qishu']){		
		$strSqls="UPDATE `c_opentime_16` SET `kaipan`='$actiontime',`fengpan`='$fengpan',`kaijiang`='$kaijiang' WHERE (`qishu`='".$rs['qishu']."')";
		echo $strSqls."<br>";
		$ppx.='"'.date("H:i",$st_time).'",';
		$mysqli->query($strSqls);
		//mysql_query($strSqls) or die("写入时间错误！<br>");
		
	}else{
		$strSqls="INSERT INTO `c_opentime_16` (`id`, `qishu`, `kaipan`, `fengpan`, `kaijiang`, `ok`) VALUES ('$i', '$i', '$actiontime', '$fengpan', '$kaijiang', '0')";
		echo $strSqls."<br>";
		$ppx.='"'.date("H:i",$st_time).'",';
		$mysqli->query($strSqls);
	}
	$st_time+=60*$add_num2;
}
exit;
}

$lottery_time = time();
$sql		= "select * from c_opentime_16 where kaipan<='".date("H:i:s",$lottery_time)."' and kaijiang>='".date("H:i:s",$lottery_time)."' order by id asc";
$query		= $mysqli->query($sql);
$qs		= $query->fetch_array();
if($qs){
	if($qs['qishu']==1){
		$qishu		= date("Ymd",strtotime('-1 day',$lottery_time)).'288';
	}else{
		$qsbl=BuLings($qs['qishu']-1);
		$qishu=date('Ymd',$lottery_time).$qsbl;
	}
	if($web_site['wfc_auto']){
		$sql2="select * from c_auto_16 where qishu='".$qishu."' ";
		$tquery = $mysqli->query($sql2);
		$tcou	= $mysqli->affected_rows;
		if($tcou==0){
			$tempNum=explode(",",randKeys());
			$num1		= $tempNum[0];
			$num2		= $tempNum[1];
			$num3		= $tempNum[2];
			$num4		= $tempNum[3];
			$num5		= $tempNum[4];
			$time   = date('Y-m-d H:i:s',strtotime("-5 minute",strtotime(date('Y-m-d ',$lottery_time).$qs['kaijiang'])));
			$sql3 	= "insert into c_auto_16(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('$qishu','$time','$num1','$num2','$num3','$num4','$num5')";	
			$mysqli->query($sql3);
			
		}else{
			$tqs		= $tquery->fetch_array();
			$num1= $tqs['ball_1'];$num2= $tqs['ball_2'];$num3= $tqs['ball_3'];$num4= $tqs['ball_4'];$num5= $tqs['ball_5'];
		}
		$txt="采集到($qishu 期:$num1,$num2,$num3,$num4,$num5)";
	}else{
		$txt="已关闭自动采集";
	}
}
		
function randKeys($len=5){
	$str='6038519724';
	$rand='';
	for($x=0;$x<$len;$x++){
		$rand.=($rand!=''?',':'').substr($str,rand(0,strlen($str)-1),1);
	}
	return $rand;
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
      五分彩<br><?=$txt?>&nbsp;
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="./js/js_wfc.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>