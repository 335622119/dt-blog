<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div align="center" class="margin"><a href="<?php echo BLOG_URL; ?>" class="dbdtx"><img src="<?php echo TEMPLATE_URL; ?>images/love.jpg" class="avatar avatar-50 photo" height="50" width="50"/></a></div>
<div class="wrap s_clear sjzsy">

	<div class="yi_blog">
			当前位置：<a  href="<?php echo BLOG_URL; ?>?sort">首页</a> >><?php blog_sort($logid); ?> >><a href="<?php echo $value['log_url']; ?>"><?php echo $log_title; ?></a> 
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
		<div style="height:5px">
		</div>
		<div class="bi lazy ">
			<div class="hentai_post">
				<p style="margin-left:6px;float:left;color:#999;">
				<?php echo $log_content; ?>
                <?php doAction('log_related', $logData); ?>
				</p>
			</div>
		</div>
		<div style="height:30px">
		</div>
		<div class="hentai_time">
			<a style="float:left;">&nbsp;<i class="fa fa-user fa-lg"></i>&nbsp;<?php blog_author($author); ?>
			&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o fa-lg"></i>&nbsp;<?php echo gmdate('Y-n-j', $date); ?> 
			</a>
			<div class="qaq2 cdlyc2" style="float:right;">
				<a class="cd2">&nbsp;&nbsp;&nbsp;<i class="fa fa-share fa-lg"></i>分享到</a>
				<div class="dropdown2">
					<input class="fxbjk" value="本模板由刘培杰移植，请勿去除版权，尊重作者" style="width:160px;">
					<div style="height:10px">
					</div>
					<div class="bshare-custom">
						<a title="分享到新浪微博" class="bshare-sinaminiblog"></a><a title="分享到腾讯微博" class="bshare-qqmb"></a><a title="分享到网易微博" class="bshare-neteasemb"></a><a title="分享到人人网" class="bshare-renren"></a><a title="分享到QQ好友" class="bshare-qqim"></a><a title="分享到QQ空间" class="bshare-qzone"></a><a title="更多平台" class="bshare-more bshare-more-icon more-style-addthis"></a>
					</div>
					<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=2&amp;lang=zh"></script>
					<script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
				</div>
			</div>
			<div style="height:20px">
			</div>
		</div>
	</div>
</div>
<div class="wrap s_clear sjzsy">

<?php blog_comments($comments,$comnum); ?>
<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
</div>
</div>
<?php
 include View::getView('footer');
?>