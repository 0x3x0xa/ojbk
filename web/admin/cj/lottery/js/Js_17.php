<?php
header('Content-Type:text/html; charset=utf-8');
include_once("../../mysqli.php");
include ("Auto_Class3.php");
$qi 		= floatval($_REQUEST['qi']);
//获取开奖号码
if($_REQUEST['ac']=='re'){
	$qi 		= is_numeric($_REQUEST['qi']) ? $_REQUEST['qi'] : 0;
	$sql		= "select * from c_auto_3 where qishu=".$qi." order by id desc limit 1";
}else{
	$sql		= "select * from c_auto_3 where ok2=0";
}
$query		= $mysqli->query($sql);
while($rs   = $query->fetch_array()){
$qi 		= $rs['qishu'];
$hm		= $rs['ball_1']%4;
if($hm==0)$hm=4;
//根据期数读取未结算的注单
$sql1		= "select * from c_bet where type='番摊' and js=0 and qishu=".$qi." order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;
while($rows = $query1->fetch_array()){
	$he=0;
	//开始结算番
	if($rows['mingxi_1']=='番'){
		if($rows['mingxi_2']==$hm.'番'){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算角
	if($rows['mingxi_1']=='角'){
		$arr=explode(' ',mb_substr($rows['mingxi_2'],1,3,'utf-8'));
		if($hm==$arr[0] || $hm==$arr[1]){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算单双
	if($rows['mingxi_1']=='单双'){
		$ds = Ft_Auto($hm,2);
		if($rows['mingxi_2']==$ds){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算念
	if($rows['mingxi_1']=='念'){
		$nian_arr = explode('念',$rows['mingxi_2']);
		if($hm==$nian_arr[0] ){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}elseif($hm==$nian_arr[1] ){
			$he=1;
			$msql="update c_bet set win=0,js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
	//开始结算三门
	if($rows['mingxi_1']=='三门'){
		$arr = explode(' ',$rows['mingxi_2']);
		if($hm==$arr[0] || $hm==$arr[1] || $hm==$arr[2]){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
    //开始结算第六球
	if($rows['mingxi_1']=='一通' || $rows['mingxi_1']=='二通' || $rows['mingxi_1']=='三通' || $rows['mingxi_1']=='四通'){
		$arr = explode(' ',$rows['mingxi_2']);
		$t_arr=array('一通'=>1,'二通'=>2,'三通'=>3,'四通'=>4);
		$disnum=$t_arr[$rows['mingxi_1']];
		if($hm==$arr[0] || $hm==$arr[1]){
			//如果投注内容等于第一球开奖号码，则视为中奖
			$msql="update c_bet set js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['win']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}elseif($hm==$disnum){
			$he=1;
			$msql="update c_bet set win=0,js=1 where id='".$rows['id']."'";
			$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
			//注单中奖，给会员账户增加奖金
			$q1 = $mysqli->affected_rows;
			if($q1==1){
				$msql="update k_user set money=money+".$rows['money']." where uid=".$rows['uid']."";
				$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
			}
		}else{
			//注单未中奖，修改注单内容
			$msql="update c_bet set win=-money,js=1 where id=".$rows['id']."";
			$mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
		}
	}
    $msql2="update c_bet set daywin=win,daymoney=money where id=".$rows['id']."";
$mysqli->query($msql2);
    //
        //填写开奖结果到注单
    $msql="update c_bet set jieguo='".$rs['ball_1'].",".$rs['ball_2'].",".$rs['ball_3'].",".$rs['ball_4'].",".$rs['ball_5'].",".$rs['ball_6'].",".$rs['ball_7'].",".$rs['ball_8']."' where id=".$rows['id']."";
    $mysqli->query($msql) or die ("会员修改失败!!!".$rows['id']);
	//==============返水开始============
	if(!$he){
		$sql_f	=	"select cpfsbl from k_group left join k_user ON k_group.id=k_user.gid where k_user.uid='".$rows['uid']."' limit 1";
		$query_f	=	$mysqli->query($sql_f);
		$rows_f	=	$query_f->fetch_array();
		$cpfsbl=$rows_f["cpfsbl"];//反水比例
		if(!is_numeric($cpfsbl))$cpfsbl=0;
		$fs=$rows['money']*$cpfsbl;
		$sql	=	"update k_user set money=money+$fs where uid='".$rows['uid']."' limit 1";
		$mysqli->query($sql) or die ("返水添加失败!!!".$rows['id']);
		$msql="update c_bet set fs='$fs' where id='".$rows['id']."'";
		$mysqli->query($msql) or die ("注单修改失败!!!".$rows['id']);
	}
	//==============返水结束============
}
$msql="update c_auto_3 set ok2=1 where qishu=".$qi."";
$mysqli->query($msql) or die ("期数修改失败!!!");

}
if ($_GET['t']==1)    {
	echo "<script>window.location.href='../../Lottery/auto_17.php';</script>";
}
if($_REQUEST['ac']=='re'){
	echo "OK";
}
?>