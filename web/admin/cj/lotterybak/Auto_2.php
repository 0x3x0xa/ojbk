<?php
header('Content-Type:text/html; charset=utf-8');
include ("../mysqli.php");
require ("curl_http.php");

function getFile()
{
    $List = array();
    $curl = &new Curl_HTTP_Client();
    $curl->store_cookies("cookies.txt"); 
    $curl->set_user_agent("Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
    $html=$curl->fetch_url("http://www.1399p.com/shishicai/kaijiang/");

    if(preg_match('!<p class="p">(\d+-\d+)([\s\S]*?)nums([\s\S]*?)</td!', $html,$matches)){
        //print_r($matches);
        $List['openTerm'] =str_replace('-','',$matches[1]);//期号
        preg_match_all('!<span class=.*?>(\d+)</!', $matches[3],$nums);
        for ($i=0; $i < count($nums[1]); $i++) { 
            $List['openResult'][]=$nums[1][$i];
        }
        $List['openTime'] = date("Y-m-d H:i:s",time()+12*60*60);//时间+12小时
    }
    return $List;
}

$List = getFile();
if($List['openTerm']!=''){
	$sql		= "select * from c_auto_2 where qishu=".$List['openTerm']." order by id asc limit 0,1";
	$query		= $mysqli->query($sql);
	$sum		= $mysqli->affected_rows;
	if($sum==0){
		$sql		=	"insert into c_auto_2(qishu,datetime,ball_1,ball_2,ball_3,ball_4,ball_5) values (".$List['openTerm'].",'".$List['openTime']."',".$List['openResult'][0].",".$List['openResult'][1].",".$List['openResult'][2].",".$List['openResult'][3].",".$List['openResult'][4].")";
        $mysqli->query($sql) or die ("操作失败!!!");
	}
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
-->
</style></head>
<body>
<script>
window.parent.is_open = 1;
</script>
<script> 
<!-- 
var limit="20" 
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
      重庆时时彩(<?=$List['openTerm']?>期<?=$List['openResult'][0].",".$List['openResult'][1].",".$List['openResult'][2].",".$List['openResult'][3].",".$List['openResult'][4]?> .<?=$list['opentime']?>):
      <span id="timeinfo"></span>
      </td>
  </tr>
</table>
<iframe src="js_2.php?qi=<?=$List['openTerm']?>" frameborder="0" scrolling="no" height="0" width="0"></iframe>
</body>
</html>