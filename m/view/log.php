<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<!-- 公告消息提示(调用最新微语) -->
<?php global $CACHE; $nt = $CACHE->readCache('newtw'); ?> 
<div class="message"><div class="msg-header"><b>〓</b><span>博主微语栏</span><a href="./?action=tw">查看更多»</a></div><div class="msg-content"><?php echo $nt[0]['t'];?><div class="msg-time"><b>发表于<?php echo smartDate($nt[0]['date']);?></b><span class="line"></span></div></div></div>
<!--div class="collegeEntrance" style="display:none">
<span class="gaokao">消息窗</span>
</div-->
<!-- 文章列表 -->
<div id="article-list">
<?php foreach($logs as $value): ?>
<div class="post"><div class="title"><a href="<?php echo BLOG_URL; ?>m/?post=<?php echo $value['logid'];?>" target="_blank"><?php if ($value['top']=='y') echo "<span class=\"top\">顶</span>"; ?><?php 
$t=time() - 3*24*60*60;
$log_t=gmdate('Y-m-d',$value['date']);
$diy_t=date("Y-m-d",$t);
if($log_t > $diy_t) echo '<span class="new">新</span>';
?><?php 
if ($value['views'] >= 300) echo '<span class="hot">热</span>';
?><?php echo $value['log_title']; ?></a></div>
<div class="info"><?php echo gmdate('<b>Y</b>年<b>m</b>月<b>d</b>日', $value['date']); ?><span>星期<?php $weekarray=array("日","一","二","三","四","五","六"); echo $weekarray[gmdate('w', $value['date'])]; ?>&nbsp;&nbsp; <?php echo gmdate('<b>G</b>:<b>i</b>', $value['date']); ?></span></div>
<div class="description">
<?php
preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
	$imgsrcb = !empty($img[1]) ? $img[1][0] : '';
	if(pic_thumb($value['content'])){
	$imgsrc = pic_thumb($value['content']);
	}else
	$imgsrc = BLOG_URL.'m/view/random/tb'.rand(1,20).'.jpg';
	?>
<!--span class="post-img"><img src="<?php echo $imgsrc; ?>"/></span-->

<span><?php echo $value['log_description'] = strip_tags(subString(strip_tags($value['log_description']),0,140));?>
</span></div><div class="post-footer"><span class="category">分类: <?php if($value[sortid] > 0):?><a href="./?sort=<?php echo $value[sortid]; ?>"><b><?php echo $sort_cache[$value[sortid]]['sortname']; ?></b></a><?php else: ?>暂未分类<?php endif;?>
</span>评论:<b><?php echo $value['comnum']; ?></b>&nbsp;阅读:<b><?php echo $value['views']; ?></b></div>
</div><?php endforeach; ?></div>
<?php echo $page_url; ?>
<div class="hot-log-title">
<span class="title-left">本月热门文章</span><span class="right">推荐阅读»</span></div>
<ul class="hot-log">
<?php getdatelogs(6);?>
</ul>
<div id="footer-nav">
<table cellpadding="0" cellspacing="0"><tbody><tr>
<td class="links-title">友情链接:</td>
<td class="select-links">
<select class="links" onchange="location.href=this.options[this.selectedIndex].value;">
<?php global $CACHE; $link_cache = $CACHE->readCache('link'); ?>
<?php foreach($link_cache as $value): ?><option value="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>"><?php echo $value['link']; ?></option><?php endforeach; ?><option value="./?post=3">申请友链</option>
</select></td><td class="login">
<?php if(ISLOGIN === true): ?><a href="./?action=write">写文</a><a href="./?action=logout">退出</a><?php else:?><a href="<?php echo BLOG_URL; ?>m/?action=login">登录</a><?php endif;?></td>
</tbody></table>
</div>
<div class="blog-num"><div class="search">
<form name='keyword' method="post" action="./index.php?action=s"><input type="text" name="keyword" placeholder="输入关键词"/><input type="submit" value="搜索"/></form></div><?php $sta_cache = Cache::getInstance()->readCache('sta');?>
<ul><li>日志数量: <b><?php echo $sta_cache['lognum']; ?></b></li><li>微语数量: <b><?php echo $sta_cache['twnum']; ?></b></li><li>评论数量: <b><?php echo $sta_cache['comnum']; ?></b></li><li>运行天数: <b><?php echo floor((time()-strtotime("2014-04-14"))/86400); ?></b></li></ul><div class="clear"></div></div>
<div class="select-theme"><a href="<?php echo BLOG_URL; ?>m" class="left">普通版</a><a href="javascript:void(0);" class="center">触屏版</a><a href="<?php echo BLOG_URL; ?>">电脑版</a></div>