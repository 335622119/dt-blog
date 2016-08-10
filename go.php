<?php
error_reporting(0);
$url=isset($_GET['url'])?$_GET['url']:'http://www.cccyun.cn/';
$m=isset($_GET['m'])?$_GET['m']:null;
if($m=='base64')
	$url=base64_decode($url);
$backurl=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:'javascript:history.back(-1)';
header("Location: $url");
exit;
?>