<?php 
/**
 * 站点首页模板
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="container">
<main class="main" role="main">
<?php if (_g('focus_img') == "yes"): ?>
<div class="rslides_container">
<ul id="slider" class="rslides centered-btns centered-btns1">
    <li id="centered-btns1_s0" style="display: block; float: left; position: relative; opacity: 1; z-index: 2; transition: opacity 500ms ease-in-out 0s;"
    class="">
        <a title="<?php echo _g('hdt1');?>" target="_blank" href="<?php echo _g('hda1');?>">
            <img alt="<?php echo _g('hdt1');?>" src="<?php echo _g('hd1');?>">
        </a>
    </li>
    <li id="centered-btns1_s1" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 500ms ease-in-out 0s;"
    class="">
        <a title="<?php echo _g('hdt2');?>" target="_blank" href="<?php echo _g('hda2');?>">
            <img alt="<?php echo _g('hdt2');?>" src="<?php echo _g('hd2');?>">
        </a>
    </li>
    <li id="centered-btns1_s2" style="float: none; position: absolute; opacity: 0; z-index: 1; display: list-item; transition: opacity 500ms ease-in-out 0s;"
    class="">
        <a title="<?php echo _g('hdt3');?>" target="_blank" href="<?php echo _g('hda3');?>">
            <img alt="<?php echo _g('hdt3');?>" src="<?php echo _g('hd3');?>">
        </a>
    </li>
</ul>
</div><?php endif; ?>
<div class="clear"></div>
<?php if (_g('index_top') == "yes"): ?>
<div class="post istop">
<h2><span>置顶推荐</span>
<a href="<?php echo _g('index_top1');?>" target="_blank" title="<?php echo _g('index_title');?>"><?php echo _g('index_title');?></a>
</h2>
</div>
<?php endif; ?>
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
        //默认图片"
    }else{
        $thum_src = TEMPLATE_URL."style/images/rand/".rand(0,$rand_num).".jpg";
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
