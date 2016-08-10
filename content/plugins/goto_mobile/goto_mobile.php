<?php
/*
Plugin Name: 手机访问自动跳转
Version: 2.0
Plugin URL: http://blog.4a8a.com/post-69.html
Description: 自动手机访问跳转到博客的/m浏览 简洁的一句百度JS
Author: 海盗船博客
Author Email: zc@zc520.cc
Author URL: http://blog.4a8a.com
*/

!defined('EMLOG_ROOT') && exit('access deined!');


function goto_mobile_headjs($logid){
echo '<script language="javascript" src="/content/plugins/goto_mobile/uaredirect.js" /></script>';
$url="/m";
if($logid!=""){
$url.="/?post=".$logid;
}
echo '<script type="text/javascript">uaredirect("'.$url.'");';
echo '</script>';
echo "<!--[if lte IE 6]>";
echo '<script type="text/javascript">window.location="'.$url.'";';
echo '</script>';
echo "<![endif]-->";
}
addAction('index_head','goto_mobile_headjs');
?>