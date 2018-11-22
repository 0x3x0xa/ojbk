<?php
set_time_limit(0);
ini_set('max_execution_time','100');
include_once("../mysqli.php");
include_once($_SERVER['DOCUMENT_ROOT']."/cache/website.php");
include_once("Auto_Class4.php");
$zhong=0;
$summoney=0;
$flag=false;
$gailv=$web_site['gailv'];
$count=0;
$sumabc=0;
$sumcodes=array();

function preJs($qi,$codes){
	$hm         		= $codes;
	$rs['ball_1']		= $hm[0];
	$rs['ball_2']		= $hm[1];
	$rs['ball_3']		= $hm[2];
	$rs['ball_4']		= $hm[3];
	$rs['ball_5']		= $hm[4];
	$rs['ball_6']		= $hm[5];
	$rs['ball_7']		= $hm[6];
	$rs['ball_8']		= $hm[7];
	$rs['ball_9']		= $hm[8];
	$rs['ball_10']		= $hm[9];

	global $mysqli;
	global $zhong;
	global $summoney;
	global $count;
	global $sumcodes;
	global $sumabc;
	global $num1;
	global $num2;
	global $num3;
	global $num4;
	global $num5;
	global $num6;
	global $num7;
	global $num8;
	global $num9;
	global $num10;
	$zhong=0;
	$summoney=0;

//根据期数读取未结算的注单
$sql1		= "select * from c_bet where type='极速赛车' and js=0 and qishu=".$qi." order by addtime asc";
$query1		= $mysqli->query($sql1);
$sum		= $mysqli->affected_rows;

while($rows = $query1->fetch_array()){
	$summoney+=$rows['money'];
	//开始结算冠军
	if($rows['mingxi_1']=='冠军'){
		$ds = Bjsc_Ds($rs['ball_1']);
		$dx = Bjsc_Dx($rs['ball_1']);
		if($rows['mingxi_2']==$rs['ball_1'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于冠军开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
			
		}
	}
	//开始结算亚军
	if($rows['mingxi_1']=='亚军'){
		$ds = Bjsc_Ds($rs['ball_2']);
		$dx = Bjsc_Dx($rs['ball_2']);
		if($rows['mingxi_2']==$rs['ball_2'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于亚军开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算第三名
	if($rows['mingxi_1']=='第三名'){
		$ds = Bjsc_Ds($rs['ball_3']);
		$dx = Bjsc_Dx($rs['ball_3']);
		if($rows['mingxi_2']==$rs['ball_3'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第三名开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算第四名
	if($rows['mingxi_1']=='第四名'){
		$ds = Bjsc_Ds($rs['ball_4']);
		$dx = Bjsc_Dx($rs['ball_4']);
		if($rows['mingxi_2']==$rs['ball_4'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第四名开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算第五名
	if($rows['mingxi_1']=='第五名'){
		$ds = Bjsc_Ds($rs['ball_5']);
		$dx = Bjsc_Dx($rs['ball_5']);
		if($rows['mingxi_2']==$rs['ball_5'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第五名开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
    //开始结算第六名
	if($rows['mingxi_1']=='第六名'){
		$ds = Bjsc_Ds($rs['ball_6']);
		$dx = Bjsc_Dx($rs['ball_6']);
		if($rows['mingxi_2']==$rs['ball_6'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第六名开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
    //开始结算第七名
	if($rows['mingxi_1']=='第七名'){
		$ds = Bjsc_Ds($rs['ball_7']);
		$dx = Bjsc_Dx($rs['ball_7']);
		if($rows['mingxi_2']==$rs['ball_7'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第七名开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
			
		}
	}
    //开始结算第八名
	if($rows['mingxi_1']=='第八名'){
		$ds = Bjsc_Ds($rs['ball_8']);
		$dx = Bjsc_Dx($rs['ball_8']);
		if($rows['mingxi_2']==$rs['ball_8'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第八名开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
    //开始结算第九名
	if($rows['mingxi_1']=='第九名'){
		$ds = Bjsc_Ds($rs['ball_9']);
		$dx = Bjsc_Dx($rs['ball_9']);
		if($rows['mingxi_2']==$rs['ball_9'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第九名开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
    //开始结算第十名
	if($rows['mingxi_1']=='第十名'){
		$ds = Bjsc_Ds($rs['ball_10']);
		$dx = Bjsc_Dx($rs['ball_10']);
		if($rows['mingxi_2']==$rs['ball_10'] || $rows['mingxi_2']==$ds || $rows['mingxi_2']==$dx){
			//如果投注内容等于第十名开奖号码，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算冠、亚军和
	if($rows['mingxi_1']=='冠、亚军和' && $rows['mingxi_2']>=3 && $rows['mingxi_2']<=19){
		$zonghe = Bjsc_Auto($hm,1);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算冠、亚军和大小
	if($rows['mingxi_2']=='冠亚大' || $rows['mingxi_2']=='冠亚小'){
		$zonghe = Bjsc_Auto($hm,2);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算冠、亚军和单双
	if($rows['mingxi_2']=='冠亚双' || $rows['mingxi_2']=='冠亚单'){
		$zonghe = Bjsc_Auto($hm,3);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算冠亚季军和
	if($rows['mingxi_1']=='冠亚季军和' && $rows['mingxi_2']>=6 && $rows['mingxi_2']<=27){
		$zonghe = Bjsc_Auto($hm,1);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算冠亚季军和大小
	if($rows['mingxi_2']=='冠亚季大' || $rows['mingxi_2']=='冠亚季小'){
		$zonghe = Bjsc_Auto($hm,10);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算冠亚季军和单双
	if($rows['mingxi_2']=='冠亚季双' || $rows['mingxi_2']=='冠亚季单'){
		$zonghe = Bjsc_Auto($hm,11);
		if($rows['mingxi_2']==$zonghe){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算1V10 龙虎
	if($rows['mingxi_1']=='1V10 龙虎'){
		$longhu = Bjsc_Auto($hm,4);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算2V9 龙虎
	if($rows['mingxi_1']=='2V9 龙虎'){
		$longhu = Bjsc_Auto($hm,5);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算3V8 龙虎
	if($rows['mingxi_1']=='3V8 龙虎'){
		$longhu = Bjsc_Auto($hm,6);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算4V7 龙虎
	if($rows['mingxi_1']=='4V7 龙虎'){
		$longhu = Bjsc_Auto($hm,7);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}
	//开始结算5V6 龙虎
	if($rows['mingxi_1']=='5V6 龙虎'){
		$longhu = Bjsc_Auto($hm,8);
		if($rows['mingxi_2']==$longhu){
			//如果投注内容等于开奖内容，则视为中奖
			//注单中奖，给会员账户增加奖金
			$zhong+=$rows['win'];
		}else{
			//注单未中奖，修改注单内容
		}
	}

	
}
	//var_dump($codes);
	//var_dump("zhong=".$zhong);	
	//var_dump("sumnoney=".$summoney);
	global $gailv;
	//var_dump('gailiv='.$gailv);
	//var_dump(($gailv/100));
	$count++;
	if($zhong==0 || $summoney==0 || $gailv<=0){
		return false;
	}else{
		$abc=floor($zhong)/floor($summoney);
		if($count==1){
			$sumabc=$abc;
		}else if($count>2){
			if($sumabc>$abc){
				$sumabc=$abc;
				$sumcodes=$codes;
			}
		}
		if($abc > ($gailv/100)){
			if($count>5000){
				if(count($sumcodes)>0){
					$codes=$sumcodes;	
					$num1		= $sumcodes[0];
					$num2		= $sumcodes[1];
					$num3		= $sumcodes[2];
					$num4		= $sumcodes[3];
					$num5		= $sumcodes[4];
					$num6		= $sumcodes[5];
					$num7		= $sumcodes[6];
					$num8		= $sumcodes[7];
					$num9		= $sumcodes[8];
					$num10		= $sumcodes[9];
				}
				return false;
			}else{
				return true;
			}
		}else{
			return false;
		}
	}

}
?>