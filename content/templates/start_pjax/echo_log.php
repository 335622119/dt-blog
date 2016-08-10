<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="container">
<div class="breadcrumb">
<i class="icon-home"></i><a title="<?php echo $blogname;?>" href="<?php echo BLOG_URL; ?>">首页</a>
»  
<?php blog_sort($logid); ?>
»   <?php echo $log_title; ?>
</div>
<?php if($_COOKIE['siyuan_sidebar']=='no'){echo '<style type="text/css">.main{width:100%;border-right:0px;}.sidebar{display:none}</style>';}?>
<main class="main" role="main">
<div class="clear"></div>
<article class="post cate1 auth1">
<?php if (_g('ad') == "yes"): ?>
<div class="start-ad">
<?php echo _g('echoad1');?>
</div>
<?php endif ;?>
<h1><?php echo $log_title; ?></h1>
<div class="postmeta article-meta">
		<span><i class="icon-calendar"></i> 日期：<?php echo gmdate('Y-n-j', $date); ?> </span>
		<span><i class="icon-book"></i> 栏目：<?php blog_sort($logid); ?></span>
		<span><i class="icon-fire"></i> 浏览：<?php echo $views; ?>次 </span>
		<span><i class="icon-comments"></i> 评论：<?php echo $comnum; ?>条</span>
		<span title="打开/关闭侧边栏" class="fullscreen"><?php if($_COOKIE['siyuan_sidebar']=='no'){echo '<i class="icon-reply"></i>';}else{echo '<i class="icon-share"></i>';}?> 侧边栏</span>
	</div>
<div class="entry">
<?php echo $log_content; ?>
</div>

<div class="tags"><?php blog_tag($logid); ?>
</div>
<div class="post-nav"><?php neighbor_log($neighborLog); ?>
</div>
<div class="post-copyright">				
		<p>内容版权声明：除非注明，否则皆为本站原创文章。</p>
		<p>转载注明出处：<a target="_blank" title="<?php echo $log_title; ?>" href="<?php echo Url::log($logid); ?>"><?php echo Url::log($logid); ?></a></p>
	</div>


<?php doAction('log_related', $logData); ?>


                                                                                                         <?php if (_g('ad') == "yes"): ?>                                             
<div class="start-ad">
<?php echo _g('echoad2');?>	</div><?php endif ;?>
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