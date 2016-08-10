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
error_reporting(0); 
function plugin_setting_view()
{
/////载入设置/////
include(EMLOG_ROOT.'/content/plugins/wmzz_fkjl/config.php');
$act=$_GET["act"];
/////创建数据表/////
if ($act == 'crea')
{
$lsql = mysql_connect(DB_HOST,DB_USER,DB_PASSWD);
mysql_select_db(DB_NAME, $lsql);
$cre="CREATE TABLE ".DB_PREFIX."wmzz_fkjl
(
UA text,
IP text,
LYDZ text,
FWSJ text,
TXXY text
)";
mysql_query($cre);
$dwrite="<?php \$inst='ok' ;?>";
$file = fopen(EMLOG_ROOT.'/content/plugins/wmzz_fkjl/config.php','w');
fwrite($file,$dwrite);
fclose($file);
echo '<span class="actived">创建日志数据库成功</span>' ;
}
/////清空数据表/////
if ($act == 'cle')
{
$lsql = mysql_connect(DB_HOST,DB_USER,DB_PASSWD);
mysql_select_db(DB_NAME, $lsql);
mysql_query("TRUNCATE emlog_wmzz_fkjl");
$dwrite="<?php \$inst='no' ;?>";
$file = fopen(EMLOG_ROOT.'/content/plugins/wmzz_fkjl/config.php','w');
fwrite($file,$str);
fclose($file);
echo '<span class="actived">清空日志成功</span>' ;
}
/////删除数据表/////
if ($act == 'del')
{
$lsql = mysql_connect(DB_HOST,DB_USER,DB_PASSWD);
mysql_select_db(DB_NAME, $lsql);
mysql_query("DROP TABLE ".DB_PREFIX."wmzz_fkjl");
$dwrite="<?php \$inst='no' ;?>";
$file = fopen(EMLOG_ROOT.'/content/plugins/wmzz_fkjl/config.php','w');
fwrite($file,$str);
fclose($file);
echo '<span class="actived">删除日志数据表成功</span>' ;
}
?>
<?php if ($_GET['log'] == 'n') { ?>
<div class="containertitle"><b>访客记录 - 基本设置</b></div>
<div class="containertitle2">
<a class="navi3" href="./plugin.php?plugin=wmzz_fkjl&log=n">基本设置</a>
<a class="navi4" href="./plugin.php?plugin=wmzz_fkjl&log=y">查看记录</a></div>

<form name="crea" action="plugin.php?plugin=wmzz_fkjl&log=n&act=crea" method="post">创建日志数据表(必须安装)：<input type="submit" style="width:90px" value="立即执行" class="button"></form>
<br/>当前状态：<?php
if($inst == 'ok'){ 
echo '日志数据表存在'; 
}else{ 
echo '<font color="red">日志数据表不存在! </font>无法记录任何日志，请先安装数据表'; 
} 
?>
<br/><hr/><br/><font color="red">以下设置请谨慎使用：</font>
<form name="cle" action="plugin.php?plugin=wmzz_fkjl&log=n&act=cle" method="post">清空日志数据表(删除日志)：<input type="submit" style="width:90px" value="立即执行" class="button" onClick="question()" /></form>
<form name="del" action="plugin.php?plugin=wmzz_fkjl&log=n&act=del" method="post">清空日志数据表(卸载日志)：<input type="submit" style="width:90px" value="立即执行" class="button" onClick="question()" /></form>
<script>
var areaId = document.getElementById('question');
areaId.onkeydown = function(e){
e = e?e:window.event;
if(e.ctrlKey && 13==e.keyCode){
   this.form.submit();
}
}
//
    function question() {
        if (!confirm("您确实要执行此操作吗？\n警告：该操作不可恢复！")) {
            window.event.returnValue = false;
        }
    }
</script>
<?php } ?>
<?php if ($_GET['log'] == 'y') { 
$LI1=$_POST['li1'];
$LI2=$_POST['li2'];
?>
<div class="containertitle"><b>访客记录 - 查看记录</b></div>
<div class="containertitle2">
<a class="navi4" href="./plugin.php?plugin=wmzz_fkjl&log=n">基本设置</a>
<a class="navi3" href="./plugin.php?plugin=wmzz_fkjl&log=y">查看记录</a></div>
<form action="plugin.php?plugin=wmzz_fkjl&log=y" method="post">
<font color="red">显示行:</font> 【温馨提示】:不建议显示太多，否则浏览器可能卡死！<br/>
从第 <input type="text" value="<?php echo $LI1 ; ?>" id="li1" name="li1"> 行到第 <input type="text" value="<?php echo $LI2 ; ?>" id="li2" name="li2"> 行<br/>
<input type="submit" value="立即提交并显示访客记录" style="width:250px" />
</form><br/>
<?php
$lsql = mysql_connect(DB_HOST,DB_USER,DB_PASSWD); 
mysql_select_db(DB_NAME, $lsql);
mysql_query("set character set 'utf8'");   // PHP 文件为 utf-8 格式时使用
$sql = "SELECT * FROM  `".DB_PREFIX."wmzz_fkjl`  LIMIT ".$LI1." , ".$LI2."";
$result = mysql_query($sql);                //得到查询结果数据集
//循环从数据集取出数据

while( $row = mysql_fetch_array($result) ){
echo "
User-Agent:".$row['UA']."
<br/>IP地址:".$row['IP']."
<br/>来源地址:".$row['LYDZ']."
<br/>访问时间:".$row['FWSJ']."
<br/>通信协议:".$row['TXXY']."
<br/><br/>";
}
?>
<?php } ?>
<?php
}
?>