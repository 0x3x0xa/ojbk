<?php
include_once("../common/login_check.php");
check_quanxian("bfgl");
include_once("../../include/mysqli.php");
include_once("../../include/mysqlis.php");

$mid=@$_GET["mid"];
if($mid){
	$MB_Inball_HR	=	$_GET["MB_Inball_HR"];
	$TG_Inball_HR	=	$_GET["TG_Inball_HR"];
	$MB_Inball		=	$_GET["MB_Inball"];
	$TG_Inball		=	$_GET["TG_Inball"];
	
	if($MB_Inball_HR=="" || $TG_Inball_HR==""){ //判断是否保存上半场
		message("请输入正确的上半场比分！");
	}
	
	$match_name	=	$_GET["hf_match_name"];
	$Match_Master	=	$_GET["hf_Match_Master"];
	$Match_Guest	=	$_GET["hf_Match_Guest"];
	$Match_Date	=	$_GET["hf_Match_Date"];

	$sql			=	"select Match_ID from bet_match where match_name='$match_name' and Match_Master='$Match_Master' and Match_Guest='$Match_Guest' and Match_Date like ('%".$Match_Date."%')";
	$query			=	$mysqlis->query($sql);
	$mid			=	"";
	while($rows = $query->fetch_array()){
		$mid .= $rows["Match_ID"].",";
	}
	$mid   			=	rtrim($mid,",");
	$value			=	"";
	if($MB_Inball!="" && $TG_Inball!=""){ //保存全场
	 	$sql		=	"update bet_match set mb_inball='$MB_Inball',tg_inball='$TG_Inball',mb_inball_hr='$MB_Inball_HR',tg_inball_hr='$TG_Inball_HR' where match_id in($mid)";
		$mysqlis->query($sql);
		
		//保存所有全场单式注单比分
		$sql		=	"select bid,point_column from k_bet where lose_ok=1 and status=0 and match_id in($mid) order by bid desc ";
		$result		=	$mysqli->query($sql); //单式
		$bid   		=	"";
		$bid_sb		=	"";
		$arr_sb		=	array("match_bmdy","match_bgdy","match_bhdy","match_bho","match_bao","match_bdpl","match_bxpl");
		while($rows = $result->fetch_array()){
		    if(in_array(strtolower($rows["point_column"]),$arr_sb) || strpos(strtolower($rows["point_column"]),"match_hr_bd")){ //上半场
				$bid_sb	.=	$rows["bid"].",";
			}else{ //全场
				$bid	.=	$rows["bid"].",";
			}
		}
		if($bid != ""){ //全场
			$bid	=	rtrim($bid,",");
			$sql	=	"update k_bet set MB_Inball='$MB_Inball',TG_Inball='$TG_Inball' where bid in($bid)";
			$mysqli->query($sql);
		}
		if($bid_sb != ""){ //上半场
			$bid_sb	=	rtrim($bid_sb,",");
			$sql    =	"update k_bet set MB_Inball='$MB_Inball_HR',TG_Inball='$TG_Inball_HR' where bid in($bid_sb)";
			$mysqli->query($sql);
		}
		
		//保存所上半场有串关注单比分
		$sql		=	"select bid,ball_sort,bet_info from k_bet_cg where status=0 and match_id in($mid) order by bid desc";
		$result_cg	=	$mysqli->query($sql); //串关
		$bid		=	"";
		$bid_sb		=	rtrim($bid,",");
		while($rows =	$result_cg->fetch_array()){
		    if(strpos($rows["ball_sort"],"上半场") || strpos($rows["bet_info"],"上半场")){
				$bid_sb .=	$rows["bid"].",";
			}else{
				$bid 	.=	$rows["bid"].",";
			}
		}
		if($bid_sb != ""){
			$bid_sb =	rtrim($bid_sb,",");
			$sql    =	"update k_bet_cg set mb_inball='$MB_Inball_HR',tg_inball='$TG_Inball_HR' where bid in($bid_sb)";
			$mysqli->query($sql);
		}
		if($bid != ""){
			$bid	=	rtrim($bid,",");
			$sql	=	"update k_bet_cg set mb_inball='$MB_Inball',tg_inball='$TG_Inball' where bid in($bid)";
			$mysqli->query($sql);
		}
		
		$value		=	"保存全场";
	 }else{ //保存上半场 
	 	$sql		=	"update bet_match set mb_inball_hr='$MB_Inball_HR',tg_inball_hr='$TG_Inball_HR' where match_id in($mid)";
		$mysqlis->query($sql);
		
		//保存所有上半场单式注单比分
		$bid		=	"";
		$sql		=	"select bid from k_bet where lose_ok=1 and (point_column in ('match_bmdy','match_bgdy','match_bhdy','match_bho','match_bao','match_bdpl','match_bxpl') or point_column like 'match_hr_bd%') and status=0 and match_id in($mid) order by bid desc"; //单式
		$result		=	$mysqli->query($sql);
		while($rows =	$result->fetch_array()){
			$bid .= $rows["bid"].",";
		}
		$bid		=	rtrim($bid,",");
		if($bid != ""){
			$sql	=	"update k_bet set MB_Inball='$MB_Inball_HR',TG_Inball='$TG_Inball_HR' where bid in($bid)";
			$mysqli->query($sql);
		}
		
		//保存所上半场有串关注单比分
		$sql		=	"select bid from k_bet_cg where status=0 and match_id in($mid) and (ball_sort like('%上半场%') or bet_info like('%上半场%')) order by bid desc";
		$result_cg	=	$mysqli->query($sql); //串关
		$bid		=	"";
		while($rows =	$result_cg->fetch_array()){
			$bid .=	$rows["bid"].",";
		}
		if($bid != ""){
			$bid	=	rtrim($bid,",");
			$sql	=	"update k_bet_cg set mb_inball='$MB_Inball_HR',tg_inball='$TG_Inball_HR' where bid in($bid)";
			$mysqli->query($sql);
		}
  
		$value	=	"保存上半场";
	 }
	 
	 message($value."成功！","zqbf_yjs.php");
}else{
	 message('系统没有查找到您要结算的赛事！');
}
?>