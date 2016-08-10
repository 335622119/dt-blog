<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if (!function_exists('_g')) {
	emMsg('请先安装<a href="https://github.com/Baiqiang/em_tpl_options" target="_blank">模板设置插件</a>', BLOG_URL . 'admin/plugins.php');
}
?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
<section class="widget">
	<h3><i class="icon-info"></i><?php echo $title; ?></h3>
	<ul>

	
name：<?php echo $name; ?>
	info:<?php echo $user_cache[1]['des']; ?>
<?php }?>
</ul>
<?php
//widget：日历
function widget_calendar($title){ ?>
<section class="widget">
	<h3><i class="icon-th-list"></i><?php echo $title; ?></h3>
	<ul><div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script></ul>
</section>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
<section id="divTags" class="widget">
	<h3><i class="icon-tag"></i><?php echo $title; ?></h3>
	<ul>
	<?php foreach($tag_cache as $value): ?>
		<li><a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇文章"><?php echo $value['tagname']; ?></a>
	</li><?php endforeach; ?>
	</ul>
</section>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
<section class="widget">
	<h3><i class="icon-th-list"></i><?php echo $title; ?></h3>
	<ul id="blogsort">
	<?php
	foreach($sort_cache as $value):
		if ($value['pid'] != 0) continue;
	?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	<?php if (!empty($value['children'])): ?>
		<ul>
		<?php
		$children = $value['children'];
		foreach ($children as $key):
			$value = $sort_cache[$key];
		?>
		<li>
			<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
		</li>
		<?php endforeach; ?>
		</ul>
	<?php endif; ?>
	</li>
	<?php endforeach; ?>
	</ul>
</section>
<?php }?>
<?php
//widget：最新微语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
<section id="divComments" class="widget">
	<h3><i class="icon-twitter"></i><?php echo $title; ?></h3>
	<ul class="news-list">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li id="comment"><?php echo $value['t']; ?><?php echo $img;?>
  <i class="icon-time"></i><?php echo smartDate($value['date']); ?></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
	</ul>
</section>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<section id="divComments" class="widget">
		<h3>
<i class="icon-comments"></i><?php echo $title; ?></h3>
		<ul class="news-list">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li id="comment"><img alt="<?php echo $value['name']; ?>" src="<?php echo myGravatar($value['mail']); ?>"/>
	<b><a href="<?php echo $url; ?>"><?php echo $value['name']; ?>:</b>
	<?php echo $value['content'] = preg_replace("/\[(([1-4]?[0-9])|50)\]/",'<img src="'.TEMPLATE_URL.'face/$1.gif">',$value['content']);?></a></li>
	<?php endforeach; ?>			
	</ul>
</section>
<?php }?>
<?php //widget：最新文章
function widget_newlog($title){
$index_newlognum = Option::get('index_newlognum');?>
<section class="widget"><h3>
<i class="icon-th-list"></i><?php echo $title;?></h3>
<ul class="hot-post">
<?php 
$db = MySql::getInstance();
$sql = $db->query ("SELECT * FROM ".DB_PREFIX."blog inner join ".DB_PREFIX."sort WHERE hide='n' AND type='blog' AND top='n' AND sortid=sid order by date DESC limit 0,$index_newlognum"); while($row = $db->fetch_array($sql)){ $logpost = !empty($row['excerpt']) ? $row['excerpt'] : ''.$row['content'].''; if (!empty($row['excerpt'])){preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $row['excerpt'], $match); if(empty($match[1][0])) {
preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i",$row['content'],$match);}}else{preg_match_all("/\<img.*?src\=\"(.*?)\"[^>]*>/i", $row['content'],$match);}
$img = isset($match[0][0]) ? $match[0][0]:'<img src="/content/templates/start/style/images/nopic.gif" />';//无图片时显示
$date = gmdate('Y年m月d日', $row['date']);
$content = strip_tags($logpost,'');
$content = mb_substr($content,0,100,'utf-8');//摘要字数修改本代码中的100这个即可
$comment = ($row['comnum'] != 0) ? ''.$row['comnum'].'' : '0'; $gid = $row['gid']; $tag = $db -> query("SELECT * FROM ".DB_PREFIX."tag WHERE gid LIKE '%,$gid,%'");?>
<li>
<div class="thumb">
<a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>">
<img alt="<?php echo $row['title'];?>" src="<?php get_thum($row['gid']);?>">
</a>
</div>
<div class="hot-title">
<a title="<?php echo $row['title'];?>" href="<?php echo Url::log($row['gid']);?>"><?php echo $row['title'];?></a>
</div>
<div class="hot-time">
<i class="icon-time"></i>
<?php echo gmdate('Y-m-d', $row['date']);?>
</div>
</li>
<?php };?></ul></section><?php }?>
<?php
//热门日志列表
function widget_hotlog($title){
	$db = MySql::getInstance();
	$hot_num = Option::get('index_hotlognum');
	?>
<section id="scroll" class="widget"><h3><i class="icon-fire"></i><?php echo $title;?></h3>
<ul class="hot-post">
	<?php
	$sql = "SELECT gid,title,date,views,content FROM ".DB_PREFIX."blog inner join ".DB_PREFIX."sort WHERE hide='n' AND type='blog' AND date > $time - 30*24*60*60 AND top='n' AND sortid=sid order by `views` DESC limit $hot_num";
	$list = $db->query($sql);
	while($row = $db->fetch_array($list)){
	?> 	
<li><div class="thumb">
<a title="<?php echo $row['title'];?>" href="<?php echo Url::log($row['gid']);?>">
<img src="<?php get_thum($row['gid']);?>"alt="<?php echo $row['title']; ?>">
</a>
</div><div class="hot-title"><a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" /><?php echo $row['title'];?></a></div>
<div class="hot-time">
<i class="icon-time"></i>
<?php echo gmdate('Y-m-d', $row['date']);?>
</div>
	<?php }?>
    </ul></section>
<?php } ?>
<?php
//随机文章列表
function widget_random_log($title){
	$db = MySql::getInstance();
	$sj_num = Option::get('index_randlognum');
	?>
<section id="scroll" class="widget"><h3><i class="icon-book"></i><?php echo $title;?></h3>
<ul class="hot-post">
	<?php
	$sql = "SELECT gid,title,date,views,content FROM ".DB_PREFIX."blog ORDER BY RAND() LIMIT $sj_num";
	$list = $db->query($sql);
	while($row = $db->fetch_array($list)){
	?> 	
    <li><div class="thumb">
<a title="<?php echo $row['title'];?>" href="<?php echo Url::log($row['gid']);?>">
<img src="<?php get_thum($row['gid']);?>"alt="<?php echo $row['title']; ?>"></a>
</div><div class="hot-title"><a href="<?php echo Url::log($row['gid']);?>" title="<?php echo $row['title'];?>" /><?php echo $row['title'];?></a></div>
<div class="hot-time">
<i class="icon-time"></i>
<?php echo gmdate('Y-m-d', $row['date']);?>
</div>
	<?php }?>
    </ul></section>
<?php } ?>
<?php
//widget：搜索
function widget_search($title){ ?>
<section id="divSearchPanel" class="widget">
<h3>
<i class="icon-th-list"></i><?php echo $title; ?></h3>
	<div>
	<form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="search" type="text" />
	<input type="submit" value="搜索">
	</form>
	</div>
</section>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
<section class="widget">
	<h3><i class="icon-th-list"></i><?php echo $title; ?></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
</section>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
<section class="widget">
	<h3><i class="icon-th-list"></i><?php echo $title; ?></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
</section>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
    //if (!blog_tool_ishome()) return;#只在首页显示友链去掉双斜杠注释即可
	?>
<section id="divLinkage" class="widget">
	<h3><i class="icon-link"></i><?php echo $title; ?></h3>
	<ul class="news-list">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
</section>
<?php }?> 
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<div class="menu">
	<ul>
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }

		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li class="nvabar-item-index"><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="nvabar-item-index"><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'item-index' : 'category';
		?>
		<li class="navbar-<?php echo $current_tab;?>">
			<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>>
<?php if($value['naviname'] == "首页"):?><i class="icon-home"></i>
<?php elseif($value['naviname'] =="微语"):?><i class="icon-coffee"></i>
<?php elseif($value['naviname'] =="相册"):?><i class="icon-camera"></i>
<?php elseif($value['naviname'] =="归档"):?><i class="icon-th-list"></i>
<?php elseif($value['naviname'] =="留言" || $value['naviname'] =="留言板"):?><i class="icon-comments"></i>
<?php elseif($value['naviname'] =="音乐" || $value['naviname'] =="聆听音乐"):?><i class="icon-music"></i>
<?php elseif($value['naviname'] =="友情链接"):?><i class="fa fa-link"></i>
<?php elseif($value['naviname'] =="读者排行" || $value['naviname'] =="读者墙"):?><i class="icon-windows"></i>
<?php elseif($value['naviname'] =="登录"):?><i class="icon-key"></i>
<?php elseif($value['naviname'] =="投稿"):?><i class="icon-share-alt"></i>
<?php elseif($value['naviname'] =="手机版"):?><i class="icon-mobile"></i>
<?php elseif($value['naviname'] =="Emlog主题" || $value['naviname'] =="主题"):?><i class="icon-desktop"></i>
<?php else:?><i class="icon-book"></i>
<?php endif;?><?php echo $value['naviname']; ?></a>
			<?php if (!empty($value['children'])) :?>
            <ul class="sub-nav animated zoomInRight">
                <?php foreach ($value['children'] as $row){
                        echo '<li><a href="'.Url::sort($row['sid']).'">'.$row['sortname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

            <?php if (!empty($value['childnavi'])) :?>
            <ul class="sub-nav animated zoomInRight">
                <?php foreach ($value['childnavi'] as $row){
                        $newtab = $row['newtab'] == 'y' ? 'target="_blank"' : '';
                        echo '<li><a href="' . $row['url'] . "\" $newtab >" . $row['naviname'].'</a></li>';
                }?>
			</ul>
            <?php endif;?>

		</li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：置顶
function topflg($top, $sortop='n', $sortid=null){
    if(blog_tool_ishome()) {
       echo $top == 'y' ? "<span>
<a class='us-startups'>首页置顶</a>
</span> " : '';
    } elseif($sortid){
       echo $sortop == 'y' ? "<span>
<a class='us-startups'>分类置顶</a>
</span> " : '';
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
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
	<span><a  class="us-startups" href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>" title="查看<?php echo $log_cache_sort[$blogid]['name']; ?>下的全部文章"><?php echo $log_cache_sort[$blogid]['name']; ?></a></span>
	<?php else: ?>
	<?php echo "<a class='us-startups' title='暂未分类' href='#'>暂未分类</a>"; ?>
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
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻日志
function neighbor_log($neighborLog){extract($neighborLog);?>
<?php if($prevLog):?>
<div class="nav-left">
<span>
<i class="icon-chevron-left"></i>
上一篇：
</span><a rel="prev" href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a></div>
<?php else:?>
<div class="nav-left">
<span>
<i class="icon-chevron-left"></i>
上一篇：
</span><a rel="prev" href="<?php echo Url::log($prevLog['gid']) ?>">  木有了</a></div>
<?php endif;?>
<?php if($nextLog && $prevLog):?>
<?php endif;?>
<?php if($nextLog):?>
<div class="nav-right">
<span>
下一篇：
<i class="icon-chevron-right"></i>
</span> <a rel="next" href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a></div>
<?php else:?>
<div class="nav-right">
<span>
下一篇：
<i class="icon-chevron-right"></i>
</span><a rel="next" href="<?php echo Url::log($nextLog['gid']) ?>"> 木有了</a></div>
<?php endif;?>
<?php }?>
<?php
//blog-tool:获取Gravatar头像
function myGravatar($email, $s = 45, $d = 'mm', $g = 'g') {
$hash = md5($email);
$avatar = "http://secure.gravatar.com/avatar/$hash?s=$s&d=$d&r=$g";
return $avatar;
}?>
<?php
//首页置顶头条，不带图片
function sheli_zdLog() {
$db = MySql::getInstance();
$sql = "SELECT gid,title,content,date FROM ".DB_PREFIX."blog WHERE type='blog' and top='y' ORDER BY `top` DESC ,`date` DESC LIMIT 0,5";
$list = $db->query($sql);
while($row = $db->fetch_array($list)){
//$row['content'] = htmlspecialchars($row['content']);
$row['content'] = strip_tags($row['content']);?>
<h2><span>置顶推荐</span><a href="<?php echo Url::log($row['gid']); ?>" title="<?php echo $row['title']; ?>" target="_blank"><?php echo $row['title']; ?></a></h2>    
<?php } ?>
<?php } ?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
<div class="commentlist">
<h3>评论</h3>
	<?php endif; ?>
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<ol>
<li id="cmt<?php echo $comment['cid']; ?>">
		<div class="cmt-info">
<div class="gravatar">
<img class="avatar avatar-45 photo" width="45" height="45" src="<?php echo myGravatar($comment['mail']); ?>">
</div>
<div class="cmt-author">
<?php echo $comment['poster']; ?>
</div>
<div class="cmt-meta"> <?php echo $comment['date']; ?> </div>
		<div class="cmt-floor">
<a onclick="commentReply('<?php echo $comment['cid']; ?>')" href="#comment-<?php echo $comment['cid']; ?>">回复</a>
</div>
</div>
<div class="cmt-con">
<?php echo $comment['content']; ?>
</div>
	
		<?php blog_comments_children($comments, $comment['children']); ?></li>
</ol>
	<?php endforeach; ?>	
<div class="pagenavi commentpagebar">
	    <?php echo $commentPageUrl;?>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<ol>
<li id="cmt<?php echo $comment['cid']; ?>">
<div class="cmt-info">
		<div class="gravatar">
<img class="avatar avatar-45 photo" width="45" height="45" src="<?php echo myGravatar($comment['mail']); ?>">
</div>
<div class="cmt-author">
<a target="_blank" rel="nofollow" href=""><?php echo $comment['poster']; ?></a>
</div>
<div class="cmt-meta"> <?php echo $comment['date']; ?> </div>
<div class="cmt-floor">
<a onclick="commentReply('<?php echo $comment['cid']; ?>')" href="#comment">回复</a>
</div>
</div>
<div class="cmt-con">
<?php echo $comment['content']; ?>
<label id="AjaxComment5"></label>
</div>
</li>
</ol>
		<?php blog_comments_children($comments, $comment['children']);?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
<div id="comment" class="commentsform">
<h3><?php if(empty($ckname)){ echo "亲们，给个面子，评论评论吧！";}else if($ckname=='匿名'){ echo "匿名评论&nbsp;请叫我雷锋~";}else{echo $ckname;echo "欢迎回来...";} ?></h3>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<?php if(ROLE == ROLE_VISITOR): ?>
			<p>
				<input class="text" type="text" placeholder="输入你的昵称" value="游客" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1">
				<label for="author">昵称（必填）</label>
			</p>
			
			<?php endif; ?>
			<p><?php echo $verifyCode; ?> </p>
			<p><textarea placeholder="既然都来了，那就评论留下小脚印，留下你的小观点吧！" id="txaArticle" name="comment" id="comment" rows="10" tabindex="5"></textarea></p>
<p>
<div class="error"></div>
<input class="submit" type="submit" id="comment_submit" value="提交评论" tabindex="6" />
</p>
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		<p>
<a id="cancel-reply" style="display:none;" href="#comment" rel="nofollow">取消回复</a>
</p>
<p class="postbottom">◎欢迎参与讨论，请在这里发表您的看法、交流您的观点。</p>
</form>
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
//格式化内容工具
function blog_tool_purecontent($content, $strlen = null){
        $content = str_replace('继续阅读&gt;&gt;', '', strip_tags($content));
        if ($strlen) {
            $content = subString($content, 0, $strlen);
        }
        return $content;
}
?>
<?php //分页函数
function sheli_fy($count,$perlogs,$page,$url,$anchor=''){
$pnums = @ceil($count / $perlogs);
$page = @min($pnums,$page);
$prepg=$page-1;                 //shuyong.net上一页
$nextpg=($page==$pnums ? 0 : $page+1); //shuyong.net下一页
$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
//开始分页导航内容
$re = "";
if($pnums<=1) return false;	//如果只有一页则跳出	
if($page!=1) $re .=" <a href=\"$urlHome$anchor\">首页</a> "; 
if($prepg) $re .=" <a href=\"$url$prepg$anchor\"><span class='page'>‹‹</span></a> ";
for ($i = $page-2;$i <= $page+2 && $i <= $pnums; $i++){
if ($i > 0){if ($i == $page){$re .= " <span class='page now-page'>$i</span> ";
}elseif($i == 1){$re .= " <a href=\"$urlHome$anchor\">$i</a> ";
}else{$re .= " <a href=\"$url$i$anchor\">$i</a> ";}
}}
if($nextpg) $re .=" <a href=\"$url$nextpg$anchor\"><span class='page'>››</span></a> "; 
if($page!=$pnums) $re.=" <a href=\"$url$pnums$anchor\" title=\"尾页\">尾页</a>";
return $re;}
?>
<?php
//相关文章调用代码。
function related_logs($logData = array())
{$related_log_type = 'sort';//相关日志类型，sort为分类，tag为日志；
	$related_log_sort = 'rand';//排列方式，views_desc 为点击数（降序）comnum_desc 为评论数（降序） rand 为随机 views_asc 为点击数（升序）comnum_asc 为评论数（升序）
	$related_log_num = '4';//数量
	$related_inrss = 'n'; //是否显示在rss订阅中，y为是，其它值为否
	global $value;
	$DB = MySql::getInstance();
	$CACHE = Cache::getInstance();
	extract($logData);
	if($value)
	{
		$logid = $value['id'];
		$sortid = $value['sortid'];
		global $abstract;
	}
	$sql = "SELECT gid,title FROM ".DB_PREFIX."blog WHERE hide='n' AND type='blog'";
	if($related_log_type == 'tag')
	{
		$log_cache_tags = $CACHE->readCache('logtags');
		$Tag_Model = new Tag_Model();
		$related_log_id_str = '0';
		foreach($log_cache_tags[$logid] as $key => $val)
		{
			$related_log_id_str .= ','.$Tag_Model->getTagByName($val['tagname']);
		}
		$sql .= " AND gid!=$logid AND gid IN ($related_log_id_str)";
	}else{
		$sql .= " AND gid!=$logid AND sortid=$sortid";
	}
	switch ($related_log_sort)
	{
		case 'views_desc':
		{
			$sql .= " ORDER BY views DESC";
			break;
		}
		case 'views_asc':
		{
			$sql .= " ORDER BY views ASC";
			break;
		}
		case 'comnum_desc':
		{
			$sql .= " ORDER BY comnum DESC";
			break;
		}
		case 'comnum_asc':
		{
			$sql .= " ORDER BY comnum ASC";
			break;
		}
		case 'rand':
		{
			$sql .= " ORDER BY rand()";
			break;
		}
	}
	$sql .= " LIMIT 0,$related_log_num";
	$related_logs = array();
	$query = $DB->query($sql);
	while($row = $DB->fetch_array($query))
	{
		$row['gid'] = intval($row['gid']);
		$row['title'] = htmlspecialchars($row['title']);
		$related_logs[] = $row;
	}
	$out = '';
	if(!empty($related_logs))
	{
		foreach($related_logs as $val)
		{
			$out .= "<li><a href=\"".Url::log($val['gid'])."\" title=\"{$val['title']}\">
			<img width=\"190\" height=\"165\" src=\"".getxg_thum($val['gid'])."\" alt=\"{$val['title']}\"><i></i><span>{$val['title']}</span></a></li>";
		}
		$out .= "</ul>";
	}
	if(!empty($value['content']))
	{
		if($related_inrss == 'y')
		{
			$abstract .= $out;
		}
	}else{
		echo $out;
	}
}
?>
<?php
//获取相关文章缩略图
function getxg_thum($logid){$db = MySql::getInstance();$sqlimg = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$logid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') and width<=420 ORDER BY `aid` ASC LIMIT 0,1";$img = $db->query($sqlimg);while($roww = $db->fetch_array($img)){$thum_url=BLOG_URL.substr($roww['filepath'],3,strlen($roww['filepath']));}if (empty($thum_url)) {srand((double)microtime()*1000000);$randval = rand(0,4);$thum_url = TEMPLATE_URL.'style/images/rand/'.$randval.'.jpg';}return $thum_url;}?>
<?php
//获取图片
function get_thum($logid){
 $db = MySql::getInstance();
$thum_pic = EMLOG_ROOT.'/thumpic/'.$logid.'.jpg';
if (is_file($thum_pic)) {
    $thum_url = BLOG_URL.'thumpic/'.$logid.'.jpg'; 
}else{
	$sqlimg = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$logid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
//    die($sql);
	$img = $db->query($sqlimg);
    while($roww = $db->fetch_array($img)){
	 $thum_url=BLOG_URL.substr($roww['filepath'],3,strlen($roww['filepath']));
    }
    if (empty($thum_url)) {
srand((double)microtime()*1000000); 
$randval   =   rand(0,3); 
            $thum_url = TEMPLATE_URL.'style/images/rand/'.$randval.'.jpg';
        }
    }
echo $thum_url;
}
?>
