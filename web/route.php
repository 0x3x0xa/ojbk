<?php
session_start();
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/login_check.php");
include_once("common/logintu.php");
include_once("common/function.php");
include_once("cache/website.php");

$lm      = 'route';
$uid     = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid, $loginid);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>Welcome</title>
    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>
    <link type="text/css" rel="stylesheet" href="newindex/zb.css" />
    <script type="text/javascript">
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
</head>
<body class="xieyi">
<!--div class="news">
    <ul>
        <?php
            $sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 3";
            $query = $mysqli->query($sql);
            $i = 1;
            while($rs = $query->fetch_array()) {
                ?>
                <li>[<?=$i?>] <?=$rs['msg']?></li>
        <?php
                $i++;
            }
        ?>
    </ul>
</div-->
<div class="win">
    <div class="agree">
        <div class="logo"></div>
        <ul>
            <li class="tit">用户协议</li>
            <li class="cont">
                <div class="info">
                    <ul>
                        <li>● 01. 为避免出现争议，请您务必在下注之后查看「最新注单」。</li>
                        <li>● 02. 任何投诉必须在开奖之前，本系统不接受任何开奖之后的投诉。</li>
                        <li>● 03. 公布赔率时出现的任何打字错误或非故意人为失误，所有（相关）注单一律不算。</li>
                        <li>● 04. 公布之所有赔率为浮动赔率，下注时请确认当前赔率及金额，下注确认后一律不能修改。</li>
                        <li>● 05. 开奖后接受的投注，一律视为投机漏洞，[本局注单一律不返还本金及盈利]，敬请会员遵守游戏规则。</li>
                        <li>● 06. 若本后台发现客户以不正当的手法投注或投注注单不正常，后台将有权「取消」相应之注单，客户不得有任何异议。</li>
                        <li>● 07. 如因网站问题导致交易内容或其他与账号不符合的，请在开奖前立即与客服联络反映问题，否则将以资料库中的数据为准。</li>
                        <li>● 08. 倘若发生遭黑客入侵破坏行为或不可抗拒之灾害致网站故障或资料损坏、数据丢失等情况，后台将以资料库数据为依据。</li>
                        <li>● 09. 各级管理人员及客户必须对本系统各项功能进行了解及熟悉，任何违反正常使用的操作，后台概不负责。</li>
                        <li>● 10. 请认真了解各款彩票游戏规则。</li>
                        <li ><font color="#FF0000">● 11. 如果会员信用额度超额或者为负数引起的争议，一律以公司处理为准。</font> </li>
                        <li>● 12. 客户有责任确保自己的账户及密码保密，如果因客户的账户、密码简单，或因泄露导致被盗用，造成的损失由客户本人承担；同时应立即通知本公司，并更改其个人详细资料。</li>
                        <li>● 13. 若官方福彩中心开奖错误导致本系统采集数据同时出错情况下当期错误的所有注单以福彩中心官方网站更改后的数据为标准重新结算！在此特别声明，客户不得有任何异议。</li>
                        <li>以上协议解释权归本系统所有。</li>
                        <li>
                            <div class="bar">
                                <span>
									<a href="/logout.php">不同意</a><a href="javascript:void(0)" onclick="agree();">同意</a>
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="btm"></li>
        </ul>
    </div>
</div>
<script type="text/javascript">
    function agree() {
        var n = $(".news");
        if(n.find("li").length > 0) {
            layer.open({
                type: 1,
                area: '500px',
				shift: -1,
                btn: '知道了',
                title: '重要公告',
                content: n,
                yes: function(i) {
                    layer.close(i);
                    location.replace("/main.php");
                }
            });
        } else {
            location.replace("/main.php");
        }
    }
</script>
</body>
</html>