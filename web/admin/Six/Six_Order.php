<?php
header("Content-type: text/html; charset=utf-8");
include_once("../common/login_check.php");
check_quanxian("ssgl"); 
if ($_REQUEST['date_s']!=''){
	$date_s	= $_REQUEST['date_s'];
}else{
	$date_s	= date('Y-m-d',time());
}
if ($_REQUEST['date_e']!=''){
	$date_e	= $_REQUEST['date_e'];
}else{
	$date_e	= date('Y-m-d',time());
}
$type=$_GET['type'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>系统设置</title>
<link href="../css/base.css" rel="stylesheet" type="text/css" />
<link href="../css/admin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.tools.js"></script>
<script type="text/javascript" src="../js/base.js"></script>
<script language="JavaScript" src="/js/calendar.js"></script>
</head>
<body class="list">
	<div class="bar">
		六合彩注单查看
	</div>

<div class="body">
<form name="form1" method="get" action="<?=$_SERVER["REQUEST_URI"]?>" onSubmit="return check();">
<div class="listBar">
      <select name="js" id="js">
            <option value="0" style="color:#FF9900;" <?=$_GET['js']=='0' ? 'selected' : ''?>>未结算注单</option>
            <option value="1" style="color:#FF0000;" <?=$_GET['js']=='1' ? 'selected' : ''?>>已结算注单</option>
            <option value="" <?=$_GET['js']=='' ? 'selected' : ''?>>全部注单</option>
      </select>
  &nbsp;&nbsp;
          会员账号：
          <input name="username" type="text" id="username" value="<?=$_GET['username']?>" size="15">
            &nbsp;&nbsp;日期范围：
            <input name="s_time" type="text" id="s_time" value="<?=$_GET['s_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />
            ~
            <input name="e_time" type="text" id="e_time" value="<?=$_GET['e_time']?>" onClick="new Calendar(2008,2020).show(this);" size="10" maxlength="10" readonly="readonly" />&nbsp;&nbsp;注单号：
            <input name="tf_id" type="text" id="tf_id" value="<?=@$_GET['tf_id']?>" size="22">
            &nbsp;&nbsp;<input name="find" type="submit" id="find" value="查看报表" class="formButton"/></td>

	</div>
</form>
<ul id="tab" class="tab">
                <li><input type="button" value="六合彩注单" hidefocus class="current"/></li>
			</ul>
<table id="listTables" class="listTables">

				<tr>

					<th>所属彩种</th>

					<th>注单号码</th>
					<th>投注期号</th>
					<th>投注玩法</th>
					<th>投注内容</th>
					<th>投注金额</th>
					<th>赔率</th>

					<th>输赢结果</th>

					<th>投注时间</th>
					<th>投注账号</th>
					<th>状态</th>
				</tr>
<?php
      include_once("../../include/mysqli.php");
      include_once("../include/pager.class.php");
	  
	  $uid	=	'';
	  if($_GET['username']){
	      $sql		=	"select uid from k_user where username='".$_GET['username']."' limit 1";
		  $query	=	$mysqli->query($sql);
		  if($rows	=	$query->fetch_array()){
		  		$uid=	$rows['uid'];
		  }
	  }
 
      $sql	=	"select id from c_bet where money>0 and type='香港六合彩'";
	  if($_GET["uid"]) $uid = $_GET["uid"];
	  if($uid != '') $sql.=" and uid=".$uid;
	  if($_GET["s_time"]) $sql.=" and addtime>='".$_GET["s_time"]." 00:00:00'";
	  if($_GET["e_time"]) $sql.=" and addtime<='".$_GET["e_time"]." 23:59:59'";
	  if(isset($_GET["js"]))  $sql.=" and js=".$_GET["js"]."";
	  if($_GET['tf_id']) $sql.=" and id=".$_GET['tf_id']."";
	  $sql.=" order by id desc ";
	  
	  $query	=	$mysqli->query($sql);
	  $sum		=	$mysqli->affected_rows; //总页数
	  $thisPage	=	1;
	  $pagenum	=	50;
	  if($_GET['page']){
	  	  $thisPage	=	$_GET['page'];
	  }
      $CurrentPage=isset($_GET['page'])?$_GET['page']:1;
	  $myPage=new pager($sum,intval($CurrentPage),$pagenum);
	  $pageStr= $myPage->GetPagerContent();
	  
	  $bid		=	'';
	  $i		=	1; //记录 bid 数
	  $start	=	($thisPage-1)*$pagenum+1;
	  $end		=	$thisPage*$pagenum;
	  while($row = $query->fetch_array()){
	  	  if($i >= $start && $i <= $end){
	  	  	$bid .=	$row['id'].',';
		  }
		  if($i > $end) break;
		  $i++;
	  }
	  if($bid){
	  	$bid	=	rtrim($bid,',');
	  	$sql	=	"select * from c_bet where id in($bid) order by id desc";
	  	$query	=	$mysqli->query($sql);
      	while ($rows = $query->fetch_array()) {	  
		$fs=$rows['fs'] ? " (返水：".$rows['fs'].")" : '' ;
?>
      <tr>
        <td height="30" align="center" valign="middle"><?=$rows['type']?></td>
        <td align="center" valign="middle"><?=$rows['id']?></td>
        <td align="center" valign="middle">第 <?=$rows['qishu']?> 期</td>
        <td align="center" valign="middle"><?=$rows['mingxi_1']?><?=$rows["sm"] ? '('.$rows["sm"].')' : ''?></td>
        <td align="center" valign="middle"><?=$rows['mingxi_2']?></td>
        <td align="center" valign="middle"><?=$rows['money']?><?=$fs?></td>
        <td align="center" valign="middle"><?=$rows['odds']?></td>
        <td align="center" valign="middle"><?php if($rows['js']==0){?><font color="#0000FF">未结算</font><?php }else{?><?=round($rows['win'],2)?><?php }?></td>
        <td align="center" valign="middle"><?=$rows['addtime']?></td>
        <td align="center" valign="middle"><?=$rows['username']?></td>
        <td align="center" valign="middle"><?php if($rows['js']==0){?>
          <a href="Six_Auto.php"><font color="#0000FF">点击开奖</font></a>
          <?php }?>
          <?php if($rows['js']==1){?>
          <font color="#FF0000">已结算</font>
        <?php }?></td>
      </tr>
<?php
	}
}
?>
  </table>
  <div class="pagerBar"><?php echo $pageStr;?></div>
  </div>
</body>
</html>