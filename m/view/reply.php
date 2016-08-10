<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="content">
<div class="comment-reply-all">
<div class="comment-reply-title">回复<b>＠<?php echo $poster; ?></b> : </div><div class="comment-reply-content"><?php echo $comment; ?></div></div>
<div class="comment-respond">
<form method="post" action="./index.php?action=addcom&gid=<?php echo $gid; ?>&pid=<?php echo $cid; ?>">
	<?php
		if(ISLOGIN == true):
		$CACHE = Cache::getInstance();
		$user_cache = $CACHE->readCache('user');
	?>
	<div class="tips"><?php echo $user_cache[UID]['name']; ?> ，请输入你的回复</div>
	<input type="hidden" name="comname" value="<?php echo $user_cache[UID]['name']; ?>" />
	<input type="hidden" name="commail" value="<?php echo $user_cache[UID]['mail']; ?>" />
	<input type="hidden" name="comurl" value="<?php echo BLOG_URL; ?>" /> 
<?php elseif($_COOKIE['name']): ?>
<p>欢迎回来，<?php echo $_COOKIE['name']; ?> <a onclick="document.getElementById('user-info').style.display='block';return false;">[点此更改]</a></p>
<div id="user-info" style="display:none;">
 <div class="user-info"><span>昵称</span><input type="text" name="comname" maxlength="30" value="<?php echo $_COOKIE['name'];?>" placeholder="昵称不宜过长哦"/></div>
<div class="user-info"><span>邮箱</span><input type="text" name="commail" value="<?php echo $_COOKIE['mail'];?>" placeholder="可开启Gravatar头像" /></div>
<div class="user-info"><span>主页</span><input type="text" name="comurl" value="<?php echo $_COOKIE['url'];?>" placeholder="方便回访你的网页" /></div> 
</div> 
<?php else: ?>
<div class="user-info"><span>昵称</span><input type="text" name="comname" maxlength="30" value="" placeholder="昵称不宜过长哦"/></div>
<div class="user-info"><span>邮箱</span><input type="text" name="commail" value="" placeholder="可开启Gravatar头像" /></div>
<div class="user-info"><span>主页</span><input type="text" name="comurl" value="" placeholder="方便回访你的网页" /></div>
<?php endif; ?>

<textarea name="comment" class="textarea" placeholder="回复内容可以换行，但不支持HTML" ></textarea> 

<?php echo $verifyCode; ?>
<div class="comcheck"><input type="checkbox" value="9" name="commentc" id="commentc" <?php if (isset($_COOKIE["WMZZ_BLOG_LOGCOM_CHECKBOX"])) { echo ' checked="checked""'; } ?> title="提交评论前请勾选本项"><font color="red">请勾选本项再提交评论</font></div>
<input type="submit" value="发表评论" />
	</form>
</div></div>