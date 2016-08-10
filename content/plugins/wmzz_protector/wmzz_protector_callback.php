<?php
!defined('EMLOG_ROOT') && exit('fuck♂you');
define('WMZZ_E_PROT_ROOT', EMLOG_ROOT.'/content/plugins/wmzz_protector/');
//插件激活
function callback_init() {
if (!file_exists(WMZZ_E_PROT_ROOT.'wmzz_prot_set.php')) {
	$data= <<< DATA
<?php
!defined('EMLOG_ROOT') && exit('fuck♂you');
define('WMZZ_PROT_LOG', 1);
\$wmzz_prot_switch=0;
\$wmzz_prot_post=1;
\$wmzz_prot_get=1;
\$wmzz_prot_cookie=1;
\$wmzz_prot_referre=1;
define('WMZZ_PROT_DOACTION', 1);
define('WMZZ_PROT_COPY', 1);
?>
DATA;
	file_put_contents(WMZZ_E_PROT_ROOT.'wmzz_prot_set.php', $data);
}
	$sql = "INSERT INTO `".DB_NAME."`.`".DB_PREFIX."options` (`option_id`, `option_name`, `option_value`) VALUES (NULL, 'wmzz_prot_log', '0');";
	$r = MySql::getInstance();
	$r->query($sql);
}
//插件禁用事件
function callback_rm() {
	$sql = "DELETE FROM `".DB_NAME."`.`".DB_PREFIX."options` WHERE `option_name` = 'wmzz_prot_log';";
	$r = MySql::getInstance();
	$r->query($sql);
}
?>