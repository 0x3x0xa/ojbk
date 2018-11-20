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

$sub = 5;

if(!user::is_daili($uid)) {
    message('你还不是代理，请先申请！', "agent_reg.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
	<script type="text/javascript">		
		//radio选择样式
        $(".switch_choose input[type=radio]").click(function(){
	        if($(".switch_choose input[type=radio]:checked").val()){
	       		$(this).next('label').addClass('active').siblings().removeClass('active');
	       	}
        })

	</script>
</head>
<body>
    <div class="wrap">
        <?php include_once("agentmenu.php"); ?>
		<div class="reg">
                <div class="reg_top">
                   
                </div>
                <div>
                    <form id="form1" onsubmit="return regcheck();" action="reg.php" method="post" name="form1">
						<input type="hidden" name="jsr" value="<?=$_SESSION['username']?>"/>
                        <div class="reg_main">
                            <div class="opt switch_choose">
                                <label style="border:none;font-size:12px">用户类型：</label>
                               <!-- <input name="type" id="utype1" value="1" title="代理" type="radio">
								<label class="bk_l" for="utype1">代理</label>-->
								<input name="type" id="utype2" value="0" checked="checked" title="会员" type="radio">
								<label class="bk_r active" for="utype2">会员</label>
                            </div>
                            <div class="opt">
                                <label>用户名：</label>
                                <input id="zcname" name="zcname" placeholder="请输入6-15位的字母数字下划线组合" size="40" maxlength="15" type="text">
                            </div>
                            <div class="opt">
                                <label>密 码：</label>
                                <input id="passwd" name="passwd" placeholder="请输入至少6位的字母数字组合密码" size="40" maxlength="20" type="password">
                            </div>
                            <div class="opt">
                                <label>确认密码：</label>
                                <input id="passwdse" name="passwdse" placeholder="请再次输入密码" size="40" maxlength="20" type="password">
                            </div>
                            <!--<div class="tit">
                                <fieldset>
                                    <legend>个人信息（必填项）</legend>
                                </fieldset>
                            </div>
                            <div class="opt">
                                <label>真实姓名：</label>
                                <input id="realname" name="realname" placeholder="请输入真实姓名(与银行卡开户姓名相同)" maxlength="10" size="40" type="text">
                            </div>
                            <div class="opt">
                                <label>取款密码：</label>
                                <input id="paypasswd" name="paypasswd" placeholder="请输入6位的数字组合密码" maxlength="6" size="40" type="password">
                            </div>
                            -->
                            <div class="reg_btn">
                                <input name="regBtn" class="btn" value="立即开户" type="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".bk_l").click(function(){
				$(".bk_r").removeClass("active");;
				$("#utype2").removeAttr("checked");
				$(this).addClass("active");
				$("#utype1").attr("checked","checked");
			});
			$(".bk_r").click(function(){
				$(".bk_l").removeClass("active");;
				$("#utype1").removeAttr("checked");
				$(this).addClass("active");
				$("#utype2").attr("checked","checked");
			});
		});
	</script>
</body>
</html>
