<?php 
/**
 * 内页链接
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="wrap s_clear sjzsy" align="center">
	<div class="yi_blog">
		<br>
		<hr size="1" style="color:#DDD;border-style:dashed ;width:100%">
		<div style="height:10px">
		</div>
		<p style="margin-left:6px;float:left;color:#999;">
			<h1 align="center"><?php echo $log_title; ?>
			</h1>
		</p>
		<div style="height:10px">
		</div>
		<hr size="1" style="color:#DDD;border-style:dashed ;width:100%">
		<?php echo $log_content; ?>
		<div class="Mylinks">
			<ul>
				<?php blog_link($title);?>
				
			</ul>
		</div>
	</div>
</div>
<div class="wrap s_clear sjzsy">
			<?php blog_comments($comments,$comnum); ?>
			<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
</div></div>
<?php
 include View::getView('footer');
?>