<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="refresh" content="20" />
<style>
div{width:900px; margin:3% auto}
iframe{width:32%; border:solid 1px #e7e7e7; display:inline-block; height:150px}
</style>
</head>
<body>
<div>
<?php
$file = 'cqssc2|Auto_8|Auto_4_lc|Auto_3|Auto_11|xjssc|jnd28';
$url = 'http://' . $_SERVER['SERVER_NAME'] . '/ppx/cj/lottery/';
foreach( explode('|', $file ) as $name ) {
?>
  <iframe src="<?php echo $url, $name ?>.php" frameborder="0" scrolling="no"></iframe>
<?php
}unset( $url, $name, $file);
?>
</div>
</body>
</html>