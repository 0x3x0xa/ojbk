<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqlis.php");
$page_date	=	date("m-d");
$page_date2	=	date("Y-m-d");

if(isset($_GET["date"])){
	$page_date	=	$_GET["date"];
	$page_date2	=	date("Y-").$_GET["date"];
}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>录入比分</title>
<meta http-equiv="Cache-Control" content="max-age=8640000" />
<link rel="stylesheet" href="../images/control_main.css" type="text/css">
<style type="text/css">
<!--
.STYLE3 {color: #FF0000; font-weight: bold; }
.STYLE4 {
	color: #FF0000;
	font-size: 12px;
}
-->
</style>
<script language="javascript" src="../../js/jquery.js"></script>
<script language="javascript">
function gopage(url){
	location.href = url;
}

function check(){
    var len = document.form1.elements.length;
	var num = false;
    for(var i=0;i<len;i++){
		var e = document.form1.elements[i];
        if(e.checked && e.name=='mid[]'){
			num = true;
			break;
		}
    }
	if(num){
		var action = $("#s_action").val();
		if(action=="0"){
			alert("请您选择要执行的相关操作！");
			return false;
		}else{
			if(action=="2") document.form1.action="ft_list.php?type=bet_match&php=zqbf";
			if(action=="1") document.form1.action="ft_shangbanchang_list.php";
			if(action=="3") document.form1.action="ft_shangbanchang_list_re.php";
			if(action=="4") document.form1.action="ft_nullity.php?type=bet_match&php=zqbf";
		}
	}else{
        alert("您未选中任何复选框");
        return false;
    }
}

function ckall(){
    for (var i=0;i<document.form1.elements.length;i++){
	    var e = document.form1.elements[i];
		if (e.name != 'checkall') e.checked = document.form1.checkall.checked;
	}
}

function zqlrbf(zqmid,fid){
	var md = "<?=$page_date?>";
	var a = "mi"+zqmid;
	var b = "ti"+zqmid;
	var c = "mih"+zqmid;
	var d = "tih"+zqmid;
	var m = $("#"+a).val();
	var t = $("#"+b).val();
	var l = $("#"+c).val();
	var n = $("#"+d).val();
	
	if(l.length>0 && n.length>0){
		if(m.length>0 && t.length>0){
			$.post(
				"zqlr.php",
				{r:Math.random(),value:m+"|||"+t+"|||"+md+"|||"+zqmid+"|||qc"},
				function(date){
					 if(date==3){
						alert("系统没有查找到您要结算的赛事！")
					}else if(date==1){
						ftbf(m,t,1,fid);
					}
				}
			);
		}
	}else{
		alert("请输入上半场比分！");
		$("#"+a).val("");
		$("#"+b).val("");
	}
}

function zqlrbf_sb(zqmid,fid){
	var md = "<?=$page_date?>";
	var c = "mih"+zqmid;
	var d = "tih"+zqmid;
	var l = $("#"+c).val();
	var n = $("#"+d).val();
	//alert(c+'-'+d+'-'+l+'-'+n);
	if(l.length>0 && n.length>0){
		$.post(
			"zqlr.php",
			{r:Math.random(),value:l+"|||"+n+"|||"+md+"|||"+zqmid+"|||sb"},
			function(date){
				if(date==3){
					alert("系统没有查找到您要结算的赛事！")
				}else if(date==2){
					ftbf(l,n,2,fid);
				}
			}
		);
	}
}

function ftbf(m,t,p,d){
	if(p == 1){     //////全场
		var mid = document.getElementsByName("mi"+d)
		var tid = document.getElementsByName("ti"+d)
	}else{
		var mid = document.getElementsByName("mh"+d)
		var tid = document.getElementsByName("th"+d)
	}
	for(var i=0; i<mid.length; i++){
		mid[i].value = m;
		tid[i].value = t;
	}
}
</script>
</head>
<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="0" vlink="#0000FF" alink="#0000FF">
<form id="form1" name="form1" method="post" action="ft_list.php" onSubmit="return check();">
    <table width="900" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="200" height="24">选择日期：
          <select id="DropDownList1" onChange="javascript:gopage(this.value)" name="DropDownList1"><?php
for ($i=0;$i<=10;$i++){
	$s		=	strtotime("-$i day");
	$date	=	date("m-d",$s);
?>
        <option value="<?=$_SERVER['PHP_SELF']?>?date=<?=$date?>" <?=$page_date==$date ? 'selected' : ''?>><?=$date?></option>
<?php
}
?>
      </select></td>
        <td width="200"><a href="zqbf_yjs.php?date=<?=$page_date?>" style="font-size:13px;">&gt;&gt;进入已结算</a>
          <input type="button" name="Submit" value="刷新足球" onClick="window.location.reload();"></td>
        <td width="200" align="center"><label>
          【<a href="?date=<?=$page_date?>&type=1" style="font-size:13px;">只看下注</a>】&nbsp;&nbsp;
          【<a href="?date=<?=$page_date?>&type=0" style="font-size:13px;">查看所有</a>】
        </label></td>
        <td width="300" align="right"><span class="STYLE4">相关操作：</span>
   <select name="s_action" id="s_action">
        <option value="0" selected="selected">选择确认</option>
        <option value="2">结算全场</option>
        <option value="1">结算上半场</option>
        <option value="3">重新结算上半场</option>
        <option value="4" style="color:#FF0000;">设为无效</option>
      </select>
      <input type="submit" name="Submit2" value="执行"/></td>
      </tr>
    </table>
  <table   border="0" cellspacing="1" cellpadding="0"  bgcolor="006255" width="900" height="41">
    <tr class="m_title_ft"> 
      <td width="190" height="24" align="middle"><?=$page_date?></td>
      <td align="middle" width="50">时间</td>
      <td align="middle" width="210">主场队伍</td>
      <td align="middle" width="210">客场队伍</td>
      <td align="middle" width="100">上半场</td>
      <td align="middle" width="100">全场比分</td>
      <td align="middle" width="32"><label>
        <input name="checkall" type="checkbox" id="checkall" onClick="return ckall();"/>
      </label></td>
    </tr>
    <?php
	if($_GET["type"]!="0")
	{
		$sqlwhere="";
		$begin_time=$page_date2." 00:00:00";
		$end_time=$page_date2." 23:59:59";
		$sqlwhere.=" AND ((Match_ID in (select match_id from lb1_db.k_bet where match_coverdate>='$begin_time' and match_coverdate<='$end_time'))";
		$sqlwhere.=" OR (Match_ID in (select match_id from lb1_db.k_bet_cg where match_endtime>='$begin_time')))";
	}
	
	$sql		=	"SELECT ID,Match_ID, Match_Date, Match_Time, Match_Master, Match_Guest,Match_Name,MB_Inball,TG_Inball,MB_Inball_HR,TG_Inball_HR,match_sbjs FROM Bet_Match where match_js=0 and (match_date='$page_date' or match_date='$page_date2') ".$sqlwhere." order by Match_CoverDate,Match_Name,Match_Master,iPage,iSn desc";
	$query		=	$mysqlis->query($sql);
	$arr_bet	=	array();
	while($rows	=	$query->fetch_array()){
		if($rows["match_sbjs"]>0) $bgcolor="#FF9999";
		else $bgcolor="#ffffff";
		
		$rows["Match_Name"]		=	trim($rows["Match_Name"]);
		$rows["Match_Master"]	=	trim($rows["Match_Master"]);
		$rows["Match_Guest"]	=	trim($rows["Match_Guest"]);

		$ftid	=	$rows["Match_ID"];
		$bool	=	true;
		foreach($arr_bet as $k=>$arr){
			if(in_array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),$arr)){
				$ftid	=	$arr['Match_ID'];
				$bool	=	false;
				break;
			}
		}
		if($bool){
			array_unshift($arr_bet,array(array($rows['Match_Name'],$rows['Match_Master'],$rows['Match_Guest']),'Match_ID'=>$rows['Match_ID']));
		}
		
		$arr     =	explode('[上半',$rows["Match_Master"]);
		$couarr  =	count($arr);
		if($couarr>1){
		  
		}else{
	 ?>
    <tr style="background-color:#ffffff"   align="center" onMouseOver="this.style.backgroundColor='#EBEBEB'" onMouseOut="this.style.backgroundColor='#ffffff'"> 
      <td width="190"><?=$rows["Match_ID"]?><br/>
      <?=$rows["Match_Name"]?></td>
      <td width="50"><?=$rows["Match_Time"]=='45.5' ? '中埸' : $rows["Match_Time"]?></td>
      <td width="210"><div align="right" style="padding-right:5px;"><?=$rows["Match_Master"]?></div></td>
      <td width="210"><div align="left" style="padding-left:5px;"><?=$rows["Match_Guest"]?></div></td>
     <td width="100"> 
        <input name="<?="mh".$ftid;?>" type="text" class="zqinput" id="mih<?=$rows["Match_ID"]?>" onChange="zqlrbf_sb(<?=$rows["Match_ID"]?>,<?=$ftid?>)" value="<?=$rows["MB_Inball_HR"]?>"  style="width:30px; text-align:center; background-color:<?=$bgcolor?>;" maxlength="3" />
        &nbsp;&nbsp;
        <input name="<?="th".$ftid;?>" type="text" class="zqinput" id="tih<?=$rows["Match_ID"]?>" onChange="zqlrbf_sb(<?=$rows["Match_ID"]?>,<?=$ftid?>)" value="<?=$rows["TG_Inball_HR"]?>" style="width:30px; text-align:center; background-color:<?=$bgcolor?>;" maxlength="3" />
      </td>
      <td width="100"><input name="<?="mi".$ftid;?>" type="text" class="zqinput" id="mi<?=$rows["Match_ID"]?>" onChange="zqlrbf(<?=$rows["Match_ID"]?>,<?=$ftid?>)" value="<?=$rows["MB_Inball"]?>" style="width:30px; text-align:center;" maxlength="3" />
      &nbsp;&nbsp;
      <input name="<?="ti".$ftid;?>" type="text"class="zqinput"  id="ti<?=$rows["Match_ID"]?>" onChange="zqlrbf(<?=$rows["Match_ID"]?>,<?=$ftid?>)" value="<?=$rows["TG_Inball"]?>" style="width:30px; text-align:center;" maxlength="3" />      </td>
     <td width="32"><input name="mid[]" type="checkbox" id="mid[]" value="<?=$rows["Match_ID"]?>" /></td> 
    </tr>
    <?php 
		} 
	}
	unset($arr_bet);
	?>
</table>
</form>
</body>
</html>