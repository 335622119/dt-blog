<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="wrapper clearfix pt10">
  <div class="con-left"> 
<?php if($pageurl == Url::logPage()){ ?>
    <div class="yx-rotaion" style="margin-bottom:25px;">
      <ul class="rotaion_list">
         <?php home_slide(); ?>
       </ul>
    </div>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/jquery.yx_rotaion.js"></script> 
<script type="text/javascript">
$(".yx-rotaion").yx_rotaion({auto:true});
</script> 
    <!--焦点图结束--> 
    <div class="articleList">
      <h3 class="main-tit"><span class="tit"><?php echo _g('inewti'); ?></span><span class="gray-3"><?php echo _g('inewdes'); ?></span></h3>
    </div>
<?php }else{?>
	<div class="bk8"></div>
<?php }?>
<?php doAction('index_loglist_top'); ?>
    <!--articleList begin-->
    <ul class="articleCon">
<?php 
if (!empty($logs)):
foreach($logs as $key=>$value): 
$search_pattern = '%<img[^>]*?src=[\'\"]((?:(?!\/admin\/|>).)+?)[\'\"][^>]*?>%s';
preg_match($search_pattern, $value['content'], $img);
$value['img'] = isset($img[1])?$img[1]:TEMPLATE_URL.'images/nopic.gif';
?>
       <li class="clearfix">
        <div class="thumb"><a href="<?php echo $value['log_url']; ?>" target="_blank"> <img src="<?php echo $value['img']; ?>" width="200" height="131" /> </a></div>
        <div class="mark">
          <h1><a href="<?php echo $value['log_url']; ?>" target="_blank"><?php echo $value['log_title']; ?></a></h1>
          <p class="icogroup"><span class="ico-list"><span class="icon icon-01"></span>作者：<?php blog_author($value['author']); ?></span><span class="ico-list"><span class="icon icon-02"></span><?php echo gmdate('Y.n.j', $value['date']); ?></span><span class="ico-list"><span class="icon icon-03"></span><?php blog_sort($value['logid']); ?></span></p>
          <p class="info"><?php echo subString(strip_tags($value['log_description']),0,100,"..."); ?></p>
        </div>
        <a href="<?php echo $value['log_url']; ?>" class="more" target="_blank">阅读全文</a>
    </li>
<?php 
endforeach;
?>
          </ul>
<?php 
else:
?>
		<div class="nolog">
            <h2>暂无内容</h2>
            <p><br />抱歉，没有符合您查询条件的结果。</p>
		</div>
<?php endif;?>
    <div class="bk15"></div>
    <div class="pagination">
    	<?php echo $page_url;?>
    </div>
  </div>
  <!--con-left end-->
  <div class="con-right">
<?php if($pageurl == Url::logPage()): ?>
    <div class="">
      
        <div class="icogroup">
        <ul class="">
         
        </ul>
      </div>
    </div>
<?php endif; ?>
<?php
include View::getView('side');
?>
	</div>
</div>
<div class="bk8"></div>
<div class="wrapper ibtad">
    <?php echo _g('bvad'); ?>
</div>
<!--wrapper end-->
<?php if($pageurl == Url::logPage()): ?>
    <div class="frend-link">
      <h3><span class="fl">友情链接</span><span class="fr"><a href="http://www.idaoker.com/?post=6">申请&amp;说明</a></span></h3>
      <dl class="clearfix">
          <?php ilinks(); ?>
      </dl>
    </div>
<?php endif; ?>
</div>
<?php
include View::getView('footer');
?>