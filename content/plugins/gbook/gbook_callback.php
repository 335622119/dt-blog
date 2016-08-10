<?php
!defined('EMLOG_ROOT') && exit('access deined!');
include EMLOG_ROOT.'/content/plugins/gbook/lib/common.php';

function callback_init(){
	$Gbook_Option = new Gbook_Option();
	$db = MySql::getInstance();
	global $CACHE;

	$sql1 = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."gbook` (
	`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`time` bigint(20) NOT NULL DEFAULT 0,
	`pid` int(11) NOT NULL DEFAULT 0,
	`nickname` varchar(20) NOT NULL DEFAULT '',
	`email` varchar(20) NOT NULL DEFAULT '',
	`siteurl` varchar(255) NOT NULL DEFAULT '',
	`phone` varchar(20) NOT NULL DEFAULT '',
	`qq` varchar(20) NOT NULL DEFAULT '',
	`sex` varchar(4) NOT NULL DEFAULT '未知',
	`ip` varchar(20) NOT NULL DEFAULT '',
	`content` TEXT NOT NULL,
	`pass` tinyint(2) NOT NULL DEFAULT 1,
	`uid` int(8) NOT NULL DEFAULT 0
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='EMLOG独立留言表' AUTO_INCREMENT=1;";

	$sql2 = "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."gbook_opts` (
	`id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` varchar(20) NOT NULL DEFAULT '',
	`value` varchar(5) NOT NULL DEFAULT ''
	) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言设置' AUTO_INCREMENT=1;";

	$is_exist_table_query1 = $db->query('show tables like "'.DB_PREFIX.'gbook"');
	$is_exist_table_query2 = $db->query('show tables like "'.DB_PREFIX.'gbook_opts"');

	if($db -> num_rows($is_exist_table_query1) == 0){
		$db -> query($sql1);
	}
	if($db -> num_rows($is_exist_table_query2) == 0){
		$db -> query($sql2);
	}

	$is_active_exist_sql = " SELECT * FROM `".DB_PREFIX."options` WHERE `option_name` = 'gbook_active' ";
	$num = $db -> num_rows($db -> query($is_active_exist_sql));

	if($num){
		$active_sql1 = " UPDATE `".DB_PREFIX."options` SET `option_value` = 1 WHERE `option_name` = 'gbook_active' ";
		$db -> query($active_sql1);
	}else{
		$Gbook_Option -> initOptions();
		$active_sql2 = " INSERT INTO `".DB_PREFIX."options` (`option_name`,`option_value`)  VALUES ('gbook_active',1) ";
		$db -> query($active_sql2);
	}
	$options_cache = $CACHE->updateCache('options');
}

function callback_rm(){
	$db = MySql::getInstance();
	$no_active_sql = " UPDATE `".DB_PREFIX."options` SET `option_value` = 0 WHERE `option_name` = 'gbook_active' ";
	$db -> query($no_active_sql);
	global $CACHE;
	$options_cache = $CACHE->updateCache('options');
}