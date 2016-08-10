<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div align="center" class="margin">
	<a href="<?php echo BLOG_URL; ?>" class="dbdtx"><img src="<?php echo TEMPLATE_URL; ?>images/love.jpg" class="avatar avatar-50 photo" height="50" width="50"/></a>
</div>
<div class="wrap s_clear sjzsy">
	<div class="yi_blog">
		<br>
		当前位置：<a href="<?php echo BLOG_URL; ?>?sort" title="返回首页">首页</a><!-- 首页 -->
 >><a href="<?php echo $value['log_url']; ?>"><?php echo $log_title;?></a><!-- 日志标题 -->
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
		<div style="height:5px">
		</div>
		<div class="bi lazy ">
			<div class="hentai_post">
				<p style="margin-left:6px;float:left;color:#999;">
					<a><?php echo $log_content; ?>
					</a>
				</p>
			</div>
		</div>
		<div style="height:20px">
		</div>
		<div class="hentai_time">
			<a style="float:left;">&nbsp;<i class="fa fa-user fa-lg"></i>&nbsp;<?php blog_author($author); ?>
			&nbsp;&nbsp;&nbsp;
			<i class="fa fa-clock-o fa-lg"></i>&nbsp;<?php echo gmdate('Y-n-j', $date); ?>
			</a>
			<div style="height:20px">
			</div>
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