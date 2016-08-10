
<?php if(!defined('EMLOG_ROOT')) {exit('error!');} if (!function_exists('_g')) {emMsg('<div style="color:#ff0000;line-height:40px;text-align:center;font-size:16px;">欢迎你使用<a href="http://blog.yesfree.pw" target="_blank">小草</a>制作的主题；</div><div style="line-height:25px;font-size:14px;color:#999;">你现在无法正常使用本模板的原因：<br />1、你可能还未安装，请先安装<a href="http://www.emlog.net/plugin/144" target="_blank">模板设置插件</a><br />2、你还未启用模板设置插件，请到后面插件管理中启用模板插件；<br /></div>', BLOG_URL . 'admin/plugins.php');}?>
<?php
//widget：内页链接
function blog_links($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	?>
	<?php foreach($link_cache as $value): ?>
	<h3><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></h3>
	<?php endforeach; ?>
<?php }?> 

<?php
//widget：友情链接
function blog_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
<?php }?> 
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?> 
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul class="item admin">
        <li><span class="adminImg"></span><a href="?sort">导航</a></li>
      </ul>

      <ul class="item">
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li><span class="help_btn"></span><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li><span class="logout_btn"></span><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;

        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        if($value['naviname']=="登陆"){
        	echo '<li><span class="sitting_btn"></span><a href="admin">用户登陆</a></li>';
        }elseif ($value['naviname']=="关于") {
        	# code.
        	echo '<li><span class="about_btn"></span><a href="?sort">关于我们</a></li>';
        }else{

		?>

		 <li><span class="help_btn"></span><a href="<?php echo $value['url']; ?>"><?php echo $value['naviname']; ?></a></li>

		
        
	<?php }endforeach; ?></ul>
<?php }?>
<?php
//blog：导航
function blog_left_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul>
	<?php
	foreach($navi_cache as $value):
        if ($value['pid'] != 0) {
            continue;
        }
		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li class="<?php echo $current_tab;?>">
			<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
</li>
	<?php endforeach; ?>
	</ul>
<?php }?>

<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<img src=\"".TEMPLATE_URL."/images/top.png\" title=\"首页置顶文章\" /> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/sortop.png\" title=\"分类置顶文章\" /> " : '';
    }
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == ROLE_ADMIN || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'" target="_blank">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：调用分类
function fenlei_navi(){
        global $CACHE; 
        $sort_cache = $CACHE->readCache('sort');?>
      <ul class="item admin">
        <li><span class="adminImg"></span><a href="?sort">总分类</a></li>
      </ul>
<ul class="item">
  <?php foreach($sort_cache as $value){?>
   <li><span class="about_btn"></span><a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname'];?></a></li>
  <?php } ?>

 </ul>
 <?php } ?>


<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：文章标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '标签:';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "	<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<b href="'.Url::author($uid)."\" $title>$author</b>";
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		|
	<?php endif;?>
	<?php if($nextLog):?>
		 <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
	<?php endif;?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments,$comnum){
    extract($comments);
    if($commentStacks): ?>
    		<div class="yi_blog" style="height:none;">
			<div id="comments">
	<a name="comments" class="comment-top"></a>
<h1 class="comment-title">
快来发表你的见解吧＾_＾
			</h1>
	<?php endif; ?>
     <div class="com-1">
    <ol class="commentlist">
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['content'] = preg_replace("|\[em_(\d+)\]|i",'<img src="' . BLOG_URL. 'admin/editor/plugins/emoticons/images/$1.gif" />',$comment['content']);
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank" class="upps">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<a name="<?php echo $comment['cid']; ?>"></a>
        <li class="comments" id="li-comment-<?php echo $comment['cid']; ?>">
			<div id="comment-<?php echo $comment['cid']; ?>" class="comment-body">

					<div class="touxiang">
						<?php if($isGravatar == 'y'): ?><img alt="" src="<?php echo getGravatar($comment['mail']); ?>" class="avatar avatar-52 photo avatar-default" height="52" width="52"><?php endif; ?></div>
                        
                        
                        						<span class="name"><?php echo $comment['poster']; ?></span>：	<p><?php echo $comment['content']; ?></p>
                        						<div class="date"><?php echo $comment['date']; ?>---<a  class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">@ta</a></div></div><!-- .comment-author -->
		<?php blog_comments_children($comments, $comment['children']); ?>
	</li>
	<?php endforeach; ?>
    
	<?php if($commentPageUrl) {?><br />

	<nav class="commentnav"><?php echo $commentPageUrl;?>
    </nav>
</ol></div>
	<?php } ?>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child) {
	$comment = $comments[$child];
	$comment['content'] = preg_replace("|\[em_(\d+)\]|i",'<img src="' . BLOG_URL. 'admin/editor/plugins/emoticons/images/$1.gif" />',$comment['content']);
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank" class="upps">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<ul class="children">
		<a name="<?php echo $comment['cid']; ?>"></a>
        <li id="li-comment-<?php echo $comment['cid']; ?>" class="comments">
			<div id="comment-<?php echo $comment['cid']; ?>" class="comment-body">
				<div class="touxiang">
						<?php if($isGravatar == 'y'): ?><img alt="" src="<?php echo getGravatar($comment['mail']); ?>" class="avatar avatar-52 photo avatar-default" height="52" width="52"><?php endif; ?></div><span class="name"><?php echo $comment['poster']; ?></span>：<p><?php echo $comment['content']; ?></p>
						<div class="date"><?php echo $comment['date']; ?>---<a  class="comment-reply-link" href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">@ta</a></div>
			</div><!-- .comment-body -->
</li><!-- #comment-## -->
		<?php blog_comments_children($comments, $comment['children']);?>
</ul><!-- .children -->
	<?php } ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
    <div class="comment-post" id="comment-post">
<div id="respond">
		<h2> 发表评论</h2> <small><a name="respond"></a><span class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()" id="cancel-comment-reply-link">点击取消回复</a></span></small>
		<form action="<?php echo BLOG_URL; ?>
			index.php?action=addcom" method="post" id="commentform">
            <?php if(ROLE == 'visitor'): ?>
            <div class="col1"><p>
			<textarea id="comment" placeholder="赶快发表你的见解吧！" name="comment" cols="50" rows="8" aria-required="true"></textarea></p></div>
			
			<div class="col2">
				<input type="text" name="comname" id="author" class="commenttext" placeholder="* 昵称（必填）" style="width:98%;" size="22" tabindex="1"></p>
                
			<p><input type="text" name="commail" class="commenttext" id="email"   placeholder="* 邮箱（必填）" style="width:98%;" size="22" tabindex="2"></p>
            
			</p><input type="text" class="commenttext" name="comurl" id="url" placeholder="* 网站（选填）" style="width:98%;" size="22" tabindex="3"></p>
            			<p>
				<input name="submit"  class="submit" type="submit" tabindex="5" id="submit" value="Submit（Ctrl+Enter）" />
				<input type="hidden" name="gid" value="<?php echo $logid; ?>" id="comment_post_ID"/>
				<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
			</p>
			</div>
			<?php else:
          $CACHE = Cache::getInstance();
	       $user_cache = $CACHE->
			readCache('user');
        ?>
			<p class="comment-tip">
				已经登录。<a href="<?php echo BLOG_URL; ?>admin/?action=logout" title="登出此帐户">登出？</a>
			</p>
                        <div class="col1"><p>
			<textarea id="comment" placeholder="赶快发表你的见解吧！" name="comment" cols="50" rows="8" aria-required="true"></textarea></p></div>
            			<p>
				<input name="submit"  class="submit" type="submit" tabindex="5" id="submit" value="Submit（Ctrl+Enter）"/>
				<input type="hidden" name="gid" value="<?php echo $logid; ?>" id="comment_post_ID"/>
				<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
			</p>
			<?php endif; ?>
		</form>
       <div class="clear"></div>
       </div>
</div>			</div>
		</div>
	<?php endif; ?>
    <?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>
<?php
//获取附件第一张图片
function getThumbnail($blogid){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
    //die($sql);
    $imgs = $db->query($sql);
    $img_path = "";
    while($row = $db->fetch_array($imgs)){
         $img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));
    }
    return $img_path;
}
?>