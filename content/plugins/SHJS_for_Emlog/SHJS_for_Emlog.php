<?php
/*
Plugin Name: SHJH精简版代码高亮插件
Version: 1.0
Plugin URL: http://aisheji.org
Description: SHJS语法着色的精简版，去掉了很多不常用的语法高亮，只支持C、C++、CSS、HTML、JAVA、JAVASCRIPT、PHP、SQL、XML，体积更小巧。
Author: Tod
Author Email: i@tod.cc
ForEmlog:5.1.2
Author URL: http://aisheji.org
*/
!defined('EMLOG_ROOT') && exit('access deined!');

function SHJS_for_Emlog_writelog(){
	echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/SHJS_for_Emlog/code.js"></script>'.'<style type="text/css">.ke-icon-code{background-image: url("../content/plugins/SHJS_for_Emlog/code.gif");background-position: 0 0;height: 16px;width: 16px;}</style>';
}
addAction('adm_writelog_head', 'SHJS_for_Emlog_writelog');

function SHJS_for_Emlog_headcss(){
echo '<link rel="stylesheet" type="text/css" href ="'.BLOG_URL.'content/plugins/SHJS_for_Emlog/sh_style.min.css" />';
}
addAction('index_head','SHJS_for_Emlog_headcss');

function SHJS_for_Emlog_relatedlog(){
echo '<script type="text/javascript" src="'.BLOG_URL.'content/plugins/SHJS_for_Emlog/sh_main.min.js"></script>';
}
addAction('index_footer','SHJS_for_Emlog_relatedlog');