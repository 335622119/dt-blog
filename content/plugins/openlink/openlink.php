<?php
/*
Plugin Name: 外链站内打开
Version: 1.2
Plugin URL:http://www.dahuotu.com/emlog插件/146.html
Description: 在阅读文章时，站内的外链在本站内打开，防止访客流失到外链网站。
Author: 大火兔
Author URL: http://www.dahuotu.com
*/

!defined('EMLOG_ROOT') && exit('access deined!');

function openLink_js() {
	echo "<script type=\"text/javascript\" src=\"http://lib.sinaapp.com/js/jquery/1.7.2/jquery.min.js\"></script>
	<script type=\"text/javascript\">
		$(function(){
			$('a').click(function(){
			   var openUrl = $(this).attr('href'); 
			   var openTarget = $(this).attr('target');
			   if(openUrl.indexOf(location.host)==-1){
				 //alert($(this).attr('is_open'));
				 if(openTarget!='_blank'){
					if(typeof($(this).attr('is_open')) == 'undefined'){
						$(this).attr('target','_blank').attr('href','/content/plugins/openlink/viewPage.html?url='+openUrl);
					}
				 }else{
					if(typeof($(this).attr('is_open')) == 'undefined'){
						$(this).attr('href','/content/plugins/openlink/viewPage.html?url='+openUrl);
					}
				 }
				 $(this).attr('is_open','use');
			   }
			});
		});
	</script>
	\n";
}

addAction('log_related', 'openLink_js');
