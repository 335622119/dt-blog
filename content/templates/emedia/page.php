<?php 
/**
 * 自建页面模板
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
        <li>页面</li>
        <li class="last"><?php echo $log_title; ?></li>
      </ul>
    </div>
    <!--articleList begin-->
    <div class="articleList">
      <h1 class="main-tit2"><span class="black f20 fb"><a href="<?php echo Url::log($logid); ?>"><?php echo $log_title; ?></a></span></h1>
    </div>
    <div class="art-content pt20 f16 lh200">
<?php echo $log_content; ?>
    </div>
    <!--内容结束-->
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