<?php 
/**
 * 文章列表
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
if($pageurl == Url::logPage()){
	include View::getView('index');
	exit;
}
?>
<div class="container">
<main class="main" role="main">
<?php 
if (!empty($logs)):
foreach($logs as $value): 
?>
<article id="cate1 auth1" class="animated zoomInUp post">
			<?php if (_g('s_img') == "yes"): ?>
			<div class="thumb">
			<?php
//获取缩略图
preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
if (!empty($img[1])) {
    $thum_src = $img[1][0]; //正文第一张图片
}else{
    $rand_num = 0; //随机图片数量，按实际数量设置
    if ($rand_num == 0) {
        $thum_src = TEMPLATE_URL."style/images/nopic.gif";
        //默认图片，须命名为"0.jpg"
    }else{
        $thum_src = TEMPLATE_URL."img/g/".rand(1,$rand_num).".jpg";
        //随机图片，须按"1.jpg","2.jpg","3.jpg"...的顺序命名
    }
    //上述默认图片(0.jpg)与随机图片(random目录)须保存在模板目录中的"thumbnail"目录下
 }
?>
		<a title="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>">
		<img src="<?php echo $thum_src; ?>" alt="<?php echo $value['log_title']; ?>" original="<?php echo $thum_src; ?>">
		</a>
	</div>
	<?php endif; ?>
			
	<h2><a title="<?php echo $value['log_title']; ?>" href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a></h2>
	<div class="entry loop-entry">
				<p><?php echo $logdes = blog_tool_purecontent($value['content'], 100); ?></p>
		</div>
	<div class="postmeta">
		<span><i class="icon-calendar"></i> 日期：<?php echo gmdate('Y-n-j', $value['date']); ?> </span>
		<span><i class="icon-fire"></i> 浏览：<?php echo $value['views']; ?>次</span>
		<span><i class="icon-comments"></i> 评论：<?php echo $value['comnum']; ?>条</span>
	</div>
</article>	
<?php 
endforeach;
else:
?>
	<h2>未找到</h2>
	<p>抱歉，没有符合您查询条件的结果。</p>
<?php endif;?>
<div class="pagenavi">
<?php echo sheli_fy($lognum,$index_lognum,$page,$pageurl);?>
</div>
</main>
<?php
 include View::getView('side');
?>
</div>
<?php
 include View::getView('footer');
?>
