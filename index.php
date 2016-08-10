<?php
/**
 * 前端页面加载
 * @copyright (c) Emlog All Rights Reserved
 */

function is_mobile(){
	//正则表达式,批配不同手机浏览器UA关键词。
	$regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
	$regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
	$regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";
	$regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
	$regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
	$regex_match.=")/i";
    $regex_match2 = "/(MTKMTT|WAP Browser|MIDP)/i";

	if(isset($_COOKIE["uachar"]))
	{
		if($_COOKIE["uachar"]=="pc")
		{
		return 0;
		}
	}

	if(preg_match($regex_match2, strtolower($_SERVER['HTTP_USER_AGENT'])))
	return 1;
	if(isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT'])))
	return 2;

}

if(file_exists('install.php')&&file_exists('saeinstall.php')){
	header("location: ./install.php");exit;
}

if(isset($_GET['v']) && $_GET['v']=='pc')
{setcookie("uachar", "pc", time()+3600);
} else {
	if(is_mobile()==1) {
		header("Location: /m1/");
	}
}

require_once 'init.php';

define('TEMPLATE_PATH', TPLS_PATH.Option::get('nonce_templet').'/');//前台模板路径

$emDispatcher = Dispatcher::getInstance();
$emDispatcher->dispatch();
View::output();
