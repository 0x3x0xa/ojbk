<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
    <title>星耀娱乐乐园</title>
	<script type="text/javascript" src="dsn/js/jquery-1.7.2.min.js?_=171"></script>
    <script type="text/javascript" src="dsn/js/superslide.2.1.js"></script>
    <script type="text/javascript" src="dsn/js/layer.js"></script>
<link rel="stylesheet" href="dsn/css/login.css">
<link rel="stylesheet" href="dsn/css/jquery-ui.css">
<link rel="stylesheet" href="dsn/css/stylesheet.css">
<link rel="stylesheet" href="dsn/css/main.css?v=1226">
<link rel="stylesheet" href="dsn/css/style.css">
<link rel="stylesheet" href="dsn/css/index.css?v=01212017">
    <script type="text/javascript">
        if (window.location.host != top.location.host) {
            top.location = window.location;
        }
    </script>
</head>
<body>
 

<form id="form1" onsubmit="return regcheck();" action="reg.php" method="post" name="form1">
		<div class="g_w1 clearfix body_bg">
			<div class="row mt35 clearfix">
				<div class="col1">登录账号:</div>
				<div class="col2">
					<input id="zcname" name="zcname" type="text" maxlength="15" class="textbox1">
				</div>
				<div id="nameTips" class="col3">＊帐户名由6-10个字符组成</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">登陆密码:</div>
				<div class="col2">
					<input id="passwdse" name="passwdse" type="password" maxlength="20" class="textbox1">
				</div>
				<div class="col3">＊6-20个字母、数字或组合组成，区分大小写</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">确认密码:</div>
				<div class="col2">
					<input id="passwdse" name="passwdse" type="password" maxlength="20" class="textbox1">
				</div>
				<div class="col3">＊请再次输入密码以确保输入无误</div>
			</div>
			<div class="row clearfix">
				<div class="col1">真实姓名:</div>
				<div class="col2">
					<input  id="realname" name="realname" maxlength="10" class="textbox1">
				</div>
				<div class="col3">＊姓名必须与你用于提款的银行户口名字一致，否则无法提款</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">取款密码:</div>
				<div class="col2">
					<input id="paypasswd" name="paypasswd" type="password" maxlength="6" class="textbox1">
				</div>
				<div class="col3">＊请输入6位的数字组合密码，提款认证必须，务必记住</div>
			</div>
			<div class="row  clearfix">
				<div class="col1">验证码:</div>
				<div class="col2">
					<input id="vcode" name="vcode" type="text" maxlength="4" class="textbox2">
					<div class="capcha">
						
						<img id="zc_img" src="yzm.php" alt="点击刷新" title="点击刷新" style="cursor: pointer; vertical-align: bottom" onclick="change_zc_yzm('zc_img')" />
					</div>
				</div>
				<div class="col3">＊请输入验证码</div>
			</div>
			<div class="row" style="margin-bottom: 50px;">
				<div class="col1"></div>
				<div class="col2">
					<input type="submit" name="regBtn" value="创建帐号" class="submitbtn">
				</div>
</form>

<script type="text/javascript">
    function change_zc_yzm(id) {
        $("#" + id).attr("src", "yzm.php?" + Math.random());
        $("#vcode").val("").focus();
        return false;
    }
    function regcheck() {
        var name = $("#zcname");
        if(name.val() == "") {
            layer.tips('请输入用户名！', name, {tips: [2, 'red']});
            name.focus();
            return false;
        }
		var n_reg = /^[a-zA-Z0-9_]{6,15}$/;
		if(!n_reg.test(name.val())) {
			layer.tips('用户名只能为6-15位的字母数字下划线组合！', name, {tips: [2, 'red']});
            name.focus();
            return false;
		}
        var o_pd = $("#passwd");
        if(o_pd.val() == "") {
            layer.tips('请设置密码！', o_pd, {tips: [2, 'red']});
            o_pd.focus();
            return false;
        }
        if(o_pd.val().length < 6) {
            layer.tips('密码至少需要6个字符！', o_pd, {tips: [2, 'red']});
            o_pd.focus();
            return false;
        }
        var n_pd = $("#passwdse");
        if(n_pd.val() != o_pd.val()) {
            layer.tips('两次密码输入不一样！', n_pd, {tips: [2, 'red']});
            n_pd.focus();
            return false;
        }
        var r_name = $("#realname");
        if(r_name.val() == "") {
            layer.tips('请输入您的真实姓名，需要与银行卡开户人一样！', r_name, {tips: [2, 'red']});
            r_name.focus();
            return false;
        }
        var cn = /^[\u4e00-\u9fa5]+$/;
        if(!cn.test(r_name.val())) {
            layer.tips('请输入正确姓名，需要和银行开户人一样', r_name, {tips: [2, 'red']});
            r_name.focus();
            return false;
        }
        var p_pd = $("#paypasswd");
        var p_reg = /^\d{6}$/;
        if(p_pd.val() == "") {
            layer.tips('请设置取款密码！', p_pd, {tips: [2, 'red']});
            p_pd.focus();
            return false;
        }
        if(!p_reg.test(p_pd.val())) {
            layer.tips('取款密码只能为6个数字！', p_pd, {tips: [2, 'red']});
            p_pd.focus();
            return false;
        }
        var code = $("#vcode");
        if(code.val() == "") {
            layer.tips('请输入验证码！', code, {tips: [2, 'red']});
            code.focus();
            return false;
        }
        return true;
    }
</script>
</body>
</html>