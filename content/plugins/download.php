<?php
/**
 * 文件下载页面
 * @copyright (c) Emlog All Rights Reserved
 */

require_once 'init.php';
$id=addslashes($_GET['id']);
$options_cache = $CACHE->readCache('options');
$db = MySql::getInstance();
$data = $db->query("SELECT * FROM ".DB_PREFIX."cpdown WHERE logid ='$id'");
$row = $db->fetch_array($data);
$logData = array(
	'start' => htmlspecialchars($row['start']),
	'name' => htmlspecialchars($row['name']),
	'size' => htmlspecialchars($row['size']),
	'up_date' => htmlspecialchars($row['up_date']),
	'version' => htmlspecialchars($row['version']),
	'author' => htmlspecialchars($row['author']),
	'yanshi' => htmlspecialchars($row['yanshi']),
	
	'baidudown' => htmlspecialchars($row['baidudown']),
		'baidumima' => htmlspecialchars($row['baidumima']),
	'xunlei' => htmlspecialchars($row['xunlei']),
	'tszwp' => htmlspecialchars($row['tszwp']),
		'tszwpmima' => htmlspecialchars($row['tszwpmima']),
	'other' => htmlspecialchars($row['other']),
	'web' => htmlspecialchars($row['web']),
	'ctldown' => htmlspecialchars($row['ctldown']),
	'general' => htmlspecialchars($row['general'])
);
$title = $logData['name'];
if(!empty($logData['baidumima'])){$baidumima = '百度网盘密码：'.$logData['baidumima'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}
if(!empty($logData['tszwpmima'])){$tszwpmima = '360网盘密码：'.$logData['tszwpmima'];}

if(!empty($logData['baidudown'])){
	$baidudown = '<a href="'.$logData['baidudown'].'" target="_blank">百度网盘</a>';
}
if(!empty($logData['xunlei'])){
	$xunlei = '<a href="'.$logData['xunlei'].'" target="_blank">迅雷快传<font color="red">(推荐)</font></a>';
}
if(!empty($logData['tszwp'])){
	$tszwp = '<a href="'.$logData['tszwp'].'" target="_blank">360网盘<font color="red">(推荐)</font></a>';
}
if(!empty($logData['other'])){
	$other = '<a href="'.$logData['other'].'" target="_blank">其他网盘</a>';
}
if(!empty($logData['web'])){
	$web = '<a href="'.$logData['web'].'" target="_blank">官方下载<font color="red">(推荐)</font></a>';
}
if(!empty($logData['ctldown'])){
	$ctldown = '<a href="'.$logData['ctldown'].'" target="_blank">城通网盘<font color="red">(推荐)</font></a>';
}
if(!empty($logData['general'])){
	$general = '<a href="'.$logData['general'].'" target="_blank">普通下载</a>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title><?php echo $title; ?>下载页面</title>
<meta name="keywords" content="<?php echo $title; ?>"/>
<meta name="description" content="<?php echo $title; ?>下载"/>
<style>
*{margin:0;padding:0;}
a{color:#ff3800;text-decoration:none;}
a:hover{color:green;border-bottom:1px dashed #F30;}
a img{border:0}
ul{margin:5px;padding:5px;}
ul li{line-height:15px;font-size:14px;padding:5px;border-bottom:1px dashed #ddd;list-style:none outside none;}
h1{text-align:center;border-bottom:1px solid #dadada;clear:both;font:26px Georgia,"Times New Roman",Times,serif;margin:5px 0 0 -4px;padding:0;padding-bottom:7px;font-weight:bold;}
h2{color:#FF0080;font-size:16px;}
h3{color:#666666;font-size:15px;margin:15px 0 10px;}
p{padding-bottom:2px;font-size:13px;line-height:22px;}
html{background:#F2F2F2;}
body{background:#fff;color:#333;font-family:"Microsoft YaHei",Helvetica,sans-serif;margin:2em auto;width:728px;padding:1em 2em;border:1px solid #dfdfdf;}
.clear{clear:both;height:1px;}
#header{padding:10px 0 15px 10px;text-align:center;}
.list{background:none repeat scroll 0 0 #F2F2F2;border:1px solid #BFBFBF;color:#666666;font-size:12px;height:30px;margin:15px 0 10px;padding:10px 0 0 10px;}
.list a{display:inline-block;padding:2px 4px;}
.sm,.desc{background:#F2F2F2;border:1px solid #BFBFBF;color:#666666;font-size:13px;margin:10px 0;}
</style>
</head>
<body>
<div id="header"></div>
<h1><a href="<?php echo URL::log($id); ?>"><?php echo $title; ?></a></h1>
<div class="clear"></div>
<div class="desc" style="padding:10px;">
	<h3>下载文件资源信息</h3>
	<p>文件名称：<?php echo $logData['name']; ?></p>
	<p>文件大小：<?php echo $logData['size']; ?></p>
	<p>适用版本：<?php echo $logData['version']; ?></p>
	<p>更新日期：<?php echo $logData['up_date']; ?></p>
	<p>作者信息：<?php echo $logData['author']; ?></p>
	<p>网盘密码：<?php echo $baidumima.$tszwpmima; ?></p>
	<p></p>
</div>
<div class="clear">
</div>
<div class="list">
	下载列表：
	<?php echo $baidudown,$xunlei,$tszwp,$other,$web,$ctldown,$general; ?>
</div>
<div class="clear"></div>
<div class="desc" style="border:none"></div>
<div class="clear"></div>
<div class="desc" style="border:1px solid #FCC;background:#FFE;">
	<p>下载说明</p>
	<ol style="padding:0 10px 0 25px;">
		<li>下载后文件若为压缩包格式，请安装RAR或者好压软件进行解压。</li>
		<li>文件比较大的时候，建议使用下载工具进行下载，浏览器下载有时候会自动中断，导致下载错误</li>
		<li>资源可能会由于内容问题被和谐，导致下载链接不可用，遇到此问题，请到文章页面进行反馈，我们会及时进行更新的。</li>
		<li>其他下载问题请自行搜索教程，这里不一一讲解</li>
	</ol>
</div>
<div class="sm" style="padding:5px">
	<p>声明：</p>
	<p>本站大部分下载资源收集于网络，只做学习和交流使用，版权归原作者所有，若为付费资源，请在下载后24小时之内自觉删除，若作商业用途，请到原网站购买，由于未及时购买和付费发生的侵权行为，与本站无关。本站发布的内容若侵犯到您的权益，请联系本站删除，我们将及时处理！
	</p>
</div>
<div class="clear"></div>
<div class="copy" style="text-align: center;margin-top:15px;">
	Copyright © <?php echo date('Y'); ?>
	<a href="http://www.xlonewolf.net/" target="_blank">lonewolf</a>
</div>
</body>
</html>