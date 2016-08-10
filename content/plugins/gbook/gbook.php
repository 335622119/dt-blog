<?php
/*
Plugin Name: EMLOG留言板
Version: 1.2
Plugin URL: http://www.myemlog.com
Description: EMLOG留言板
ForEmlog:5.3.1+
Author:	秦时明月
Author Email: Kurly@foxmail.com
Author URL: http://www.myemlog.com
 */
!defined('EMLOG_ROOT') && exit('access deined!');

function gbook_adm_nav(){
	echo '<div id="gbook" class="sidebarsubmenu"><a href="./plugin.php?plugin=gbook">留言板</a></div>';
}
addAction('adm_sidebar_ext', 'gbook_adm_nav');

function gbook_adm_style(){
	echo '<link type="text/css" href="'.BLOG_URL.'content/plugins/gbook/style/gbook_adm.css" rel="stylesheet" />';
	echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/gbook/style/gbook_adm.js"></script>';
}
addAction('adm_head', 'gbook_adm_style');

function gbook_front_style(){
	echo '<link type="text/css" href="'.BLOG_URL.'content/plugins/gbook/style/gbook_front.css" rel="stylesheet" />';
	echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/gbook/style/gbook_front.js"></script>';
}
addAction('index_head', 'gbook_front_style');

function gbook_to_backup(){
    global $tables;
    $DB = MySql::getInstance();
    $is_exist_info_query = $DB->query('show tables like "'.DB_PREFIX.'gbook" ');
    $is_exist_info_query2 = $DB->query('show tables like "'.DB_PREFIX.'gbook_opts" ');
    if($DB->num_rows($is_exist_info_query) != 0) array_push($tables, 'gbook');
    if($DB->num_rows($is_exist_info_query2) != 0) array_push($tables, 'gbook_opts');
}
addAction('data_prebakup', 'gbook_to_backup');
?>