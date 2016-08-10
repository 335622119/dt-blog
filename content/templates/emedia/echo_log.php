<?php 
/**
 * 阅读文章页面
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<!--wrapper begin-->
<div class="wrapper clearfix pt10">
  <div class="con-left">
    <div class="positionbar">
      <ul  class="bread clearfix">
        <li class="ico"><img src="<?php echo TEMPLATE_URL; ?>images/ico_07.png" /></li>
        <li><a href="<?php echo BLOG_URL; ?>">首页</a></li>
        <li><?php blog_sort($logid); ?></li>
        <li class="last"><?php echo $log_title; ?></li>
      </ul>
    </div>
    <!--articleList begin-->
    <div class="articleList">
      <h1 class="main-tit2"><?php topflg($top); ?><span class="black f20 fb"><a href="<?php echo Url::log($logid); ?>"><?php echo $log_title; ?></a></span></h1>
    </div>
    <p class="icogroup" style="padding-bottom:10px; margin-bottom:10px; border-bottom:1px dashed #eee;"><span class="ico-list"><span class="icon icon-01"></span>作者：<?php blog_author($author); ?></span><span class="ico-list"><span class="icon icon-02"></span><?php echo gmdate('Y-n-j G:i', $date); ?></span><span class="ico-list"><span class="icon icon-03"></span>分类：<?php blog_sort($logid); ?></span><span class="ico-list"><?php blog_tag($logid); ?></span> <?php editflg($logid,$author); ?></p>
    <div class="art-content pt10 f16 lh200">
<?php echo $log_content; ?>
    </div>
    <!--内容结束-->
	<div class="tip-bar mt20 clearfix"><span class="tit">温馨提示</span>如有转载或引用以上内容之必要，敬请将<a href="<?php echo Url::log($logid); ?>" target="_blank" style="color:#00AA98;">本文链接</a>作为出处标注，谢谢合作！</div>
    <?php doAction('log_related', $logData); ?>
    <div class="tc p10 nextlog"><?php neighbor_log($neighborLog); ?></div>
    <div class="ad mb15"><?php echo _g('logad'); ?></div>
    <div class="link-box">
      <h3>相关文章</h3>
      <ul class="ullist4">
	  	  <?php get_list($sortid); ?>
      </ul>
    </div>
    <div class="bk20"></div>
    <div class="comment">
      <h3 class=" clearfix"><span class="fr">已有 <?php echo $comnum; ?>/<?php echo $views; ?> 人参与</span></h3>
		<?php blog_comments($comments); ?>
        <?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
    </div>
    <div class="bk30"></div>
    <!--articleList end-->
  </div>
  <!--con-left end-->
  <div class="con-right">
<?php
include View::getView('side');
?>
   </div>
  <!--con-left end-->
</div>
<!--wrapper end-->
</div>
<?php
include View::getView('footer');
?>