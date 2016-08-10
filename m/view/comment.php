<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<!-- 评论管理 -->
<ul id="com-mana-list">

 <?php 
foreach($comment as $value):
	$ishide = ISLOGIN === true && $value['hide']=='y'?'<font color="red" size="1">[待审]</font>':'';
?>
<li>
<img src="<?php echo getGravatarX($value['mail'])?>" width="48" height="48"><div class="com-mana-head">
<?php if(ISLOGIN === true): ?>
<span><?php echo $value['poster']; ?></span>
在<?php echo $value['date']; ?>评论<?php else:?>
<span><?php echo $value['name']; ?></span>
在<?php echo gmdate('Y年m月d日', $value['date']);?>说：
<?php endif;?>
<?php if(ISLOGIN === true): ?>《<?php echo $value['title']; ?>》<?php endif;?> 
</div><div class="clear"></div>
<div class="com-mana-body"><a href="<?php echo BLOG_URL; ?>m/?post=<?php echo $value['gid']; ?>"><?php echo $value['content']; ?></a></div>
<div class="com-mana-footer">
<?php if(ISLOGIN === true): ?>
<?php endif;?>
<?php if(ISLOGIN === true && $value['hide'] == 'n'): ?>
<a href="./?action=hidecom&id=<?php echo $value['cid'];?>">屏蔽</a>
<?php elseif(ISLOGIN === true && $value['hide'] == 'y'):?>
<a href="./?action=showcom&id=<?php echo $value['cid'];?>" id="check">审核</a>
<?php endif;?>
<a href="./?action=reply&cid=<?php echo $value['cid'];?>" id="reply">回复</a>
</div>
</li>
                
											<?php endforeach; ?>
 
</ul>
<?php echo $pageurl;?>