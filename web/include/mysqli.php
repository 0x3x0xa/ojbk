<?php
/*自定义攻击拦截*/
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
    require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}
//手机目录
$m_file='D:/web/wap/';
unset($mysqli);
$mysqli	=	new MySQLi("127.0.0.1","root","ojbk","dy1_db");
$mysqli->query("set names utf8");
?>