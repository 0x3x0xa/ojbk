<?php
session_start();
$_SESSION['SitePath'] = dirname(__FILE__);
include_once("include/mysqli.php");
include_once("include/config.php");
include_once("common/function.php");
include_once("class/user.php");
include_once("cache/website.php");
include_once("cache/conf.php");
include_once("include/mobile_detect.php");
include_once("common/logintu.php");
include_once("cache/conf.php");
include_once("cache/website.php");

$lm = 'login';

if($_POST["act"] == "login") {

    $uid = user::login(htmlEncode($_POST["username"]), htmlEncode($_POST["passwd"]));

    if(!$uid) {
        echo '2'; //用户名或密码错误
        exit;
    }
    echo '1'; //成功
    exit;
}

/**
* 地区限制功能
*/
include_once("ip.php");
include_once("cache/dqxz.php");
$address    =    '='.iconv("GB2312","UTF-8",convertip($_SERVER["REMOTE_ADDR"]));   //取出客户端IP所在城市
foreach($dqxz as $k=>$v){
    if(strpos($address,$v)){
        header("location:lndex.php");
        exit;
    }
}

function prefix_url(){
         $s = !isset($_SERVER['HTTPS']) ? '' : ($_SERVER['HTTPS'] == 'on') ? 's' : '';
            
         $protocol = strtolower($_SERVER['SERVER_PROTOCOL']);
         $protocol = substr($protocol,0,strpos($protocol,'/')).$s.'://';
            
         $port     = ($_SERVER['SERVER_PORT']==80) ? '' : ':'.$_SERVER['SERVER_PORT'];
            
         $server_name = isset($_SERVER['HTTP_HOST']) ? strtolower($_SERVER['HTTP_HOST']) : isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'].$port :
                        getenv('SERVER_NAME').$port;
         return $server_name;
}

if(isset($_GET['f'])){
    $sql    =    "select uid from k_user where username='".htmlEncode($_GET['f'])."' and is_daili=1 limit 1";
    $query    =    $mysqli->query($sql); //要是代理
    $rs        =    $query->fetch_array();
    if(intval($rs["uid"])){
        setcookie('f',intval($rs["uid"]));
        setcookie('tum',htmlEncode($_GET['f']));
        $indexurl = "myreg.php";
    }
} else{
	$arr = explode('.',prefix_url()); //用 . 号截取url分割

    $f = $arr[0];


    if($f!='www' && $f!='' && $f!='wap'){
       $sql    =    "select uid from k_user where username='".htmlEncode($f)."' and is_daili=1 limit 1";
        $query    =    $mysqli->query($sql); //要是代理
        $rs        =    $query->fetch_array();
        if(intval($rs["uid"])){
            setcookie('f',intval($rs["uid"]));
            setcookie('tum',htmlEncode($f));
            $indexurl = "myreg.php";
        }
    }
}

$agent = check_wap();
if( $agent )
{
 header('Location: http://127.0.0.5');
 exit;
}
// check if wap
function check_wap(){
 // 先检查是否为wap代理，准确度高
 if(stristr($_SERVER['HTTP_VIA'],"wap")){
   return true;
 }
 // 检查浏览器是否接受 WML.
 elseif(strpos(strtoupper($_SERVER['HTTP_ACCEPT']),"VND.WAP.WML") > 0){
   return true;
 }
 //检查USER_AGENT
 elseif(preg_match('/(blackberry|configuration\/cldc|hp |hp-|htc |htc_|htc-|iemobile|kindle|midp|mmp|motorola|mobile|nokia|opera mini|opera |Googlebot-Mobile|YahooSeeker\/M1A1-R2D2|android|iphone|ipod|mobi|palm|palmos|pocket|portalmmm|ppc;|smartphone|sonyericsson|sqh|spv|symbian|treo|up.browser|up.link|vodafone|windows ce|xda |xda_)/i', $_SERVER['HTTP_USER_AGENT'])){
   return true;      
 }
 else{
   return false; 
 }
}

$sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 1";
$query = $mysqli->query($sql);
$rs = $query->fetch_assoc();
$list = $rs['msg'];


$detect = new Mobile_Detect;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>星耀娱乐乐园</title>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7">
    <script type="text/javascript" src="dsn/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="dsn/js/common.js"></script>
    <script type="text/javascript" src="dsn/js/upup.js"></script>
    <script type="text/javascript" src="dsn/js/float.js"></script>
    <script type="text/javascript" src="dsn/js/swfobject.js"></script>
    <script type="text/javascript" src="dsn/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="dsn/js/jingcheng.js"></script>
    <script type="text/javascript" src="dsn/js/top.js"></script>
	<link rel="stylesheet" href="dsn/css/default.css">
	<script language="javascript" src="dsn/js/artDialog.js"></script>
	<script language="javascript" src="dsn/js/iframeTools.js"></script>
    <script type="text/javascript" src="dsn/js/tab.js"></script>
    <script type="text/javascript" src="dsn/js/superslide.2.1.js"></script>
	<script type="text/javascript" src="dsn/js/form.min.js"></script>
<link rel="stylesheet" href="dsn/css/jquery-ui.css">
<link rel="stylesheet" href="dsn/css/stylesheet.css">
<link rel="stylesheet" href="dsn/css/main.css">
<link rel="stylesheet" href="dsn/css/style.css">
<link rel="stylesheet" href="dsn/css/index.css">
<script src="dsn/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="dsn/js/jquery-ui.js"></script>
<script type="text/javascript" src="dsn/js/dialog.js"></script>
<script type="text/javascript" src="dsn/js/libs.js"></script>
<script type="text/javascript" src="dsn/js/login.js"></script>
<script type="text/javascript" src="dsn/js/common.js"></script>	
<link rel="stylesheet" href="dsn/css/jquery.bxslider.css">
<script type="text/javascript" src="dsn/js/index.js"></script>

    <script type="text/javascript" src="skin/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="skin/js/form.min.js"></script>
    <script type="text/javascript" src="newindex/js/superslide.2.1.js"></script>
    <script type="text/javascript" src="js/layer.js"></script>

    <script type="text/javascript">由于
        if (self == top) {
            location = '/';
        }
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>

		<script>
			var stat1 = 25;
			var statprogress1 = 25;  // 25%, percentage
			var stat2 = 120;
			var statprogress2 = 65;  // 65%, e
			var stat3 = 34;
			var affType = 0;
		</script>
    </head>
    <body id="bodyid" marginwidth="0" marginheight="0">
	<div class="" style="display: none; position: absolute;"><div class="aui_outer"><table class="aui_border"><tbody><tr><td class="aui_nw"></td><td class="aui_n"></td><td class="aui_ne"></td></tr><tr><td class="aui_w"></td><td class="aui_c"><div class="aui_inner"><table class="aui_dialog"><tbody><tr><td colspan="2" class="aui_header"><div class="aui_titleBar"><div class="aui_title" style="cursor: move; display: block;"></div><a class="aui_close" href="javascript:/*artDialog*/;" style="display: block;">×</a></div></td></tr><tr><td class="aui_icon" style="display: none;"><div class="aui_iconBg" style="background: none;"></div></td><td class="aui_main" style="width: auto; height: auto;"><div class="aui_content" style="padding: 20px 25px;"></div></td></tr><tr><td colspan="2" class="aui_footer"><div class="aui_buttons" style="display: none;"></div></td></tr></tbody></table></div></td><td class="aui_e"></td></tr><tr><td class="aui_sw"></td><td class="aui_s"></td><td class="aui_se" style="cursor: se-resize;"></td></tr></tbody></table></div></div>
<div class="top">
        <div class="g_w1">
            <div class="time_box">
               <span class="date showTime"></span> 营业时间：白天07:30 - 凌晨04:00 / 全年无休</div>
            <div class="oper_box">
                <div class="login">
	  <form id="loginForm" id="loginForm" name="form1" action="#" method="post" onsubmit="return check_login();">  
     <i class="icon icon-user"></i>
	  <a href="myreg.php"><button type="button" id="btn-register" class="btn btn-red" title="注册">注册</button></a>
      <input id="username" type="text" name="username" value=""  placeholder="用户名"  class="userid form-control">
	  
      <input id="passwd" type="password" name="passwd" value=""  placeholder="******"  class="password form-control">
	  
      <input id="rmNum" type="text" name="rmNum"  class="password form-control">
	  
      <img src="yzm.php" onclick="getKey()" alt="点击更换" id="vPic" style="background-color:burlywood;margin-left: -40px;" height="28" width="45" class="yzmimg">
	  
	  <input type="hidden" name="act" value="login">
	  <input id="loginBtn" type="submit" title="登录" name="rmNumm" value="登录" onClick="loginBtn" class="btn btn-red" style="opacity: 1; pointer-events: auto;">
	  
	  <a href="guest.php"><button type="button" class="btn btn-blue" title="点击即可登录试玩帐号">试玩登录</button></a>
	  <a target="_blank" href="<?=$web_site["web_kf"]?>"><div" class="btn btn-yellow"><div style="margin-top:2px; ">
	  <img src="dsn/images/mic.png"></div><div style="margin-left:4px; margin-top: 0;" title="点击即可联系在线客服">在线客服</div></div"></a>
       </form>	
			</div>
                   <script type="text/javascript">
                        function getKey() {
                            $("#vPic").attr("src",'yzm.php?_='+Math.random()+(new Date).getTime());
                            $("input[name='rmNum']").val("").focus();
                        }
                        $("#loginForm").submit(function() {
                            aLeftForm1Sub($(this));
                            return false;
                        });
                    </script>			

            </div>
            <div class="g_glear"></div>
        </div>
        <div class="g_glear"></div>
    </div>

    <div class="topmenu">
        	<div class="g_w1">
            	<div class="logo"><a href="/"><img src="dsn/images/logo.png" width="244" height="59" alt=""></a>
                </div>
                <div class="menulinks clearfix">
                	<a href="/" class="sublinks menuactive">网站首页</a>
                    <a href="/myreg.php" class="sublinks">开户注册</a>
                    <a href="/myhot.php" class="sublinks">优惠活动</a>
                    <a href="/webline.php" target="_blank" class="trade sublinks">线路检测</a>
                    <a href="/myproblem.php" class="sublinks">常见问题</a>
                    <a href="/mywap.php" class="sublinks">手机投注</a>
                    <a href="/myjoin.php" target="_blank" class="sublinks">加盟合作</a>
                </div>
            </div>
    </div>        	<div class="banner">
        	<div class="bx-wrapper" style="max-width: 100%;">
			<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 419px;">
			<div class="bx-wrapper" style="max-width: 100%;">
			<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 419px;">
			<ul class="bxslider" style="width: 715%; position: relative; transition-duration: 0.5s; transform: translate3d(-7160px, 0px, 0px);">
<li style="float: left; list-style: none; position: relative; width: 1432px; background: url(dsn/images/homebanner.jpg) 50% 50% no-repeat;"></li>
<li style="float: left; list-style: none; position: relative; width: 1432px; background: url(dsn/images/homebanner2.jpg) 50% 50% no-repeat;"></li>
<li style="float: left; list-style: none; position: relative; width: 1432px; background: url(dsn/images/homebanner3.jpg) 50% 50% no-repeat;"></li>
</ul></div>

            <!--div class="bx-controls bx-has-pager">
			<div class="bx-pager bx-default-pager">
			<div class="bx-pager-item"><a data-slide-index="0" class="bx-pager-link active">1</a></div>
			<div class="bx-pager-item"><a  data-slide-index="1" class="bx-pager-link">2</a></div>
			</div>
			</div-->
			</div>
			</div>
			<!--div class="bx-controls bx-has-pager">
			<div class="bx-pager bx-default-pager">
			<div class="bx-pager-item">
			<a  data-slide-index="0" class="bx-pager-link">1</a></div><div class="bx-pager-item">
			<a  data-slide-index="1" class="bx-pager-link">2</a></div><div class="bx-pager-item">
			<a  data-slide-index="2" class="bx-pager-link">3</a></div></div></div--></div>
        </div>
        <div class="btncontainer">
        	<div class="g_w1">
                <div class="btnclose">
                </div>  
            </div>
        </div>
        <div class="prizeinfo">
       	  <div class="g_w1 clearfix" style="height: 41px;position:relative;">
                <img src="dsn/images/dot.png" width="217" height="13" style="position: absolute; left: 392px; top: 90px;">
                <div class="col1">
                    <div class="col_header1">
                    	<div class="iconchat1"><img src="dsn/images/icon_chat.png" width="27" height="27" alt=""></div>
                      <div class="coltxt">
                      		<ul id="ticker1">
    <?php
        $sql = "select msg from k_notice where end_time>now() and is_show=1 order by sort desc, nid desc limit 5";
        $query = $mysqli->query($sql);
        $list = '';
        while($rs = $query->fetch_array()) {
            $list .= $rs['msg'] . ' | ';
        }
    ?>
            <?php
                $query->data_seek(0);
                $i = 1;
                while($rs = $query->fetch_array()) {
                    ?>
                    <li>[<?=$i?>] <?=$rs['msg']?></li>
            <?php
                    $i++;
                }
            ?>
			
<!--li style="display: list-item;">极速网络2017精仿星耀娱乐乐园时时彩盘口。</a></li>
<li style="display: list-item;">专业开发娱乐城、时时彩、百家乐、电子游艺线上娱乐城。</a></li>
<li style="display: list-item;">极速网络 www.js12340.com  QQnmzlsb</a></li></ul-->
                      </div>
                    
               	  </div>
               	  <div class="col_subhead">
                   	<div class="col_icon1">
                   	  		<img src="dsn/images/icon_prize1.png" width="60" height="60" alt=""> 
                   	  </div>
                        <div class="col_headtxt1"><img src="dsn/images/header_prize1.png" width="121" height="26" alt=""></div>
               	  </div>
                    
                    <div class="col_img">
                    	<a href="/">
                    	</a><div class="bx-wrapper" style="max-width: 100%;">
						<a href="/"><div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 154px;">
						<div class="bx-wrapper" style="max-width: 100%;">
						<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 154px;">
						<ul class="bxslider2" style="padding-top: 10px; width: auto; position: relative;">
                          <li style="float: none; list-style: none; position: absolute; width: 460px; z-index: 0; display: none;">
						  <div class="prizecontainer">
                          <div class="col1">
                            <img src="dsn/images/1.png" width="126" height="126" alt="" class="clearfix"> 
                          </div>
                          <div class="divider2"></div>
                          <div class="col1">
                            <img src="dsn/images/2.png" width="126" height="126" alt="" class="clearfix">
                          </div>
                          <div class="divider2"></div>
                          <div class="col1">
                            <img src="dsn/images/3.png" width="126" height="126" alt="" class="clearfix"> 
                          </div>
                        </div></li>
                          <li style="float: none; list-style: none; position: absolute; width: 460px; z-index: 50; display: list-item;"><div class="prizecontainer">
                          <div class="col1">
                            <img src="dsn/images/4.png" width="126" height="126" alt="" class="clearfix"> 
                          </div>
                          <div class="divider2"></div>
                          <div class="col1">
                            <img src="dsn/images/5.png" width="126" height="126" alt="" class="clearfix"> 
                          </div>
                          <div class="divider2"></div>
                          <div class="col1">
                            <img src="dsn/images/6.png" width="126" height="126" alt="" class="clearfix"> 
                          </div>
                        </div></li>
                        <li style="float: none; list-style: none; position: absolute; width: 460px; z-index: 0; display: none;"><div class="prizecontainer">
                          <div class="col1">
                            <img src="dsn/images/7.png" width="126" height="126" alt="" class="clearfix"> 
                          </div>
                          <div class="divider2"></div>
                          <div class="col1">
                            <img src="dsn/images/8.png" width="126" height="126" alt="" class="clearfix"> 
                          </div>
                          <div class="divider2"></div>
                          <div class="col1">
                            <img src="dsn/images/9.png" width="126" height="126" alt="" class="clearfix"> 
                          </div>
                        </div></li>
                        </ul></div><div class="bx-controls bx-has-pager"><div class="bx-pager bx-default-pager">
						<div class="bx-pager-item"><a href="/" data-slide-index="0" class="bx-pager-link">1</a></div>
						<div class="bx-pager-item"><a href="/" data-slide-index="1" class="bx-pager-link active">2</a></div>
						<div class="bx-pager-item"><a href="/" data-slide-index="2" class="bx-pager-link">3</a></div>
						</div>
						</div>
						</div>
						</div>
						</a>
						<div class="bx-controls bx-has-pager"><a href="/"></a>
						<div class="bx-pager bx-default-pager"><a href="/"></a>
						<div class="bx-pager-item"><a href="/"></a>
						<a href="/" data-slide-index="0" class="bx-pager-link active">1</a></div>
						<div class="bx-pager-item"><a href="/" data-slide-index="1" class="bx-pager-link">2</a></div>
						<div class="bx-pager-item"><a href="/" data-slide-index="2" class="bx-pager-link">3</a></div>
						</div></div></div>
                        
                    </div>
            </div>
                
                <div class="col2">
                	<div class="col_header2">
                    	<div class="iconchat2"><img src="dsn/images/icon_chat.png" width="27" height="27" alt=""></div>
                        <div class="coltxt" id="trans_list"><ul id="ticker2">
	<li>[1] 恭喜会员 xu*** 提款1000元成功，请及时查看账目。</li> 
	<li>[2] 恭喜会员 ww*** 提款5000元成功，请及时查看账目。</li> 
	<li>[3] 恭喜会员 qq*** 提款250元成功，请及时查看账目。</li> 
	<li>[4] 恭喜会员 ha*** 提款110元成功，请及时查看账目。</li> 
	<li>[5] 恭喜会员 zh*** 提款30000元成功，请及时查看账目。</li> 
	<li>[6] 恭喜会员 qi*** 提款11509元成功，请及时查看账目。</li> 
	<li>[7] 恭喜会员 16*** 提款1498元成功，请及时查看账目。</li>  
<li style="display: list-item;">[8] 恭喜会员 li*** 提款300元成功，请及时查看账目。</li>
<li style="display: list-item;">[9] 恭喜会员 pp*** 提款240元成功，请及时查看账目。</li>
<li style="display: list-item;">[10] 恭喜会员 cz*** 提款330元成功，请及时查看账目。</li>
<li style="display: list-item;">[11] 恭喜会员 we*** 提款1000元成功，请及时查看账目。</li>
<li style="display: list-item;">[12] 恭喜会员 aa*** 提款100元成功，请及时查看账目。</li>
<li style="display: list-item;">[13] 恭喜会员 gg*** 提款1000元成功，请及时查看账目。</li>
<li style="display: list-item;">[14] 恭喜会员 t1*** 提款200元成功，请及时查看账目。</li>
<li style="display: list-item;">[15] 恭喜会员 13*** 提款1000元成功，请及时查看账目。</li>
<li style="display: list-item;">[16] 恭喜会员 18*** 提款1000元成功，请及时查看账目。</li>
<li style="display: list-item;">[17] 恭喜会员 13*** 提款500元成功，请及时查看账目。</li>
<li style="display: list-item;">[18] 恭喜会员 cc*** 提款4620元成功，请及时查看账目。</li>
<li style="display: list-item;">[19] 恭喜会员 31*** 提款1700元成功，请及时查看账目。</li>
<li style="display: list-item;">[20] 恭喜会员 13*** 提款2000元成功，请及时查看账目。</li></ul></div>
                    </div>
                    <div class="col_subhead2">
                   	  <div class="col_icon2">
                   	  		<img src="dsn/images/icon_prize2.png" width="60" height="60" alt=""> 
                   	  </div>
                        <div class="col_headtxt2"><img src="dsn/images/header_prize2.png" width="104" height="26" alt=""></div>
                  	</div>
                    
                     <div class="col_img2">
                               <div class="prizecontainer2" style="padding-top:10px;">
                                    <div class="col1"><img src="dsn/images/prize2.jpg" width="182" height="154" alt=""></div>
                                    <div class="col2">
                                    	<div class="bx-wrapper" style="max-width: 100%;">
										<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 109px;">
										<div class="bx-wrapper" style="max-width: 100%;">
										<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 109px;">
										<ul class="bxslider3" style="width: auto; position: relative;">
                                        	<li style="float: none; list-style: none; position: absolute; width: 275px; z-index: 50; display: block;">
											<a href="/">
                                            <h1>星耀娱乐乐园</h1>
                                            <h2>敬请期待，更多活动...</h2>
                                            <p>时间：2017-1-28至2017-1-31截止</p>
                                            </a></li>
                                        </ul></div><div class="bx-controls bx-has-pager">
										<div class="bx-pager bx-default-pager">
										<div class="bx-pager-item">
										<a href="/" data-slide-index="0" class="bx-pager-link active">1</a></div>
										</div>
										</div>
										</div>
										</div>
										<div class="bx-controls bx-has-pager">
										<div class="bx-pager bx-default-pager">
										<div class="bx-pager-item">
										<a href="/" data-slide-index="0" class="bx-pager-link active">1</a>
										</div>
										</div>
										</div>
										</div>
                                    </div>
                                </div>
               	     </div>
                </div>
                
         	 </div>
        </div>
        
<div class="gamelist">
			<div class="gameitms g_w1 bxslider5">

<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=12" target="_blank" class="pcegg" style="display: inline-block;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=5" target="_blank" class="sscjsc" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=1" target="_blank" class="pk10jsc" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=4" target="_blank" class="bjpk10" style="display: inline-block;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=1" target="_blank" class="cqssc" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=11" target="_blank" class="hk6" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=6" target="_blank" class="xync" style="display: inline-block;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=6" target="_blank" class="gd11x5" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=1" target="_blank" class="cqssc" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=3" target="_blank" class="xjssc" style="display: inline-block;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=2" target="_blank" class="tjssc" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=7" target="_blank" class="gdklsf" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=13" target="_blank" class="aulucky20" style="display: inline-block;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=9" target="_blank" class="f3d" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=10" target="_blank" class="pl3" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=14" target="_blank" class="more" style="display: inline-block;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=15" target="_blank" class="more" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=14" target="_blank" class="more" style="display: none;"></a>
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=15" target="_blank" class="more" style="display: inline-block;"></a>	
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=14" target="_blank" class="more" style="display: none;"></a>	
<a onclick="alert(&quot;您尚未登录，请先登录后在进行游戏&quot;); return false;" href="/main.php?t=15" target="_blank" class="more" style="display: none;"></a>					
            </div>
        </div>
        
        <div class="prodcontainer">
        	<div class="g_w1">
            	<div class="col1">
               	  <div class="spechd clearfix">
                    	<div class="specicon">
                   	    <img src="dsn/images/icon_service.jpg" width="46" height="51" alt=""> </div>
                        <div class="spectxt">
                        	<h1>服务优势</h1>
                            <p>Service advantages</p>
                        </div>
                    </div>
                  	<div class="specdetail">
                   	  <div class="specleft">
                       	<div class="cci_title">存款到账</div>
                        <p>平均时间</p>
                      </div>
                    	<div class="specright">
                        	<div class="number1" id="count1">25</div><div class="number1txt">秒</div>
                        </div>
                    </div>
                    <div class="specgraph">
                    	<div class="stats1"><div class="stats2" id="bar1"></div></div>
                    </div>
                  <div class="specdetail">
                   	  <div class="specleft">
                       	<div class="cci_title">取款到账</div>
                        <p>平均时间</p>
                      </div>
                    	<div class="specright">
                        	<div class="number1" id="count2">2‘00</div><div class="number1txt">分</div>
                        </div>
                    </div>
                    <div class="specgraph">
                    	<div class="stats1"><div class="stats2" id="bar2"></div></div>
                    </div>
                	<div class="specdetail">
                    	<div class="specleft2">
                       		<div class="cci_title">便捷的银行服务</div>
                        	<p><img src="dsn/images/creditcard.jpg" width="118" height="26" alt=""></p>
							<p class="card_count">目前我们支付机构有：</p>
                        </div>
                        <div class="specright">
                        	<div class="number1 bank_number" id="count3">34</div><div class="number1txt bank_numbertxt">家</div>
                        </div>
                    </div>
                
                
                </div>
                <div class="divider"></div>
                <div class="col2">
                	<div class="spechd clearfix">
                    	<div class="specicon2">
                   	    <img src="dsn/images/icon_advantage.jpg" width="49" height="49" alt=""> </div>
                        <div class="spectxt">
                        	<h1>产品优势</h1>
                            <p>Product advantages</p>
                        </div>
                    </div>
                  	
                	<div class="specdetail2">
                       	<div class="cci_title">手机客户端</div>
                        <p>独家提供苹果/安卓客户端，您可以通过手机客户端畅玩所有彩票游戏。</p>
                    </div>
                    <div class="specdetail2">
                       	<div class="cci_title">手机触屏版</div>
                        <p>专注彩票，独家提供手机触屏网页版，无需下载，打开网页即可下注畅玩，兼容完美。</p>
                    </div>
                    <div class="specdetail2">
                       	<div class="cci_title">彩票百家乐平台</div>
                        <p>独家开发北京赛车百家乐，业界最公平的百家乐游戏，5分钟一期、先开奖开牌再对牌。</p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="col3">
                	<div class="spechd clearfix">
                    	<div class="specicon2">
                   	    <img src="dsn/images/icon_lion.jpg" width="49" height="49" alt=""> </div>
                        <div class="spectxt">
                   	    <img src="dsn/images/lionimg.jpg"> 
                        	<h2>会员大额提现均可在<br>澳门<span class="orange">威尼斯人酒店</span>提现。</h2>
                            <p>单日可提款<span class="orange textbig">1000</span>万人民币。</p>
                        </div>
                    </div>
                    
                    <div class="spechd clearfix">
                    	<div class="specicon2">
                   	    <img src="dsn/images/icon_licience.jpg" width="49" height="49" alt=""> </div>
                        <div class="spectxt">
                        	<h1>牌照</h1>
                            <p>License</p>
                      </div>
                    </div>
                  	
                    <div class="specdetail2">
                        <p style="margin:0">星耀娱乐乐园是由菲律宾政府卡格扬河经济特区所授权和监管，拥有菲律宾政府自2005年颁发、最具历史的牌照。</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="blueline">
        </div>
        
        <div class="prodcontainer prodcontainer2">
        	<div class="g_w1">
           	  <div class="col1">
               	  <div class="spechd clearfix">
                    	<div class="specicon">
                   	    <img src="dsn/images/icon_innovative.jpg" width="46" height="51" alt=""> </div>
                        <div class="spectxt">
                        	<h1>颠覆性创新设计</h1>
                            <p>Innovative Design</p>
                        </div>
                    </div>
                  	<div class="specfull">
						<div class="bx-wrapper" style="max-width: 100%;">
						<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 246px;">
						<div class="bx-wrapper" style="max-width: 100%;">
						<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 266px;">
						<div class="bx-wrapper" style="max-width: 100%;">
						<div class="bx-viewport" style="width: 100%; overflow: hidden; position: relative; height: 266px;">
						<ul class="bxslider4" style="width: auto; position: relative;">
                          <li style="float: none; list-style: none; position: absolute; width: 320px; z-index: 0; display: none;">
						  <img src="dsn/images/innovative1.jpg" width="330" height="118" alt="">
                          		<div class="specdetail">
                    				<div class="cci_title">北京赛车百家乐</div>
                                    <p>官方开奖视频，业界最公平公正，重新百家乐游戏， 5分钟一期，全天179期。</p>
                    			</div>
                          </li>
                          <li style="float: none; list-style: none; position: absolute; width: 320px; z-index: 50; display: list-item;"><img src="dsn/images/innovative2.jpg" width="330" height="118" alt="">
                          		<div class="specdetail">
                    				<div class="cci_title">接地气本土服务</div>
                                    <p>青春洋溢的星耀娱乐团队在最贴近生活的方式下设计出一款款高端大气的产品，为各国用户带来最为接地气的个性化本土定制服务。</p>
                    			</div>
                          </li>
                          <li style="float: none; list-style: none; position: absolute; width: 320px; z-index: 0; display: none;"><img src="dsn/images/innovative3.jpg" width="330" height="118" alt="">
                          		<div class="specdetail">
                    				<div class="cci_title">颠覆性产品</div>
                                    <p>每款全新上线的星耀娱乐产品都是经过大量测试后证实最符合亚洲人的产品，这是一个对既定现状做出强势挑战的创新团队。</p>
                    			</div>
                          </li>
                       </ul></div>
					   <!--div class="bx-controls bx-has-pager">
					   <div class="bx-pager bx-default-pager">
					   <div class="bx-pager-item"><a data-slide-index="0" class="bx-pager-link">1</a></div>
					   <div class="bx-pager-item"><a ata-slide-index="1" class="bx-pager-link active">2</a></div>
					   <div class="bx-pager-item"><a data-slide-index="2" class="bx-pager-link">3</a></div>
					   </div>
					   </div-->
					   </div>
					   </div>
					   <!--div class="bx-controls bx-has-pager">
					   <div class="bx-pager bx-default-pager">
					   <div class="bx-pager-item"><a data-slide-index="0" class="bx-pager-link active">1</a></div>
					   <div class="bx-pager-item"><a data-slide-index="1" class="bx-pager-link">2</a></div>
					   <div class="bx-pager-item"><a data-slide-index="2" class="bx-pager-link">3</a></div>
					   </div>
					   </div-->
					   </div>
					   </div>
					   </div>
					   </div>
                  	</div>
              </div>
                <div class="divider"></div>
                <div class="col2">
                	<div class="spechd clearfix">
                    	<div class="specicon2">
                   	    <img src="dsn/images/icon_partner.jpg" width="49" height="49" alt=""> </div>
                        <div class="spectxt">
                        	<h1>合作伙伴</h1>
                            <p>Artners</p>
                        </div>
                    </div>
                  	
                	<div class="specdetail2">
               	    <img src="dsn/images/payment.jpg" width="190" height="192" alt=""> </div>
                </div>
                <div class="divider"></div>
                <div class="col3">
                	<div class="spechd clearfix">
                    	<div class="clearfix">
                            <div class="specicon2">
                            <img src="dsn/images/icon_guide.jpg" width="49" height="49" alt=""> </div>
                            <div class="spectxt clearfix">
                                <h1>使用帮助</h1>
                                <p>Guide</p>
                            </div>
                        </div>
                        <div class="specdetail2 mt10">
                        	<div class="col1"><p><a href="/myproblem.php">如何存款</a><br><a href="/myproblem.php">如何提款</a></p></div>
                            <div class="col2"><p><a href="/myproblem.php">隐私及政策</a></p></div>
                            <div class="col3"><p><a href="/myproblem.php">联系我们</a><br><a href="/myproblem.php">规则与条款</a></p></div>
                        </div>
                        <div class="greyline"></div>
                        <div class="specdetail2">
                        	<div class="cci_title">推荐浏览器</div>
                            <p><a href="http://www.firefox.com.cn/" target="_blank">火狐浏览器</a><br><a href="http://rj.baidu.com/soft/detail/14744.html?ald" target="_blank">谷歌浏览器</a><br><a href="http://rj.baidu.com/soft/detail/23356.html?ald" target="_blank">IE 9 以上浏览器</a></p>
                        </div>
                    </div>
                </div>
            </div>
<div class="footernavi2">
        	<div class="footercontainer bothborder">
            	<div class="col4 borderleft borderright">
                	<div class="footercontent">
						<!--<a href="https://1380tt.com" target="_blank"><img src="/newdsn/images/cash/footerlogo1.jpg" width="151" height="80" alt=""></a>-->
                    </div>
              	</div>
                <div class="col5 borderleft borderright">
                	<div class="footercontent">
						<!--<a href="http://sgwin123.com" target="_blank"><img src="/newdsn/images/cash/footerlogo2.jpg" width="168" height="80" alt=""></a>-->
                  	</div>
                </div>
                <div class="col6 borderleft borderright">
                	<div class="footercontent">
						<!--<a href="http://1680180.com/" target="_blank"><img src="/newdsn/images/cash/footerlogo3.jpg" width="160" height="80" alt=""></a>-->
               	  </div>
                </div>
            </div>
        </div> 
        <div class="footerindex2">
            (c)2013-2017  星耀娱乐乐园。All Rights Reserved.
         </div>
  <div class="left_adv">
    <a href="/webline.php" target="_blank"><img src="dsn/images/MQ2.png"></a>
  </div>

<div class="socialnavi">
	<!--<div class="wechatqr">
		<img src="dsn/images/wechat_qr1.png" alt="">
	</div>
	<div class="downloadqr" style="display: none;"><p>极速网络<br>js12340.com</p></div>
	<div class="qq" onclick="javascript:window.open(&#39;tencent://message/?uin=nmzlsb&amp;Site=BY&amp;Menu=yes&#39;,&#39;_blank&#39;)"></div>
	<div class="wechat" onclick=""></div>
	<div class="livechat" onclick="javascript:window.open(&#39;tencent://message/?uin=nmzlsb&amp;Site=BY&amp;Menu=yes&#39;,&#39;_blank&#39;)"></div>
	<div class="download" onclick="javascript:window.open(&#39;tencent://message/?uin=nmzlsb&amp;Site=BY&amp;Menu=yes&#39;,&#39;_blank&#39;)"></div>
	<div>-->
		<a href="javascript:;" onclick="scrolltop();" class="scrolltop" style="display: none;"><img src="dsn/images/support_top.png" width="50" height="50" alt=""></a>
	</div>

</div>
<script src="dsn/js/jquery.bxslider.min.js"></script>
<script src="dsn/js/plugins.js"></script>
<script src="dsn/js/main.js"></script>    <script type="text/javascript">
    $(".slide").hover(function() {
        $(".prev", $(this)).fadeIn(200);
        $(".next", $(this)).fadeIn(200);
    }, function() {
        $(".prev", $(this)).fadeOut(100);
        $(".next", $(this)).fadeOut(100);
    });
    jQuery(".slide").slide({ titCell:".hd ul", mainCell:".bd ul", effect:"fold",  autoPlay:true, autoPage:true, trigger:"click" });
    jQuery(".buy_list").slide({mainCell: ".bd ul", autoPage: true, effect: "topLoop", autoPlay: true, interTime: 1000, vis: 4});
</script>

<div style="display: none; position: fixed; left: 0px; top: 0px; width: 100%; height: 100%; cursor: move; opacity: 0; background: rgb(255, 255, 255);"></div>
	<script type="text/javascript">
		function check_login() {
			var frm = $("#loginForm");
			var opt = {
				beforeSubmit: function() {
					if($("#username").val() == "") {
						layer.alert('请输入您的账号！', function(i) {
							$("#username").focus();
							layer.close(i);
						});
						return false;
					}
					if($("#passwd").val() == "") {
						layer.alert('请输入您的密码！', function(i) {
							$("#passwd").focus();
							layer.close(i);
						});
						return false;
					}
					$("#loginBtn").attr("disabled", true);
				},
				success: function(data) {
					if(data.indexOf("3") >= 0) {
						layer.alert('账号异常无法登陆，如有疑问请联系在线客服！', function(i) {
							$("#passwd").val("");
							$("#username").val("").focus();
							$("#loginBtn").attr("disabled", false);
							layer.close(i);
						});
					} else if(data.indexOf("2") >= 0) {
						layer.alert('账号或密码错误，请重新输入！', function(i) {
							$("#passwd").val("");
							$("#username").val("").focus();
							$("#loginBtn").attr("disabled", false);
							layer.close(i);
						});
					} else if(data.indexOf("1") >= 0) {
						top.location.href = "/route.php";
					}
				}
			};
			frm.ajaxSubmit(opt);
			return false;
		}
	</script>
</body>
</html>