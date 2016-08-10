<?php
/*
Plugin Name: 访客记录
Version: 2.0
Plugin URL: http://zhizhe8.net
Description: 记录访客的IP,访问时间,来源地址,User-Agent信息
Author: 无名智者
Author Email: kenvix@vip.qq.com
Author URL: http://zhizhe8.net
*/
!defined('EMLOG_ROOT') && exit('access deined!');

function wmzz_fkjl(){
error_reporting(7); 
include(EMLOG_ROOT.'/content/plugins/wmzz_fkjl/config.php');
date_default_timezone_set('PRC'); //把时间调到北京时间
$date=date("Y-m-d H:i:m");
/////////存入数据库///////////
$lsql = mysql_connect(DB_HOST,DB_USER,DB_PASSWD);

$ip=$_SERVER["REMOTE_ADDR"];
$ua=$_SERVER['HTTP_USER_AGENT'];
$re=$_SERVER['HTTP_REFERER'];
$txxy=$_SERVER['SERVER_PROTOCOL'];

$dwrite="INSERT INTO `".DB_NAME."`.`".DB_PREFIX."wmzz_fkjl` (`UA`, `IP`, `LYDZ`, `FWSJ`, `TXXY`) VALUES ('".$ua."', '".$ip."', '".$re."', '".$date."', '".$txxy."');";

mysql_query($dwrite,$lsql);
////////完了/////////////
}
addAction('index_head','wmzz_fkjl');

function wmzz_fkjls(){
include(EMLOG_ROOT.'/content/plugins/wmzz_fkjl/config.php');

echo '<div class="sidebarsubmenu" id="emlog_sinat"><a href="./plugin.php?plugin=wmzz_fkjl&log=n">访客记录</a></div>';
if($inst == 'ok'){ 
}else{ 
echo '<div class="coment_number"><a href="./plugin.php?plugin=wmzz_fkjl&log=n" title="尚未安装数据表，无法记录日志，请点击此处安装"> ！</a></div>'; 
} 
}
addAction('adm_sidebar_ext', 'wmzz_fkjls');
?>