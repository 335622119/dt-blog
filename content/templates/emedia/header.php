<?php
/*
Template Name:eMedia
Description:盗客网
Version:1.1
Author:平凡世界
Author Url:http://www.idaoker.com
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
if(function_exists('emLoadJQuery')) {
    emLoadJQuery();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link href="<?php echo TEMPLATE_URL; ?>css/base.css" rel="stylesheet" type="text/css" />
<link href="<?php echo TEMPLATE_URL; ?>css/style.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/script.js"></script>
</head>
<body>
<div class="wrapper-outer">
<div class="topBar">
  <div class="wrapper">
    <div class="t-fl"><?php echo $bloginfo; ?></div>
    <div class="t-fr"><?php if(ROLE == 'admin' || ROLE == 'writer'): ?><a href="http://www.idaoker.com/?post=4">关于本站</a><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _g('ctqq'); ?>&site=812834272&menu=yes">站长QQ</a><?php endif; ?><a href="<?php echo BLOG_URL; ?>m/">手机版</a></div>
  </div>
</div>
<!--topBar end-->
<div class="header wrapper clearfix">
	<div class="logo">
        <?php if (_g('logotype') == image) :?>
			<a href="<?php echo BLOG_URL; ?>"><img src="<?php echo _g('logopic'); ?>" alt="<?php echo $blogname; ?>" /></a>
		<?php else: ?>
        	<a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a>
        <?php endif;?>
	</div>
    <div class="search-fr">
        <div class="ah_nav_zuo_lim">
        <form action="<?php echo BLOG_URL; ?>index.php" method="get" id="search">
        <input name="keyword" value="关键字搜索" onblur="if(this.value==''){this.value='关键字搜索';}" onfocus="if(this.value=='关键字搜索'){this.value=''}" class="seach_cha" type="text">
        <input value="搜索" class="seach_dian" type="submit">
        </form>
        </div>
    </div>
</div>
<!--header end-->
<div class="wrapper">
<div class="navbar clearfix">
  <div class="pull-left"> 
    <div class="navbg">
      <div class="col960">
        <ul id="navul" class="cl">
        	<?php blog_navi();?>
        </ul>
      </div>
    </div>
  </div>
  <div class="pull-right">
	<ul>
    <li class="weixin"><a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _g('ctqq'); ?>&site=812834272&menu=yes" title="QQ联系" target="_blank">QQ联系</a></li>
    <ul/>
    	
  </div>
</div>
<!--navbar end-->  