<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>

<footer class="footer">
<div class="foot">
<p>
Copyright ©
Powered by <a href="http://www.emlog.net" title="采用emlog系统">emlog</a> 
<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a> 
	<?php doAction('index_footer'); ?>

</p>
<p> <?php echo $footer_info; ?></p>
</div>
</footer>
<div class="pjax_loading"></div>
<div class="pjax_loading1"></div>
<div class="backtop">
	<a title="反回顶部"><i class="icon-chevron-up"></i></a>
</div>
<script src="<?php echo TEMPLATE_URL; ?>script/jquery.lazyload.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>script/responsiveslides.min.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>script/leonhere.js" type="text/javascript"></script>
<link href="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$(".post .thumb img,.entry img").lazyload({
  	  	placeholder : "<?php echo TEMPLATE_URL; ?>style/images/grey.gif", 
  	 	effect      : "fadeIn"
	});
});
</script>
<script type="text/javascript">
jQuery(document).ready(function($) {
    hs.graphicsDir = "<?php echo TEMPLATE_URL; ?>style/highslide/graphics/";
	hs.align = "center";
	hs.transitions = ["expand", "crossfade"];
	hs.outlineType = "rounded-white";
	hs.wrapperClassName = "dark borderless floating-caption";
	hs.fadeInOut = !0;
	hs.dimmingOpacity = .75;
    hs.addSlideshow({
        interval: 5000,
        repeat: true,
        useControls: true,
        fixedControls: "fit",
        overlayOptions: {
            opacity: 0.75,
            position: "bottom center",
            hideOnMouseOut: true

        }

    });
	jQuery(function($){$("a[href$=jpg],a[href$=gif],a[href$=png],a[href$=jpeg],a[href$=bmp]").addClass("highslide").each(function(){this.onclick=function(){return hs.expand(this)}});})
});
</script>
<script type="text/javascript">
$(function(){
	$("#slider").responsiveSlides({
		auto: true,
		pager: true,
		nav: false,
		speed: 500,
		timeout: 5000,
		namespace: "centered-btns"
	});
});
</script>
<?php doAction('myhk_player'); ?>
<?php doAction('index_bodys'); ?>
</body>
</html>