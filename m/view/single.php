<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<link href="<?php echo TEMPLATE_URL; ?>xiaows/prettify.css" rel="stylesheet" type="text/css" />
<script src="<?php echo BLOG_URL; ?>admin/editor/plugins/code/prettify.js" type="text/javascript"></script>


<!-- 面包屑导航-->
<div id="post-map">当前位置: <a href="<?php echo BLOG_URL; ?>m" title="博客首页">首页</a> &gt; <?php blog_sort($logid); ?> &gt; 正文</div>

<!-- 博文标题 -->
<div id="post-cont-header">
<h2 onclick="document.getElementById('post-manage').style.display='block';"><?php echo $log_title; ?></h2>
<div class="post-cont-info"><?php echo $user_cache[$author]['name'];?> 发表于<?php echo gmdate('Y年n月j日 G:i', $date); ?></div></div>

<?php if(ROLE == ROLE_ADMIN || $author == UID): ?>
<!-- 博文管理(仅登录可见 -->
<div id="post-manage" style="display:none;">管理:&nbsp;&nbsp;<a href="./?action=write&id=<?php echo $logid;?>">手机编辑</a> | <a href="/admin/write_log.php?action=edit&gid=<?php echo $logid;?>">电脑编辑</a></div>
<?php endif;?>

<!-- 博文内容 -->
<div id="post-content">
<?php echo $log_content; ?>
<div class="post_end"><span> 全文完</span></div>
</div>
<div id="post-cont-footer">
<div class="post-copyright">
<table class="copy"><tbody>
<tr><td class="ct">本文标签: </td><td class="tag"><?php blog_tag($logid); ?></td></tr>
<tr><td class="ct">本文标题: </td><td><a href="javascript:void(0);"><?php echo $log_title; ?></a></td></tr>
<tr><td class="ct">本文链接: </td><td><a href="javascript:void(0);"><?php echo BLOG_URL; ?>m/?post=<?php echo $logid;?></a></td></tr></tbody></table></div></div>

<!-- 随机文章 -->
<div class="randlog"><?php
    $index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog(5);
	?><h3 class="randlog-title">〓 随机文章推荐</h3><div class="clear"></div>
<ul><?php foreach($randLogs as $value): ?><li><a href="./?post=<?php echo $value['gid']; ?>"><?php echo $value['title']; ?></a></li><?php endforeach; ?></ul><div class="clear"></div></div>

 <!-- 相邻文章 -->
<div class="neighborlog">
<?php getnearlog($logData['timestamp']);?>
</div>


<!-- 评论列表 -->
<div class="comment-title">共有<b><?php echo $views; ?></b>阅 / <b><?php echo $comnum; ?></b>评<span><a href="#ct">我要评论</a></span></div>
<ol class="comment-list">
<?php if($comnum == 0) echo '<li class="nocomment-wrap">还没有评论呢，快抢沙发~</li>'; ?>
<?php $isGravatar = Option::get('isgravatar');
        $comnum = count($comments);
	$i= $comnum - ($commentPage - 1)*Option::get('comment_pnum');
	foreach((array)$commentStacks as $cid):
	$comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="/go.php?url='.urlencode($comment['url']).'" target="_blank">'.$comment['poster'].'</a>' : '<a href="javascript:void(0);">'.$comment['poster'].'</a>';
?>
<li class="comment-wrap">
<div class="Gravatar"><?php if($isGravatar == 'y'): ?><img src="<?php echo getGravatarX($comment['mail']); ?>"/><?php endif; ?></div><div class="comment-body"><div class="comment-header"><span class="comment-author"><?php echo $comment['poster']; ?></span><span class="comment-ua"><?php if(function_exists('display_useragent')){display_useragent($comment['cid'],$comment['mail']);} ?></span><span class="comment-floor"><?php if($i == '1')
{echo '沙发';}
elseif($i == '2'){echo '板凳';}
elseif($i == '3'){echo '地板';}
else{echo $i.'楼';}?></span></div>
<div class="comment-content"><?php echo xemoFormat($comment['content']); ?></div>
<div class="comment-footer"><span class="comment-time"><?php echo $comment['date']; ?></span><a href="./?action=reply&cid=<?php echo $comment['cid'];?>" class="reply-button">回复</a></div></div>
</li><?php $i--; endforeach; ?>
</ol>


<?php if($commentPageUrl) { ?>
<div id="page">
<!-- 分页页码 -->
<?php echo $commentPageUrl ;?>
</div>
<?php } ?>

<!-- 发表评论 -->
<a name="ct"></a>
<div id="respond" class="comment-respond">
<h3 id="reply-title" class="comment-reply-title">发表你的评论吧<a href="#top" class="gotop right">返回顶部</a></h3>
<p><span>!</span>评论内容需包含中文</p>
<form method="post" action="./index.php?action=addcom&gid=<?php echo $logid; ?>" id="commentform" class="comment-form">
<?php if(ISLOGIN == true):?>
<p><?php echo $user_cache[UID]['name']; ?></b>，请输入内容吧</p>
<?php elseif($_COOKIE['name']): ?>
<p>欢迎回来，<?php echo $_COOKIE['name']; ?> <a onclick="document.getElementById('user-info').style.display='block';return false;">[点此更改]</a></p>
<div id="user-info" style="display:none;">
 <div class="user-info"><span>昵称</span><input type="text" name="comname" maxlength="30" value="<?php echo $_COOKIE['name'];?>" placeholder="昵称不宜过长哦"/></div>
<div class="user-info"><span>邮箱</span><input type="text" name="commail" value="<?php echo $_COOKIE['mail'];?>" placeholder="可开启Gravatar头像" /></div>
<div class="user-info"><span>主页</span><input type="text" name="comurl" value="<?php echo $_COOKIE['url'];?>" placeholder="方便回访你的网页" /></div>
</div>
<?php else: ?>
 <div class="user-info"><span>昵称</span><input type="text" name="comname" maxlength="30" value="" placeholder="昵称不宜过长哦"/></div>
<div class="user-info"><span>邮箱</span><input type="text" name="commail" value="<?php echo $_COOKIE['mail'];?>" placeholder="可开启Gravatar头像" /></div>
<div class="user-info"><span>主页</span><input type="text" name="comurl" value="<?php echo $_COOKIE['url'];?>" placeholder="方便回访你的网页" /></div>
<?php endif; ?>
<textarea name="comment" class="textarea" placeholder="评论内容可以换行，但不支持HTML" ></textarea>
<?php echo $verifyCode; ?>
<div class="comcheck"><input type="checkbox" value="9" name="commentc" id="commentc" <?php if (isset($_COOKIE["WMZZ_BLOG_LOGCOM_CHECKBOX"])) { echo ' checked="checked""'; } ?> title="提交评论前请勾选本项"><font color="red">请勾选本项再提交评论</font></div>
 <input class="submit" type="submit" value="发表评论" />
    </form>
</div>
<script>prettyPrint();</script>