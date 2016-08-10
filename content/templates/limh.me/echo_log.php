<?php
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php if($_COOKIE['myhk_sidebar']=='no'):?>
<style type="text/css">
#content {
	width: 100%;
	border-right: 0px
}
#sidebar {
	display: none
}
</style>
<?php endif;?>
<div id="content" role="main">
  <div class="page">
    <article role="article">
      <header class="post-header">
        <h2><?php echo subString(strip_tags($log_title),0,50); ?></h2>
      </header>
      <address class="post-metaa">
      <i class="fa fa-home"></i><a pjax="网站首页" href="<?php echo BLOG_URL;?>" title="返回首页"> 首页</a> &raquo; <i class="fa fa-folder-open-o"></i>
      <?php getBlogSort($logid);?>
      &raquo;
      <?php if($author == 1): ?>
      <?php else: ?>
      <?php endif; ?>
      <i class="fa fa-clock-o"></i>
      <?php mydate($date) ?> <?php editflg($logid,$author); ?>
      <ul class="tools">
        <li title="发表吐槽" class="go-comment"><i class="fa fa-comment"></i></li>
        <a target="_blank" href="https://limh.me/api/qrapibig.php?url=<?php echo Url::log($logid); ?>.jpg" class="go-qrcode">
        <li title="用手机扫描二维码访问"><i class="fa fa-qrcode"></i></li>
        </a>
        <?php share(); ?>
        <li title="字号" class="size" onclick="size(this)">A</li>
        <li title="打开/关闭侧边栏" class="fullscreen">
          <?php if($_COOKIE['myhk_sidebar']=="no"){ echo '<i class="fa fa-reply"></i>'; }else{ echo  '<i class="fa fa-share"></i>'; } ?>
        </li>
      </ul>
      </address>
      <div class="post-context">
        <?php if($top=='y'){echo "<div class='pgood'></div>";}else if(($value['comnum']>=1000)&&($value['views']>=50)){echo "<div class='pretie'></div>";};?>
        <?php echo content($log_content); ?>
        
        <div class="post-lisence">
          <div class="qrimg"><a target="_blank" href="https://limh.me/api/qrapibig.php?url=<?php echo Url::log($logid); ?>.jpg"><img src="<?php echo TEMPLATE_URL; ?>images/qrapibig.jpg" alt="<?php echo $log_title; ?>" title="用手机扫描二维码访问"></a></div>
		  <div class="post-tags"><i class="fa fa-tags"></i> 本文标签：<?php blog_tag($logid);?></div>
          <i class="fa fa-bullhorn"></i> 版权声明：若无特殊注明，本文皆为《
          <?php blog_author($author); ?>
          》原创，转载请保留文章出处。</br>
          <i class="fa fa-share-alt-square"></i> 本文链接：<?php echo $log_title; ?> <?php echo Url::log($logid); ?></div>
        <div class="cutline"><span>正文到此结束</span></div>
        <div class="post-navigation">
          <?php neighbor_log($neighborLog); ?>
        </div>
      </div>
    </article>
    <?php doAction('log_related', $logData); ?>
    <?php $CACHE = Cache::getInstance();$sta_cache = $CACHE->readCache('sta');if($sta_cache['lognum']>=6):?>
    <div class="post-related">
      <h3><i class="fa fa-fire"></i> 热门推荐</h3>
      <ul>
        <?php $date = time() - 3600 * 24 * 360;$Log_Model = new Log_Model();$viewslogs = $Log_Model->getLogsForHome("AND date > {$date} ORDER BY views DESC,date DESC", 1, 6);?>
        <?php foreach($viewslogs as $value): ?>
        <li>
          <div class="thumb"><a pjax="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>" title="查看文章：<?php echo $value['log_title']; ?>">
            <?php
 $thum_src = getThumbnail($value['logid']);
 $imgFileArray = TEMPLATE_URL.'images/random/tb'.rand(1,40).'.jpg';
 if(!empty($thum_src)){ ?>
            <img src="<?php echo $thum_src; ?>" alt="<?php echo $value['log_title']; ?>" title="查看文章：<?php echo $value['log_title'] ?>" />
            <?php
 }else{
 ?>
            <img src="<?php echo $imgFileArray; ?>" alt="<?php echo $value['log_title']; ?>" title="查看文章：<?php echo $value['log_title'] ?>" />
            <?php
 }
 ?>
            </a></div>
          <div class="title"><a pjax="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>" title="查看文章：<?php echo $value['log_title']; ?>"><?php echo $value['log_title']; ?></a></div>
          <div class="modified">热门指数：
            <?php if($value['comnum']>70){ echo '<span class="five-star"></span>'; }else if($value['comnum']>50){ echo '<span class="four-star"></span>'; }else if($value['comnum']>30){ echo '<span class="three-star"></span>'; }else if($value['comnum']>10){ echo '<span class="two-star"></span>'; }else{ echo '<span class="one-star"></span>'; }; ?>
          </div>
        </li>
        <?php endforeach; ?>
      </ul>
      <div class="clear"></div>
      <div class="cutline"></div>
    </div>
    <?php else: ?>
    <?php endif;?>
    <div id="comments">
      <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
      <?php if(empty($comnum)){ echo "<br/><span class='nop'><i class='fa fa-pencil'></i> 既然没有吐槽，那就赶紧抢沙发吧！</span>";}else{echo"<h3><i class='fa fa-comments-o'></i> 已有";echo $comnum;echo"条吐槽</h3>";} ?>
      <?php blog_comments($comments,$params); ?>
    </div>
  </div>
</div>
<?php
 include View::getView('side');
 include View::getView('footer');
?>
