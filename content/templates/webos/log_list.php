<?php 
/**
 * 站点首页模板
 */
 if(!defined('EMLOG_ROOT')) {exit('error!');} 
   if(blog_tool_ishome()){
        include View::getView('home');
   }else{
   ?>



<div class="wrap s_clear sjzsy" align="center">

<?php 
if (!empty($logs)):
foreach($logs as $value): 
?>
<div class="yi_blog">
<div class="hentai_title"><p style="margin-left:6px;float:left;color:#999;"><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></p></div>
<div class="hentai">
  <div style="height:5px"></div>
<div class="hentai_post"><p style="margin-left:6px;float:left;color:#999;"><a>
<?php echo subString(strip_tags($value['content']),0,70,"..."); ?>
</a></p></div>
<div style="height:20px"></div>
<div class="hentai_time">
	<a style="float:left;">&nbsp;
    	<i class="fa fa-user fa-lg"></i>&nbsp;
			<?php blog_author($value['author']); ?> &nbsp;&nbsp;&nbsp;
        <i class="fa fa-clock-o fa-lg"></i>&nbsp;
			<?php echo gmdate('Y-n-j', $value['date']); ?>
    </a>
<a style="float:right;"><i class="fa fa-users fa-lg"></i>&nbsp;<?php echo $value['comnum']; ?>Comments</a>
<div style="height:20px"></div>
</div>
</div>
</div>

<div style="height:20px"></div>
<?php 
endforeach;
else:
?>
<div class="yi_blog">
	<h2>未找到</h2>
	<p>抱歉，没有符合您查询条件的结果。</p>
    </div>
<?php endif;?>
<div class="page_navi container"><?php echo $page_url;?></div>
</div>
<?php
 include View::getView('footer');
?><?php mysql_close();}?>