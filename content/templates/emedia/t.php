<?php 
/**
 * 微语部分
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
        <li class="last">微语</li>
      </ul>
    </div>
    <!--articleList begin-->
    <div class="articleList">
      <h1 class="main-tit2"><span class="black f20 fb"><a href="<?php echo Url::log($logid); ?>"><?php echo $log_title; ?></a></span></h1>
    </div>
    <div class="art-content pt20 f16 lh200">
		<div class="nolog">
        	<p>太任性了~<br /><br /></p>
            <h2>很不给力啊，微语页居然木有！</h2>
            <p><br />当前模板 <a href="http://www.emlog.net/template/550" target="_blank">[尊享版]</a> 才有微语页，同时也是一款自适应模板、支持无限CMS文字列表模块，<a href="http://www.ewceo.com/" target="_blank">联系模板作者</a> 定制模板也可以的哦~<br /><br />尊享那种感觉你懂的……</p>
		</div>
    </div>
    <!--内容结束-->
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