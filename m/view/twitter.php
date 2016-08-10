<?php if(!defined('EMLOG_ROOT')) {exit('error!');}?>
<div id="content"><div id="weiyu">
<?php if(ROLE == ROLE_ADMIN): ?>
<form method="post" action="./index.php?action=t" enctype="multipart/form-data">
<div class="weiyu-tips">微语内容(可作为首页公告)</div>
<textarea cols="20" rows="3" name="t"></textarea>
<div class="select-img">选择要上传的图片:</div>
<input type="file" name="img" /><br/>
<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
<input type="submit" value="发布微语/公告" />
</form>
<?php endif;?>
<?php 
foreach($tws as $value):
$img = empty($value['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$value['img'].'"/></a>';
$by = $value['author'] != 1 ? 'by:'.$user_cache[$value['author']]['name'] : '';
?>
<div class="weiyu"><div class="weiyu-content"><?php echo $value['content'];?><p><?php echo $img;?></p></div>
<div class="weiyu-time"><?php echo $by.' '.$value['date'];?></div></div><?php endforeach; ?>
<?php echo $pageurl;?>
</div></div>