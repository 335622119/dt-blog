<?php 
/**
 * 微语部分
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="container">
<div class="breadcrumb">
<i class="icon-home"></i><a title="<?php echo $blogname;?>" href="<?php echo BLOG_URL; ?>">首页</a>
»   微语
</div>
<main class="main" role="main">
<div class="entry-content">
<ul class="twiter">
 <?php
            foreach($tws as $val):
            //dump($val);
            $author = $user_cache[$val['author']]['name'];
            $avatar = empty($user_cache[$val['author']]['avatar']) ? 
                        BLOG_URL . 'admin/views/images/avatar.jpg' : 
                        BLOG_URL . $user_cache[$val['author']]['avatar'];
            if(empty($user_cache[$val['author']]['avatar'])) {
               $avatar = empty($user_cache[$val['author']]['mail'])?TEMPLATE_URL.'static/images/default_user.png':J_getGravatar($user_cache[$val['author']]['mail']);
            }else {
               $avatar =  BLOG_URL . $user_cache[$val['author']]['avatar'];
            }
            $tid = (int)$val['id'];
            $img = empty($val['img']) ? "" : '<a title="查看图片" href="'.BLOG_URL.str_replace('thum-', '', $val['img']).'" target="_blank"><img src="'.BLOG_URL.$val['img'].'" alt="微语配图"/></a>';
            ?> 
<li class="twiter_list">
<section class="comments">
<article class="comment">
<a class="comment-img" href="#non">
<img src="<?php echo $avatar; ?>" alt="<?php echo $author; ?>" width="50" height="50">
</a>
<div class="comment-body">
<div class="text">
<p><?php echo $val['t'].'<br/>'.$img;?></p>
<p class="twiter_info">
<span class="twiter_author"><?php echo $author; ?></span>
<time class="twiter_time">
<i class="icon-time"></i>
<?php echo $val['date'];?>
</time>
</p>
</div>
</div>
</article>
    <?php endforeach;?>
	<div class="pagenavi"><?php echo sheli_fy($twnum,Option::get('index_twnum'),$page,BLOG_URL.'t/?page=');?></div>
</main>
<?php
 include View::getView('side');
?>
</div>
</div>
<?php
 include View::getView('footer');
?>