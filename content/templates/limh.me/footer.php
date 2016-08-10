<?php
if (!defined('EMLOG_ROOT')) {
    exit('error!');
}
?>
</div>

<div class="clear"></div>
<div class="blackground"></div>
<div title="返回顶部(或任意位置双击左键)" class="backtop"></div>
<nav id="mmenu" role="navigation">
  <ul>
    <li>
      <div class="msearch">
        <form name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
          <input type="text" name="keyword" placeholder="搜搜更健康" />
          <input type="submit" name="submit" value="搜索" />
        </form>
      </div>
    </li>
    <?php blog_navi();?>
  </ul>
</nav>
</div>
<footer id="footer" role="contentinfo">
  <address>
&nbsp;<?php echo $footer_info; ?>
    <?php doAction('index_footer'); ?>
    &nbsp;<br>
  <i class="fa fa-html5"></i> Copyright&nbsp;©&nbsp;2012-<?php echo date('Y',time())?>&nbsp;<a href="#">段彤博客-最好用的分享博客网</a>
<!--<?php echo $blogname; ?><div class="copyright">&nbsp;-->
&nbsp;|&nbsp;勉强运行：<?php echo floor((time()-strtotime(""._g('webtime').""))/86400); ?>天&nbsp;&nbsp;<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a>&nbsp;|&nbsp;<?php echo strtoupper(runtime_display()); ?>&nbsp;|	

<img src="http://www.0ddt.com/content/uploadfile/tpl_options/tps.png">
<a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=37082702000119" target="_blank">鲁公网安备 37082702000119号</a>

<!--&nbsp;自豪的采用 <a href="http://www.emlog.net" title="Emlog <?php echo Option::EMLOG_VERSION;?>" target="_blank">Emlog <?php echo Option::EMLOG_VERSION;?></a>&nbsp;驱动&nbsp;&nbsp;主题：<a href="http://limh.me" title="明月浩空" target="_blank">Colorful[Pjax专版]</a>-->

</div>
  </address>
</footer>
<div id="totop" class="totop"><i class="fa">&#61610;</i></div>
<div class="colorful_loading_frame">
  <div class="colorful_loading"><i class="rect1"></i><i class="rect2"></i><i class="rect3"></i><i class="rect4"></i><i class="rect5"></i></div>
</div>
</div>
<?php
$bgimgsrc = TEMPLATE_URL . 'images/bg/' . rand(1, 3) . '.jpg' ?>
<img class="bg-image" src="<?php echo $bgimgsrc; ?>" /><div class="bg-image-pattern"></div>
<script type="text/javascript">blogname="<?php echo $blogname; ?>";</script>
<?php if(_g('pjax')==1):?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/global-pjax.js?v=20151004"></script>
<?php else: ?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/global.js?v=20151004"></script>
<?php endif;?>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>js/realgravatar.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.js?v=20150310"></script>
<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_URL; ?>style/highslide/highslide.css?v=20141026" />
<?php doAction('myhk_player'); ?>
</body></html>