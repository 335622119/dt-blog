<?php 
/**
 * 自建页面模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="container">
<div class="breadcrumb">
<i class="icon-home"></i><a title="<?php echo $blogname;?>" href="<?php echo BLOG_URL; ?>">首页</a>
»   <?php echo $log_title; ?>
</div>
<main class="main" role="main">
<article class="post cate0 auth1">
<h1><?php echo $log_title; ?></h1>
<div class="entry">
	<?php echo $log_content; ?>
	</div>
	<?php blog_comments($comments); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
</article>
</main>
<?php
 include View::getView('side');
?>	
</div>
<?php
 include View::getView('footer');
?>