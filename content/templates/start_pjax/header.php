<?php
/*
Template Name:zbstart主题empjax专版
Description:扁平化，响应模板，pjax整站无刷新
Version:1.3
Author:思源
Author Url:http://www.isiyuan.net
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh">
<!--
//                            _ooOoo_  
//                           o8888888o  
//                           88" . "88  
//                           (| -_- |)  
//                            O\ = /O  
//                        ____/`---'\____  
//                      .   ' \\| |// `.  
//                       / \\||| : |||// \  
//                     / _||||| -:- |||||- \  
//                       | | \\\ - /// | |  
//                     | \_| ''\---/'' | |  
//                      \ .-\__ `-` ___/-. /  
//                   ___`. .' /--.--\ `. . __  
//                ."" '< `.___\_<|>_/___.' >'"".  
//               | | : `- \`.;`\ _ /`;.`/ - ` : | |  
//                 \ \ `-. \_ __\ /__ _/ .-` / /  
//         ======`-.____`-.___\_____/___.-`____.-'======  
//                            `=---='  
//                 拦截插件累计拦截逗比攻击"9661"次！
//         .............................................  
//                  佛祖保佑             永无BUG 
//          佛曰:  
//                  写字楼里写字间，写字间里程序员；  
//                  程序人员写程序，又拿程序换酒钱。  
//                  酒醒只在网上坐，酒醉还来网下眠；  
//                  酒醉酒醒日复日，网上网下年复年。  
//                  但愿老死电脑间，不愿鞠躬老板前；  
//                  奔驰宝马贵者趣，公交自行程序员。  
//                  别人笑我忒疯癫，我笑自己命太贱；  
//                  不见满街漂亮妹，哪个归得程序员？
-->
<head>
<meta charset="UTF-8"/>
<meta http-equiv="Cache-Control" content="no-transform"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<meta http-equiv="Content-Language" content="zh-CN" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="applicable-device"content="pc,mobile">
<title><?php echo $site_title; ?></title>
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="emlog" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/style.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/css/font-awesome.min.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/css/responsiveslides.css" media="screen"/>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/css/leonhere.css" media="screen"/>
<link href="<?php echo TEMPLATE_URL; ?>style/css/animate.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<!--[if IE 7]>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/css/font-awesome-ie7.min.css" media="screen"/>
<![endif]-->
<script src="<?php echo TEMPLATE_URL; ?>script/common.js" type="text/javascript"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>script/html5-css3.js"></script>
<![endif]-->
			<?php if (_g('pjax_on') == "yes"): ?>
<script src="<?php echo TEMPLATE_URL; ?>script/jquery.pjax.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>script/siyuan.js"></script>
	<?php endif; ?>
<?php doAction('index_head'); ?>
</head>
<body>
<header class="site-header" role="banner">
<div class="header">
		<div class="top-box">
			<div class="animated rubberBand logo">
							<a href="<?php echo BLOG_URL; ?>" title="<?php echo $blogname; ?>"><img src="<?php echo _g('logo');?>" alt="<?php echo $blogname; ?>"/></a>
			</div>
<div class="btn">
<i class="icon-th-large"></i>
</div>			
			<nav class="nav" role="navigation">
<?php blog_navi();?>
			</nav>
		</div>	
	</div>
	<div class="clear"></div>
</header>