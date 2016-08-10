<?php 
/**
 * 页面底部信息
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div style="height:20px; clear:both;"></div>
<!--footer begin-->
<div class="footer">
  <div class="wrapper">
    <div class="col">
      <div class="span-c"> <img src="<?php echo _g('qrcode'); ?>" width="118" height="118"/></div>
      <div class="span-a">
      	<p class="span-b"><a href="<?php echo BLOG_URL; ?>" style="margin-left:0"><?php echo $blogname; ?></a> | <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo _g('ctqq'); ?>&site=812834272&menu=yes" target="_blank">QQ联系</a><?php echo _g('footlink'); ?>
        <p>&copy;2011-2016 <?php echo $blogname; ?> All right reserved. 版权所有 <span style="padding-left:10px;"><?php echo $footer_info; ?></span> </p>
        <p>Themes by <a href="http://www.idaoker.com" target="_self">盗客网</a>  [声明：本站所有资源收集于互联网，仅供大家学习和参考，如有侵权，请联系812834272@qq.com及时删除！]</p></p>
        <p><?php echo $icp; ?></p>
        <?php doAction('index_footer'); ?>
      </div>
    </div>
  </div>
</div>
</div>
<div id="code"></div>
<div id="code_img"><img src="<?php echo _g('qrcode'); ?>" width="230" /><p class="lh180 pt10"><?php echo _g('qrtext'); ?></p></div>
<a id="gotop" href="javascript:void(0)"></a>
</body>
</html>