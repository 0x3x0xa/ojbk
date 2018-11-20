<?php
session_start();
include_once("../include/config.php"); 
include_once("../common/login_check.php"); 
include_once("../include/mysqli.php");
include_once("../common/logintu.php");
include_once("../common/function.php");
include_once("../class/user.php");
$lm='ag2';
$uid = $_SESSION['uid'];
$loginid = $_SESSION['user_login_id'];
renovate($uid,$loginid);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="images/member.js"></script>
    <link type="text/css" rel="stylesheet" href="images/member.css"/>
</head>
<body>
    <div class="wrap">
        <?php include_once("agentsubmenu.php"); ?>
        <table cellspacing="1" cellpadding="0" border="0" class="tab1">
            <tr>
               <td>
				    <p class="c_red">合作伙伴●代理方案</p>
                    <p>福运来彩票网作为知名的在线彩票博彩公司，提供最广范围并最具竞争力的产品。我们真诚为您打造最高档次合作平台，最好的代理加盟方案。八大加盟优势让您无法抗拒！
                    现在您需要进行的是[代理注册]——开始！请点击以上[代理注册]在线提出申请，填写正确的各项资料，代理帐号、姓名、密码务必真实有效，以便为您支付佣金。成功注册后即开通，简单便捷。您可以直接复制您的推广链接进行推广，获取丰厚的佣金。代理联系QQ：251382576</p>
                    <p class="c_red">代理优势</p>
                    <p>1.零风险，高回报，每月准时出佣；</p>
                    <p>2.全年度优惠不断，满足各种类型玩家需求；</p>
                    <p>3.多种支付方式供您选择，让您不会错过任何一笔佣金的支付；</p>
                    <p>4.福运来彩票网营运多年，深受百万玩家信赖；</p>
                    <p>5.多年大力推广，品牌热度十足，代理可坐享广告品牌效应；</p>
                    <p>6.提供顶级彩票产品：北京赛车pk10、幸运飞艇、香港六合彩、重庆时时彩、广东快乐十分、幸运农场等多种游戏。</p>
                    <p>7.市场策略为业界最佳，口碑也是我们最好的营销方式。</p>
                    <p>8.合营团队竭诚为您服务！为您提供多种沟通渠道(在线客服、客服QQ、电话)，支持多种语言，期待为您服务!
您还在还等什么！马上加盟吧，注册加入，开始推广，赚取佣金，简单三步开始成就梦想之旅~
建议您可以通过QQ动态、空间、微信朋友圈、微聊、微博、51、新浪等各大知名论坛进行简单推广，轻轻松松赚钱， 月入百万不是问题！</p>
                    <p>【温馨提示：推广时，注册会员的时候填入您的代理账户或推广代码即可成为您的线下会员，等待领取佣金！】 </p>
                    <p>
	<span style="color:#CCFFFF;"><br>
</span> 
</p>
<table border="1" width="100%" style="font-family:Simsun;">
	<tbody>
		<tr>
			<td colspan="6" align="center" bgcolor="#800000">
				<span style="font-family:'Microsoft YaHei';color:#000000;">项目决定成败 行动决定未来 小小口碑宣传 快速简单赚钱！</span><span> </span> 
			</td>
		</tr>
		<tr>
			<td colspan="6" align="center" bgcolor="#800000">
				<span style="font-family:'Microsoft YaHei';color:#000000;">代理方案：按照客户的负盈利拿佣金（让收益来得更猛烈些!）</span><span> </span> 
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#800000">
				<span style="font-family:'Microsoft YaHei';color:#000000;">当月盈利</span>
			</td>
			<td align="center" bgcolor="#800000">
				<span style="font-family:'Microsoft YaHei';color:#000000;">当月最低有效会员</span>
			</td>
			<td align="center" bgcolor="#800000">
				<span style="font-family:'Microsoft YaHei';color:#000000;">当月退佣比例</span>
			</td>
		</tr>

		<tr>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">100-50000</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">5个或以上</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">18%</span><span> </span> 
			</td>
		</tr>

		<tr>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">50001-100000</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">8个或以上</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">23%</span><span> </span> 
			</td>
		</tr>

		<tr>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">100001-200000</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">15个或以上</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">28%</span><span> </span> 
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">200001-500000</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">30个或以上</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">33%</span><span> </span> 
			</td>
		</tr>
		<tr>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">500001以上</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">60或以上</span><span> </span> 
			</td>
			<td align="center" bgcolor="#FFFFFF">
				<span style="font-family:'Microsoft YaHei';color:#000000;">40%</span><span> </span> 
			</td>
		</tr>
	</tbody>
</table>
<p>
	<span style="color:#00FFFF;"><span style="color:#FF6600;"><span style="color:#FFCC00;"><br>
</span></span></span> 
</p>
                    <p class="c_red">注：代理佣金分成保留上述条例之最终更改权！</p>
                    <p>请谨记：任何使用不诚实方法以骗取佣金将会永久冻结账户，佣金一律不予发还！
新合营商正式确立合作关系之后，须用心推广，前三个月需有每月3个或以上的有效会员增长，否则公司有权终止合作关系。</p>
                    <p class="c_red">佣金计算</p>
                    <p>●计算公式：代理所有会员纯营利 × 退佣比例 × 95%（扣除5%会员充值提款产生的手续费） = 可获得佣金。</p>
                    <p>●每月必须最少有5个活跃会员 (指当月于相关彩种至少投注500元，您的分成条件才能成立。</p>
                    <p>●其中包括 :【当月最低有效会员】定义为，在月结区间（即每月的开始的第一个星期的星期一）内进行过最少五次有效下注的会员，如代理体系当月未达【当月最低有效会员】最低门槛5人，则该月无法领取代理佣金。代理体系当月赢利达到标准，而【当月最低有效会员】人数未达相应最低门槛，则该月佣金比例依照【当月最低有效会员】人数所达门槛相应的百分比进行计算。 示例： 代理当月营利（即纯盈利）为￥100000，而当月有效会员人数为5人，代理虽已达到营利（即纯盈利）为￥100000，却未达到有效会员，则按会员数为5人的标准进行计算！</p>
                    <p>福运来彩票网期待与您一同打拼，共创佳绩！2017展现出您最优秀的成绩，房子、车子、美女将不再是梦 ！</p>
                    <p class="c_red">佣金支付</p>
                    <p>代理佣金计算，结算区间为每月1号到每月最后一天为一个周期，将会员盈利，以代理方案分红公式计算，佣金由承办合作专员（251382576）于次月8号与代理确认佣金后，在2个工作天内将佣金直接汇入代理联盟登记之银行账号。</p>

                </td>
            </tr>
        </table>
    </div>
    <?php include_once('../Lottery/r_bar.php') ?>
    <script type="text/javascript" src="/js/cp.js"></script>
    <script type="text/javascript" src="/js/left_mouse.js"></script>
</body>
</html>