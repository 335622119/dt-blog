<?php
/**
 * gvgu_image_watermark_setting.php
 * design by LaiFangwen, KLLER
 */
!defined('EMLOG_ROOT') && exit('access deined!');

function plugin_setting_view()
{
	include(EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/db.php');
?>
<script type="text/javascript">
$("#gvgu_image_watermark").addClass('sidebarsubmenu1');
function myKeyDown(e){
	if(window.event){//IE
		var k = e.keyCode;
		if ((k == 13)||(k == 9) || (k == 35) || (k == 36) || (k == 8) || (k == 46) || (k >= 48 && k <=57 )||( k >= 96 && k <= 105)||(k >= 37 && k <= 40)){
		}else{
			window.event.returnValue = false;
		}
	}else{//火狐
		var k = e.which;
		if ((k == 13)||(k == 9) || (k == 35) || (k == 36) || (k == 8) || (k == 46) || ( k>= 48 && k <= 57)||(k >= 96 && k <= 105)||(k >= 37 && k <= 40)){
		}else{
			e.preventDefault();
		}
	}
}
setTimeout(hideActived,2600);
</script>
<div class=containertitle><b>水印设置</b><?php if(isset($_GET['setting'])):?><span class="actived">设置成功</span><?php endif;?></div>
<div class=line></div>
<form action="./plugin.php?plugin=gvgu_image_watermark&action=setting" method="POST">
设置水印位置：<br />

  <table width="200" border="0">
    <tr>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="1" <?php if($waterPos==1):?>checked="checked"<?php endif;?> />
      左上</label></td>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="2" <?php if($waterPos==2):?>checked="checked"<?php endif;?> />
      中上</label></td>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="3" <?php if($waterPos==3):?>checked="checked"<?php endif;?> />
      右上</label></td>
    </tr>
    <tr>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="4" <?php if($waterPos==4):?>checked="checked"<?php endif;?> />
      左中</label></td>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="5" <?php if($waterPos==5):?>checked="checked"<?php endif;?> />
      中间</label></td>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="6" <?php if($waterPos==6):?>checked="checked"<?php endif;?> />
      右中</label></td>
    </tr>
    <tr>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="7" <?php if($waterPos==7):?>checked="checked"<?php endif;?> />
      左下</label></td>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="8" <?php if($waterPos==8):?>checked="checked"<?php endif;?> />
      中下</label></td>
      <td><label>
        <input type="radio" name="gvguweizhi" id="radio" value="9" <?php if($waterPos==9):?>checked="checked"<?php endif;?>  />
      右下</label></td>
    </tr>
  </table><br />
  <table width="300" border="1">
    <tr>
      <td width="60">水印文字：</td>
      <td><input type="text" name="gvguwenziText" size="30" maxlength="30" value="<?php echo $waterText; ?>" style="width:150px;" /></td>
    </tr>
    <tr>
      <td>文字大小：</td>
      <td><input type="text" name="gvguwenziDxiao" size="30" maxlength="2" value="<?php echo $textFont; ?>" style="ime-mode:disabled; width:80px;" onkeydown="myKeyDown(event);" /></td>
    </tr>
    <tr>
      <td>文字颜色：</td>
      <td><input type="text" name="gvguwenziYanse" size="30" maxlength="7" value="<?php echo $textColor; ?>" style="ime-mode:disabled; width:80px;" /></td>
    </tr>
    <tr>
      <td>水印类型：</td>
      <td><label><input type="radio" name="watermarkType" value="text" <?php if($watermarkType == 'text') echo 'checked'; ?> />文字水印</label> <label><input type="radio" name="watermarkType" value="image" <?php if($watermarkType == 'image') echo 'checked'; ?> />图片水印</label></td>
    </tr>
    <tr>
      <td>水印范围：</td>
      <td><label><input type="radio" name="watermarkPlace" value="log" <?php if($watermarkPlace == 'log') echo 'checked'; ?> />日志</label> <label><input type="radio" name="watermarkPlace" value="kl_album" <?php if($watermarkPlace == 'kl_album') echo 'checked'; ?> />EM相册</label> <label><input type="radio" name="watermarkPlace" value="log&kl_album" <?php if($watermarkPlace == 'log&kl_album') echo 'checked'; ?> />日志和EM相册</label></td>
    </tr>
  </table>
<input type="submit" value="提 交" />
</form>
<div style="margin-top:20px; padding:5px; width:650px; border:1px dashed #CCC">
<p><font color="Red"><b>小提示：</b><br /></font>
1、插件设置中的文字大小,就是我们平时用到的html的fontSize属性。<br />
2、文字颜色为#XXXXXX格式,如红色:#FF0000, 蓝色：#0000FF。<br />
3、如果使用图片水印，请将你的水印图片更名为gvgu_watermark.gif,覆盖掉本插件目录下的gvgu_watermark.gif。<br />
4、如果上面设置保存不成功,请确认您的插件目录下db.php文件的权限为777。
</p>
</div>
<?php
}
function plugin_setting()
{
	$fso = fopen(EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/db.php','r');
	$config = fread($fso,filesize(EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/db.php'));
	fclose($fso);
	$gvguweizhi = intval(trim($_POST['gvguweizhi']));
	$gvguwenziText = trim($_POST['gvguwenziText']);
	$gvguwenziDxiao = intval(trim($_POST['gvguwenziDxiao']));
	$gvguwenziYanse = trim($_POST['gvguwenziYanse']);
	$watermarkType = addslashes(trim($_POST['watermarkType']));
	$watermarkPlace = addslashes(trim($_POST['watermarkPlace']));
	$pattern = array("/waterPos =(.*);/","/waterText=\"(.*)\";/","/textFont =(.*);/","/textColor=\"(.*)\";/","/watermarkType=\"(.*)\";/","/watermarkPlace=\"(.*)\";/",);
	$replace = array("waterPos =".$gvguweizhi.";","waterText=\"".$gvguwenziText."\";","textFont =".$gvguwenziDxiao.";","textColor=\"".$gvguwenziYanse."\";","watermarkType=\"".$watermarkType."\";","watermarkPlace=\"".$watermarkPlace."\";",);
	$new_config = preg_replace($pattern, $replace, $config);
	$fso = fopen(EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/db.php','w');
	fwrite($fso,$new_config);
	fclose($fso);
}
?>