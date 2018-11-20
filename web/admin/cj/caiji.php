<!doctype html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta charset="utf-8">
<title>足球接收</title>
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
</head>
<body>
<script> 
<!-- 
var limit="6:00" 
if (document.images){ 
	var parselimit=limit.split(":") 
	parselimit=parselimit[0]*60+parselimit[1]*1 
} 
function beginrefresh(){ 
	if (!document.images) 
		return 
	if (parselimit==1) 
		window.location.reload() 
	else{ 
		parselimit-=1 
		curmin=Math.floor(parselimit/60) 
		cursec=parselimit%60 
		if (curmin!=0) 
			curtime=curmin+"分"+cursec+"秒后自动登陆！" 
		else 
			curtime=cursec+"秒后自动登陆！" 
		//	timeinfo.innerText=curtime 
			setTimeout("beginrefresh()",1500) 
	} 
} 
window.onload=beginrefresh 
//--> 
</script>
<!--
<table width="800" height="200"  border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
  <td width="400" height="200" valign="top"> 
      <iframe width=400 height=200 src='reload.php' frameborder=0 scrolling="no"></iframe> 
    </td>
	<td width="400" height="200" valign="top"> 
      <iframe width=400 height=200 src='auto.php' frameborder=0 scrolling="no"></iframe> 
    </td>
  </tr>
</table>-->
<table width="800" height="620"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
	 <td width="800" height="620" valign="top"> 
      <iframe width=800 height=620 src='js.html' frameborder=0 scrolling="no"></iframe> 
    </td>
</tr>
</table>
<!--
<table width="800" height="210"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
    <td width="800" height="210" valign="top"> 
      <iframe width=800 height=210 src='bf.html' frameborder=0 scrolling="no"></iframe> 
    </td>
</tr>
</table>

<table width="800" height="600"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td width="800" height="600" valign="top"> 
      <iframe width=800 height=600 src='download.php' frameborder=0 scrolling="no"></iframe> 
    </td>
</tr>
</table>-->
</body>
</html>