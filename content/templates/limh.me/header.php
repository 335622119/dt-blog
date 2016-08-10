<?php
/*
Template Name:Colorful-Pjax
Description: Colorful-Pjax定制版<br><br><font color=red>＊</font>如有问题，请Q我：6354321
Version:2.4
Author:明月浩空
Author Url:http://limh.me
Sidebar Amount:1
ForEmlog:5.3.0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<link rel="apple-touch-icon" href="<?php echo TEMPLATE_URL; ?>images/icon.png" />
<link rel="shortcut icon" href="<?php echo TEMPLATE_URL; ?>images/favicon.ico" type="image/x-icon" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style.css?v=20151004"/>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>font-awesome.min.css?v=20150209">
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.min.js?v=20150224"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/bootstrap.min.js"></script>
<?php doAction('index_head'); ?>
<!--[if lt IE 9]> 
<script src="<?php echo TEMPLATE_URL; ?>js/html5.js"></script>
<style type="text/css">#wenkmPlayer{display:none}</style>
<![endif]-->
</head>
<body>
<header id="header1">
  <div class="open-nav"><i class="fa fa-list-ul"></i></div>
  <div class="logo1">
    <h1><a rel="index" title="网站首页" pjax="网站首页" href="<?php echo BLOG_URL; ?>"><img src="<?php echo _g('logo1'); ?>" alt="<?php echo $blogname; ?>" /></a></h1>
  </div>
</header>
<div id="lmhblog">
<header id="header">
  <div class="box">
    <div class="logo"> <a rel="index" title="<?php echo $blogname; ?>" pjax="网站首页" href="<?php echo BLOG_URL; ?>"><img src="<?php echo _g('logo'); ?>" alt="<?php echo $blogname; ?>" /></a> </div>
    <h1><a title="网站首页" pjax="网站首页" href="<?php echo BLOG_URL; ?>"><?php echo $site_title; ?></a></h1>
    <div class="text">
      <ul>
        <?php global $CACHE;$newtws_cache = $CACHE->readCache('newtw');?>
        <?php foreach($newtws_cache as $value): ?>
        <li><a title="查看更多微言碎语" pjax="微言碎语" href="<?php echo BLOG_URL . 't'; ?>"><?php echo date('Y年n月j日 - ',$value['date']);echo preg_replace("/\[F(([1-4]?[0-9])|50)\]/",'',$value['t']);?></li>
        </a>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</header>
<div id="head-nav">
  <div class="head-nav-wrap clearfix" id="nav">
    <ul id="menu-index" class="nav">
      <?php blog_navi();?>
    </ul>
    <ul class="m-nav" >
      <li><a rel="nofollow" title="新浪微博：@<?php echo _g('weiboid');?> [点击访问]" href="<?php echo _g('weibodz');?>" target="_blank"><i class="fa fa-weibo"></i> 微博</a></li>
      <li> <a rel="nofollow" title="QQ：<?php echo _g('qqhao');?> [点击临时会话]" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _g('qqhao');?>&site=qq&menu=yes" target="_blank"><i class="fa fa-qq"></i> QQ</a></li>
      <li><a class="wechat" rel="nofollow" title="点击查看微信二维码" href="<?php echo _g('weixin');?>" target="_blank"><i class="fa fa-wechat"></i> 微信</a></li>
      <li class="m-sch"> <a class="rss" rel="nofollow" title="RSS订阅" href="<?php echo BLOG_URL; ?>rss.php" target="_blank"><i class="fa fa-rss"></i> 订阅</a> </li>
    </ul>
  </div>
</div>
<div id="wrapper">
<div id="container">
<div id="anitOut"></div>