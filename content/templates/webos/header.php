<?php
/*
Template Name:WebOS for emlog
Description:萌萌哒,高大上的博客主题。
Version:1.0
Author:小草
Author Url:http://blog.yesfree.pw
Sidebar Amount:1
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
if(blog_tool_ishome()){}else{


?>
<!DOCTYPE>
<head>
<!-- 设置标题 -->
<meta charset="utf-8">
<title><?php echo $site_title; ?></title>
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="emlog" />
<!-- Mobile Specific Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta http-equiv="Cache-Control" content="no-transform " />
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/scrolltopcontrol.js"></script>
<link href="<?php echo TEMPLATE_URL; ?>style.css" rel="stylesheet">
<link href="<?php echo TEMPLATE_URL; ?>css/tcd.css" rel="stylesheet">
<link href="<?php echo TEMPLATE_URL; ?>css/font-awesome.min.css" rel="stylesheet">
<script src="<?php echo BLOG_URL; ?>include/lib/js/common_tpl.js" type="text/javascript"></script>
<?php doAction('index_head'); ?>
</head>
<body style="background:#FFF url('<?php echo TEMPLATE_URL; ?>images/bgbody.gif')">
<?php } ?>