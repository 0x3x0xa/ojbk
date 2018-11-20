<?php
include_once("../include/config.php"); 
include_once("../common/login_check.php");
include_once("../common/logintu.php");
include_once("../include/mysqli.php");
include_once("../include/newpage.php");
include_once("../class/user.php");
include_once("../common/function.php");
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);

$sub = 2;

if(!user::is_daili($uid)) {
    message('你还不是代理，请先申请！', "1");
}


$uname  =	$_GET["uname"];
if($uname != '') {
    $sql    =   "select top_uid from k_user where username='$uname' limit 1";
    $query  =   $mysqli->query($sql);
    $row    =   $query->fetch_array();
    if ($row["top_uid"] != $uid) {
        message('你不是该客户的代理，如有疑问，请联系管理员！', "agent.php");
    }
}
$time	=	$_GET["time"];
$time	=	$time==""?"EN":$time;
$bdate	=	$_GET["bdate"];
$bhour	=	$_GET["bhour"];
$bhour	=	$bhour==""?"00":$bhour;
$bsecond=	$_GET["bsecond"];
$bsecond=	$bsecond==""?"00":$bsecond;
$edate	=	$_GET["edate"];
$edate	=	$edate==""?date("Y-m-d",time()):$edate;
$ehour	=	$_GET["ehour"];
$ehour	=	$ehour==""?"23":$ehour;
$esecond=	$_GET["esecond"];
$esecond=	$esecond==""?"59":$esecond;
$btime	=	$bdate." ".$bhour.":".$bsecond.":00";
$etime	=	$edate." ".$ehour.":".$esecond.":59";
if($bdate!=""){
	$btime	=	$bdate." ".$bhour.":".$bsecond;
}
if($edate!=""){
	$etime	=	$edate." ".$ehour.":".$esecond;
}

if($time=="CN"){
	$q_btime	=	date("Y-m-d H:i:s",strtotime($btime)-12*3600);
	$q_etime	=	date("Y-m-d H:i:s",strtotime($etime)-12*3600);
}else{
	$q_btime	=	$btime;
	$q_etime	=	$etime;
}
$sqlwhere	=	"";
if($uname!=""){
	$sqlwhere	.=	" and username='$uname'";
}

if($q_btime!=""){
	$sqlwhere	.=	" and addtime>='$q_btime'";
}

if($q_etime!=""){
	$sqlwhere	.=	" and addtime<='$q_etime'";
}

$sumyx=0;
$summoney=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <script type="text/javascript" src="../js/laydate.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
	<script type="text/javascript">
        function padZero(num) {
            return ((num <= 9) ? ("0" + num) : num);
        }
        function chg_date(range,num1,num2){
            if(range=='t' || range=='w' || range=='lw'){
                form1.bdate.value ='<?=date('Y-m-d')?>';
                form1.edate.value =form1.bdate.value;
            }
            if(range!='t'){
                if(form1.bdate.value!=form1.edate.value){
                    form1.bdate.value ='<?=date('Y-m-d')?>';
                    form1.edate.value =form1.bdate.value;
                }
                var aStartDate = form1.bdate.value.split('-');
                var newStartDate = new Date(parseInt(aStartDate[0], 10),parseInt(aStartDate[1], 10) - 1,parseInt(aStartDate[2], 10) + num1);
                form1.bdate.value = newStartDate.getFullYear()+ '-' + padZero(newStartDate.getMonth() + 1)+ '-' + padZero(newStartDate.getDate());

                var aEndDate = form1.edate.value.split('-');
                var newEndDate = new Date(parseInt(aEndDate[0], 10),parseInt(aEndDate[1], 10) - 1,parseInt(aEndDate[2], 10) + num2);
                form1.edate.value = newEndDate.getFullYear()+ '-' + padZero(newEndDate.getMonth() + 1)+ '-' + padZero(newEndDate.getDate());
            }
        }
    </script>
</head>
<body>
    <div class="wrap">
        <?php include_once("agentmenu.php"); ?>
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
		 <form name="form1" method="get" action="agent_user.php">
			 <tr align="center">
                    <td colspan="8">
                        <!--<select name="time" id="time">
                            <option value="CN" <?=$time=='CN' ? 'selected' : ''?>>中国时间</option>
                            <option value="EN" <?=$time=='EN' ? 'selected' : ''?>>美东时间</option>
                        </select>
                        <span>账号</span>
                        <input name="uname" type="text" size="10" maxlength="20" value="<?=$uname?>" onFocus="this.value='';" class="input_80" />-->
                        <span>开始日期</span>
                        <input name="bdate" type="text" id="bdate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$bdate?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: true, max: laydate.now()});" style="cursor: pointer"/>
                        <select name="bhour" id="bhour">
                            <?php
                            for($i=0;$i<24;$i++){
                                $list=$i<10?"0".$i:$i;
                                ?>
                                <option value="<?=$list?>" <?=$bhour==$list?"selected":""?>><?=$list?></option>
                            <?php } ?>
                        </select> 时
                        <select name="bsecond" id="bsecond">
                            <?php
                            for($i=0;$i<60;$i++){
                                $list=$i<10?"0".$i:$i;
                                ?>
                                <option value="<?=$list?>" <?=$bsecond==$list?"selected":""?>><?=$list?></option>
                            <?php } ?>
                        </select> 分
                        <span style="margin-left: 10px">结束日期</span>
                        <input name="edate" type="text" id="edate" class="input_100 laydate-icon" size="10" readonly="readonly" value="<?=$edate?>" onclick="laydate({format: 'YYYY-MM-DD', isclear: true, max: laydate.now()});" style="cursor: pointer"/>
                        <select name="ehour" id="ehour">
                            <?php
                            for($i=0;$i<24;$i++){
                                $list=$i<10?"0".$i:$i;
                                ?>
                                <option value="<?=$list?>" <?=$ehour==$list?"selected":""?>><?=$list?></option>
                            <?php } ?>
                        </select> 时
                        <select name="esecond" id="esecond">
                            <?php
                            for($i=0;$i<60;$i++){
                                $list=$i<10?"0".$i:$i;
                                ?>
                                <option value="<?=$list?>" <?=$esecond==$list?"selected":""?>><?=$list?></option>
                            <?php } ?>
                        </select> 分
                        <?php
                        if (date(w,time())==0){
                            $num=6;
                        }else{
                            $num=date(w,time()-60*60*24);
                        }
                        ?>
                        <button type="button" onclick="chg_date('t', 0, 0)">今天</button>
                        <button type="button" onclick="chg_date('w', -<?=$num?>, 6-<?=$num?>)">本周</button>
                        <button type="button" onclick="chg_date('lw', -<?=$num?>-7, 6-<?=$num?>-7)">上周</button>
                        <button name="find" type="submit" id="find">查找</button>
                    </td>
                </tr>
				</form>
            <tr class="tic">
                <td>会员账号</td>
                <td>真实姓名</td>
                <td>注册时间(美东/北京)</td>
                <td>最近登录(美东/北京)</td>
                <td>当前余额</td>
				<td>有效投注</td>
                <td>在线</td>
                <td>状态</td>
            </tr>
            <?php
			if($uname!=""){
				$sqlwherea	=" and username='$uname'";
			}
            $sql	=	"select uid from k_user where top_uid=$uid and is_daili=0 $sqlwherea order by uid desc";
            $query	=	$mysqli->query($sql);
            $sum	=	$mysqli->affected_rows; //总页数
            $thisPage	=	1;
            if(@$_GET['page']){
                $thisPage	=	$_GET['page'];
            }
            $page		=	new newPage();
            $perpage	= 	8;
            $thisPage	=	$page->check_Page($thisPage,$sum,$perpage);
            $id		=	'';
            $i		=	1; //记录 uid 数
            $start	=	($thisPage-1)*$perpage+1;
            $end	=	$thisPage*$perpage;
            while($row = $query->fetch_array()){
                if($i >= $start && $i <= $end){
                    $id .=	$row['uid'].',';
                }
                if($i > $end) break;
                $i++;
            }
            if($id) {
                $id		=	rtrim($id,',');
                $sql	=	"select u.*,l.is_login from k_user u left outer join k_user_login l on u.uid=l.uid where u.uid in($id) order by u.uid desc";
                $query	=	$mysqli->query($sql);
                $sum_money	=	0;
                $sum_sxf	=	0;
                while($rows = $query->fetch_array()) {
                    ?>
                    <tr class="list">
                        <td><?=$rows["username"]?></td>
                        <td><?=$rows["pay_name"]?></td>
                        <td><?=date("Y-m-d H:i:s",strtotime($rows["reg_date"]))?><br><?=date("Y-m-d H:i:s",strtotime($rows["reg_date"])+1*12*3600)?></td>
                        <td><?=date("Y-m-d H:i:s",strtotime($rows["login_time"]))?><br><?=date("Y-m-d H:i:s",strtotime($rows["login_time"])+1*12*3600)?></td>
                        <td><?=sprintf("%.2f",$rows["money"])?></td>
						<?php
						
						$summoney+=	sprintf("%.2f",$rows["money"]);

						$uid=$rows['uid'];
						$sqla="select money as xiazhu,if(js=1 and win=0,0,money) as yx_xiazhu from c_bet where money>0 and uid=$uid $sqlwhere";
						//var_dump($sqla);
							 $querya	=	$mysqli->query($sqla);
							 $sum_yx_bet_money=0;
							  while($rowsa=$querya->fetch_array()) {
								 $sum_yx_bet_money	+=	$rowsa["yx_xiazhu"];
							  }
							  $sumyx+=$sum_yx_bet_money;

						?>
						<td><?=sprintf("%.2f",$sum_yx_bet_money)?></td>
                        <td><?=$rows["is_login"]==1?"<span class='c_red'>在线</span>":"离线"?></td>
                        <td><?=$rows["is_stop"]==0?"<span class='c_red'>启用</span>":"停用"?></td>
                    </tr>
                    <?php
                }
            } else { ?>
                <tr align="center">
                    <td colspan="7">暂无下级会员！</td>
                </tr>
            <?php } ?>
			<tr class="tic">
			<td>有效下注合计</td>
			<td>-</td>
			<td>-</td>
			<td>-</td>
			<td><?=sprintf("%.2f",$summoney)?></td>
			<td><?=sprintf("%.2f",$sumyx)?></td>
			<td>-</td>
			<td>-</td>
		</tr>
        </table>
		
        <table border="0" cellpadding="0" cellspacing="0" class="page">
            <tr>
                <td align="left">下级会员总数：<span class="c_red"><?=$sum?></span></td>
                <td align="right"><?=$page->get_htmlPage("agent_user.php?");?></td>
            </tr>
        </table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>
