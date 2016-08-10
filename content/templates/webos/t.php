<?php 
/**
 * 微语
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="wrap s_clear sjzsy" align="center">
<?php 
    foreach($tws as $val):
    $author = $user_cache[$val['author']]['name'];
    $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                BLOG_URL . 'admin/views/images/avatar.jpg' : 
                BLOG_URL . $user_cache[$val['author']]['avatar'];
    $tid = (int)$val['id'];
    $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img style="border: 1px solid #EFEFEF;" src="'.BLOG_URL.$val['img'].'"/></a>';
    ?>
<div class="yi_blog">
<div class="hentai_title"><p style="margin-left:6px;float:left;color:#999;"><?php echo $author; ?>-于-<?php echo $val['date'];?>说道</p></div>
<div class="hentai">
<div><p><?php echo $val['t'].'<br/>'?></p>
</div>
</div>
</div>
<div style="height:20px"></div>
<?php endforeach;?>
<div class="page_navi container"><?php echo $pageurl;?></div>
</div>


</div>

<?php
 include View::getView('footer');
?>