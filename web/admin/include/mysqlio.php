<?php
/*自定义攻击拦截*/
if(is_file($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php')){
    require_once($_SERVER['DOCUMENT_ROOT'].'/360safe/360webscan.php');
}

unset($mysqlio);
$mysqlio = new MySQLi("127.0.0.1","root","ojbk","dy3_db");
$mysqlio->query("set names utf8");
?>