<?php
!defined('EMLOG_ROOT') && exit('fuck♂you');
if (!defined('WMZZ_PROT_ROOT')) {
    define('WMZZ_PROT_ROOT',EMLOG_ROOT.'/content/plugins/wmzz_protector/');
}
function plugin_setting() {
	$wdir=str_replace("'", "\\'", str_replace('/', '\\/', $_POST['wh']));
	$data= <<< DATA
<?php
!defined('EMLOG_ROOT') && exit('fuck♂you');
define('WMZZ_PROT_LOG', {$_POST['log']});
define('WMZZ_PROT_SWITCH', {$_POST['sw']});
define('WMZZ_PROT_POST', {$_POST['post']});
define('WMZZ_PROT_GET', {$_POST['get']});
define('WMZZ_PROT_COOKIE', {$_POST['ck']});
define('WMZZ_PROT_REFERRE', {$_POST['ref']});
define('WMZZ_PROT_COPY', {$_POST['copy']});
?>
DATA;
	file_put_contents(WMZZ_PROT_ROOT.'wmzz_prot_set.php', $data);
}

function plugin_setting_view() {
	require_once(WMZZ_PROT_ROOT.'wmzz_prot_set.php');
	$r = MySql::getInstance();
    $crw =$r->fetch_array($r->query("SELECT * FROM `".DB_NAME."`.`".DB_PREFIX."options` WHERE `option_name` LIKE 'wmzz_prot_log'"));
?>
<div class="containertitle"><b>站点安全保护 - 设置</b></div>
<style>
table,.t_table {
  table-layout:auto;
  border:1px solid #E3EDF5;
  empty-cells:show;
  border-collapse:collapse;
}
.t_table,td {
  padding:4px;
  border:1px solid #E3EDF5;
  overflow:hidden;
  color:#000000;
}
</style>
<form action="plugin.php?plugin=wmzz_protector&action=setting" method="post">
	<table style="width:100%">
    <thead>
        <tr>
            <td width="30%" valign="top" style="word-break: break-all;">
                设置名
            </td>
            <td width="70%" valign="top" style="word-break: break-all;">
                选项
            </td>
        </tr>
    </thead><tbody>
   		 <tr>
            <td width="30%" valign="top" style="word-break: break-all;">
                防护开关
            </td>
            <td width="70%" valign="top" style="word-break: break-all;">
                <input type="radio" name="sw" value="1" <?php if (WMZZ_PROT_SWITCH == 1) { echo 'checked'; } ?>>开&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="sw" value="0" <?php if (WMZZ_PROT_SWITCH == 0) { echo 'checked'; } ?>>关
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top" style="word-break: break-all;">
                POST 防护开关
            </td>
            <td width="70%" valign="top" style="word-break: break-all;">
                <input type="radio" name="post" value="1" <?php if (WMZZ_PROT_POST == 1) { echo 'checked'; } ?>>开&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="post" value="0" <?php if (WMZZ_PROT_POST == 0) { echo 'checked'; } ?>>关
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top" style="word-break: break-all;">
                GET 防护开关
            </td>
            <td width="70%" valign="top" style="word-break: break-all;">
                <input type="radio" name="get" value="1" <?php if (WMZZ_PROT_GET == 1) { echo 'checked'; } ?>>开&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="get" value="0" <?php if (WMZZ_PROT_GET == 0) { echo 'checked'; } ?>>关
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top" style="word-break: break-all;">
                Cookies 防护开关
            </td>
            <td width="70%" valign="top" style="word-break: break-all;">
                <input type="radio" name="ck" value="1" <?php if (WMZZ_PROT_COOKIE == 1) { echo 'checked'; } ?>>开&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="ck" value="0" <?php if (WMZZ_PROT_COOKIE == 0) { echo 'checked'; } ?>>关
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top" style="word-break: break-all;">
                Referer 防护开关
            </td>
            <td width="70%" valign="top" style="word-break: break-all;">
                <input type="radio" name="ref" value="1" <?php if (WMZZ_PROT_REFERRE == 1) { echo 'checked'; } ?>>开&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="ref" value="0" <?php if (WMZZ_PROT_REFERRE == 0) { echo 'checked'; } ?>>关
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top" style="word-break: break-all;">
                防护次数统计开关
            </td>
            <td width="70%" valign="top" style="word-break: break-all;">
                <input type="radio" name="log" value="1" <?php if (WMZZ_PROT_LOG == 1) { echo 'checked'; } ?>>开&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="log" value="0" <?php if (WMZZ_PROT_LOG == 0) { echo 'checked'; } ?>>关
            </td>
        </tr>
        <tr>
            <td width="30%" valign="top" style="word-break: break-all;">
                显示版权信息
            </td>
            <td width="70%" valign="top" style="word-break: break-all;">
                <input type="radio" name="copy" value="1" <?php if (WMZZ_PROT_COPY == 1) { echo 'checked'; } ?>>开&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="copy" value="0" <?php if (WMZZ_PROT_COPY != 1) { echo 'checked'; } ?>>关&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                做一个懂得尊重版权的博主，请保持打开，谢谢
            </td>
        </tr>
        <tr>
            <td width="100%" valign="top" style="word-break: break-all;" colspan="2">
                <input type="submit" style="width:20%" value="提交更改">
            </td>
        </tr>
    </tbody></table>
</form>
<br/><br/>
<b>统计信息</b>
<br/><br/>统计功能：<?php if (WMZZ_PROT_LOG == '1') { echo '已打开'; } else { echo '已禁用'; }?> [ 重新激活插件将重置统计 ]
<br/><br/>累计防护次数：<?php echo $crw['option_value']; ?>
<br/><br/>作者：无名智者 | <a href="http://zhizhe8.net" target="_blank">访问我的博客</a>
<?php
}