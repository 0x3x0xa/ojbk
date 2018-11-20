<?php
header('Content-Type:text/html; charset=utf-8');
error_reporting(~E_NOTICE);
require_once("../set.php");
require_once("../db1.php");
require_once("curl_http.php");
function ob2ar($obj) {
    if(is_object($obj)) {
        $obj = (array)$obj;
        $obj = ob2ar($obj);
    } elseif(is_array($obj)) {
        foreach($obj as $key => $value) {
            $obj[$key] = ob2ar($value);
        }
    }
    return $obj;
}
$curl = new Curl_HTTP_Client();
$html_data = $curl->fetch_url("http://yfc.tianwule.com/open/");

$str1=substr($html_data,stripos($html_data,'<span class="n">第 <i>'),100);	
$str2=substr($html_data,stripos($html_data,'<div class="open-balls balls-c5">'),250);
preg_match_all('/[\s\S]*?(\d+)<\/i>[\s\S].*?/is',$str1,$qishu);
$qishu=$qishu[1][0];
preg_match_all('/<div class="open-balls balls-c5">((?:[\s\S]*?<span class=".*?"><i>\d+<\/i><\/span>){3,5})[\s\S]*?<\/div>/',$str2,$num);
preg_match_all('/<span class=".*?"><i>(\d+)<\/i><\/span>/',$num[1][0],$number);

$time 		= date("Y-m-d H:i:s");
$ball_1		= $number[1][0];
$ball_2		= $number[1][1];
$ball_3		= $number[1][2];
$ball_4		= $number[1][3];
$ball_5		= $number[1][4];

if(strlen($qishu)>0){
	$sql="select id from c_auto_15 where qishu='".$qishu."' ";
	$tquery = $mysqli->query($sql);
	$tcou	= $mysqli->affected_rows;
	if($tcou==0){
		$sql	=	"insert into c_auto_15(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values ('$qishu','$time','$ball_1','$ball_2','$ball_3','$ball_4','$ball_5')";
		$mysqli->query($sql);
		$m=$m+1;
	}
}


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
</style>
<script> 
<!-- 
var limit="10" 
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
</head>
<body>

<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr> 
    <td align="left">
      <input type=button name=button value="刷新" onClick="window.location.reload()">
     快乐分分彩(<?=$qishu?>期<?="$ball_1,$ball_2,$ball_3,$ball_4,$ball_5"?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="js_15.php?qi=<?=$qishu?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>