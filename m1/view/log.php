<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="m">
<?php foreach($logs as $value): ?>
<div class="title"><a href="<?php echo BLOG_URL; ?>m1/?post=<?php echo $value['logid'];?>"><?php echo $value['log_title']; ?></a></div>
<div class="info"><?php echo gmdate('Y-n-j', $value['date']); ?></div>
<div class="info2">
评论:<?php echo $value['comnum']; ?> 阅读:<?php echo $value['views']; ?> 
<?php if(ROLE == ROLE_ADMIN || $value['author'] == UID): ?>
<a href="./?action=write&id=<?php echo $value['logid'];?>">编辑</a>
<?php endif;?>
</div>
<?php endforeach; ?>
<div id="page"><?php echo $page_url;?></div>
</div>
<?php global $CACHE; $link_cache = $CACHE->readCache('link'); ?>
友情链接：
※<?php foreach($link_cache as $value): ?><a href="<?php echo $value['url']; ?>"><?php echo $value['link']; ?></a>※<?php endforeach; ?><a href="./?post=3">申请友链</a>
