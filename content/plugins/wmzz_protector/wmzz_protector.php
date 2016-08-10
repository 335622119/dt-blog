<?php
/*
Plugin Name: 站点安全保护
Version: 2.1
Plugin URL: http://zhizhe8.net
Description: 此程序将对站点进行防黑客攻击保护，过滤危险的参数。
Author: 无名智者
Author Email: kenvix@vip.qq.com
Author URL: http://zhizhe8.net
*/
!defined('EMLOG_ROOT') && exit('fuck♂you');

define('WMZZ_PROT_ROOT',EMLOG_ROOT.'/content/plugins/wmzz_protector/');

///////////////执行保护///////////////
include_once(WMZZ_PROT_ROOT.'wmzz_prot_set.php');
function wmzz_protector_content() { 
	include(WMZZ_PROT_ROOT.'protector.php');
}

////////////////后台侧边栏////////////////////
function wmzz_protector_menu() { 
	echo '<div class="sidebarsubmenu" id="wmzz_protector"><a href="./plugin.php?plugin=wmzz_protector">站点安全保护</a></div>'; }
	
////////////////挂载////////////////////
addAction('index_head','wmzz_protector_content');
addAction('adm_sidebar_ext', 'wmzz_protector_menu');
?>