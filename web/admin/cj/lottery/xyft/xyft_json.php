<?php header("Content-type: text/html; charset=utf-8"); ?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
    <meta http-equiv="refresh" content="5">
</head>
<body>
<?php
require_once("../mysqli.php");
require_once ("curl_http.php");
$now = date('Y-m-d H:i:s');
$src = 'http://f.apiplus.net/mlaft-1.json';
//防止GET本地缓存，增加随机数
$src .= (strpos($src,'?')>0 ? '&':'?').'_='.time();
$html = file_get_contents($src);
$json = json_decode($html,true);

if (isset($json['rows'])){
	foreach($json['data'] as $r){
		// $qishu = preg_replace("/^(\d{8})(\d{3})$/","\\1-\\2",$r['expect']);
		$qishu =$r['expect'];
		$opencode = $r['opencode'];
		$opentime = $r['opentime'];
		// echo "开奖期号：{$qishu}<br/>";
		// echo "开奖号码：{$opencode}<br/>";
		echo "开奖时间：{$opentime}<br/>";
	}
}else{
	echo "采集失败，返回提示：<br/>";
	echo $html;
}

$m=0;
if($qishu != "" || $qishu == null){
	$nums=explode(",",$opencode);
	// var_dump($nums[0]);
	$sql="select id from c_auto_8 where qishu='".$qishu."' ";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;
	if($tcou==0){
		$sql 	= "select kaijiang from `c_opentime_8` where qishu='".intval($qishu)."'";
		$query 	= $mysqli->query($sql);
		$rs		= $query->fetch_array();
		$time   = $opentime;
		$sql 	= "insert into c_auto_8(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5,ball_6,ball_7,ball_8,ball_9,ball_10) values ('$qishu','$time','$nums[0]','$nums[1]','$nums[2]','$nums[3]','$nums[4]','$nums[5]','$nums[6]','$nums[7]','$nums[8]','$nums[9]')";
		$mysqli->query($sql) or die ("插入失败");
	}
	$m=$m+1;
}

?>
</body>
</html>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gbk">
<meta http-equiv="refresh" content="15">
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
-->
</style></head>
<body>
<script>
window.parent.is_open = 1;
</script>
<script> 
var limit="8" 
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
      幸运飞艇(<?=$qishu?>期:<?=$opencode?>):
      <span id="timeinfo"></span>
	  <iframe src="js_8.php?qi=<?=$mun?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
      </td>
  </tr>
</table>
</body>
</html>

