<?php
if(!defined('EMLOG_ROOT')) {exit('error!');}
function callback_init(){
	$DB = MySql::getInstance();
	$check_table_exist = $DB->query('show tables like "'.DB_PREFIX.'cgz_xinqing"');
	if($DB->num_rows($check_table_exist) == 0){//新建数据表
		$dbcharset = 'utf8';
		$type = 'MYISAM';
		$add = $DB->getMysqlVersion() > '4.1' ? "ENGINE=".$type." DEFAULT CHARSET=".$dbcharset.";":"TYPE=".$type.";";
		$sql = "CREATE TABLE  `".DB_PREFIX."cgz_xinqing` (
`moodid` mediumint(8) unsigned NOT NULL auto_increment,
`mood1` int(11) NOT NULL default '0',
`mood2` int(10) NOT NULL default '0',
`mood3` int(10) NOT NULL default '0',
`mood4` int(10) NOT NULL default '0',
`mood5` int(10) NOT NULL default '0',
`id` int(10) NOT NULL,
PRIMARY KEY  (`moodid`)
)".$add;
		$DB->query($sql);
	}
}

function callback_rm(){
	$DB = MySql::getInstance();
	$query = $DB->query("DROP TABLE IF EXISTS ".DB_PREFIX."cgz_xinqing");
}
?>