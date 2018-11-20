<?php

unset($mysqlio);
$mysqlio = new MySQLi("127.0.0.1","root","ojbk","dy3_db");
$mysqlio->query("set names utf8");
?>