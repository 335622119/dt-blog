<?php
/*
Plugin Name: 心情读后感
Version: 0.1
Plugin URL:http://caogenzhi.com
Description: 仿搜狐畅言的心情读后感，完全本地化，可以防止重复投票。
Author: 凡尘爵士
Author Email: 659915956@qq.com
Author URL: http://caogenzhi.com
*/
!defined('EMLOG_ROOT') && exit('access deined!');
function cgz_xinqing($logData){
    $logid = $logData['logid'];
	$jsfile = BLOG_URL.'content/plugins/cgz_xinqing/cgz_xinqing.js';
	$pluginpath = BLOG_URL.'content/plugins/cgz_xinqing/';
	echo <<<EOF
<div id="vote">
<script language="javascript">
    var pluginpath = "$pluginpath";
    var infoid = "$logid"; 
</script>
<script language = "javascript" src ="$jsfile"></script>
</div>
EOF;
}
addAction('log_related', 'cgz_xinqing');
function cgz_xinqing_backup(){
	global $tables;
	$DB = MySql::getInstance();
	$is_exist_album_query = $DB->query('show tables like "'.DB_PREFIX.'cgz_xinqing"');
	if($DB->num_rows($is_exist_album_query) != 0) array_push($tables, 'cgz_xinqing');
}
addAction('data_prebakup', 'cgz_xinqing_backup');
    ?>