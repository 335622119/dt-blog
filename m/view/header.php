<?php 
/*
Template Name: X-Mobile V1.3
Description: Emlog触屏清新版
Author: 笑忘书 (XIAOWS)
Author Url: http://xiaows.com/m
郑重声明：使用传播分享务必保留以上模板版权信息！
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<head>
<title><?php echo $site_title; ?> 触屏版</title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="stylesheet" type="text/css" href="<?php echo BLOG_URL; ?>m/view/main.css">
<link rel="shortcut icon" href="<?php echo BLOG_URL; ?>favicon.ico">
</head>
<body>
<!-- 外围开始 -->
<div id="wrap">
<!-- 头部开始 -->
<div id="header">
<header class="nav">
<img id="logo-icon" src="<?php echo BLOG_URL; ?>m/view/images/logo.jpg" alt="<?php echo $blog_name; ?>"><a onclick="location.href='/m'" class="blog-title"><?php echo $blog_name; ?> 触屏版</a><a onclick="openNav();return false;" href="#" class="nav-open"></a>
</header></div>
<!-- 头部结束 -->
<div id="blackCover" style="display:none"></div>
<script type="text/javascript">
function openNav(){
nav = document.getElementById("menu");
bc = document.getElementById("blackCover");
if(nav.style.display == "none"){
nav.style.display = "block";
bc.style.display = "block";
}
else{
nav.style.display = "none";
bc.style.display = "none";
}
}
</script>
<!-- 头部导航 -->
<ul id="menu" style="display:none;"><li><a href="http://koubei.baidu.com/m/#/site/<?php echo substr(BLOG_URL,7); ?>">网站点评</a></li><?php if(Option::get('istwitter') == 'y'): ?><li><a href="./?action=tw">微言微语</a></li><?php endif;?><li><a href="./?action=com" id="active">最新评论</a></li><li><a href="./?post=33">给我留言</a></li><li><a href="./?post=37">关于本站</a></li><li><a href="./?post=36">网站导航</a></li><?php foreach($sort_cache as $st): ?><li class="sort-nav"><a href="./?sort=<?php echo $st['sid']; ?>"><?php echo $st['sortname']; ?><sup><?php echo $st['lognum']; ?></sup></a></li><?php endforeach; ?></ul>