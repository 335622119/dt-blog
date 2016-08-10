<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title><?php echo ($seo["title"]); ?></title>
        <meta name="keywords" content="<?php echo ($seo["keywords"]); ?>">
        <meta name="description" content="<?php echo ($seo["description"]); ?>">
		<link rel="stylesheet" type="text/css" href="__PUBLIC__/Skins/basic.css?v=<?php echo (VERSION); ?>" />
		<link href="__PUBLIC__/Assets/css/font.css?v=<?php echo (VERSION); ?>" rel="stylesheet" type="text/css" />
		<link href="__PUBLIC__/Assets/css/font-ie7.css?v=<?php echo (VERSION); ?>" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="__PUBLIC__/Skins/<?php echo C('DEFAULT_THEME');?>/css.css?v=<?php echo (VERSION); ?>" />
		<link href="__PUBLIC__/Skins/favicon.ico" rel="shortcut icon">
        <script type="text/javascript" src="__PUBLIC__/Skins/jquery.min.js?v=<?php echo (VERSION); ?>"></script>
        <script type="text/ecmascript" src="__PUBLIC__/Skins/common.js?v=<?php echo (VERSION); ?>"></script>
		<style>
			.wrap{width:<?php echo $config['width'] ?>px;min-width:<?php echo $config['width'] ?>px;}
			<?php if(empty($config["category_show_description"])): ?>.time-list li{height:32px;}<?php endif; ?>
		</style>
    </head>
    <body data-spy="scroll" data-target="#nav-plane" data-offset="140">
        <div id="topbar">
            <div class="wrap">
                <div class="top-info left">
                    <span class="welcome"><?php echo ($config["sub_title"]); ?></span>
                </div>
                <div class="top-link right">
                    <a href="javascript:;" onClick="addFav('http://<?php echo ($_SERVER["HTTP_HOST"]); ?>','<?php echo ($config["title"]); ?>')"><i class="icon-folderopen"></i>按Ctrl+D收藏</a>
                </div>
            </div>
        </div><!--#topbar-->
        
        <div id="topmain">
            <div class="wrap">
                <div class="logo left">
                	<a href="<?php echo U('/');?>"><img src="<?php if(empty($config["logo"])): ?>__PUBLIC__/Skins/logo.png<?php else: ?>__PUBLIC__/Uploads<?php echo ($config["logo"]); endif; ?>" alt="<?php echo ($config["title"]); ?>" /></a>
                </div>
                <div class="search">
	<form id="search" action="http://<?php echo ($_SERVER['HTTP_HOST']); echo C('ROOT_FILE');?>" target="_self">
		<div class="opt" id="search-opt">
			<a href="javascript:;"><img id="search-img" src="__PUBLIC__/Assets/img/favicon.ico"></a>
			<div class="list">
				<a href="http://<?php echo ($_SERVER['HTTP_HOST']); echo C('ROOT_FILE');?>" data-kw="kw"><img src="__PUBLIC__/Assets/img/favicon.ico"><span>站内</span></a>
				<a href="https://www.baidu.com/baidu" data-kw="word"><img src="__PUBLIC__/Skins/baidu.gif"><span>百度</span></a>
				<a href="http://www.haosou.com/s" data-kw="q"><img src="__PUBLIC__/Skins/360.png"><span>好搜</span></a>
				<a href="https://gg.wen.lu/search" data-kw="q"><img src="__PUBLIC__/Skins/google.png"><span>谷歌</span></a>
				<a href="https://s.taobao.com/search?" data-kw="q"><img src="https://www.taobao.com/favicon.ico"><span>淘宝</span></a>
			</div>
		</div>
		<input type="text" id="search-kw" class="search-input" name="kw" placeholder="<?php echo lang('search');?>" autocomplete="off" value="<?php echo ($_GET['kw']); ?>">
		<input name="ie" type="hidden" value="utf-8">
		<input name="a" type="hidden" value="search">
		<input type="submit" class="search-button" value="">
	</form>
</div> 
            </div>
        </div><!--#topmain-->
      
        <div id="topnav">
            <div class="wrap">
                <div class="nav">
                    <ul>
                        <li <?php if(str_replace('/','',ACTION_NAME) == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo U('/');?>" id="home" ><?php echo lang('index');?></a>
                        <?php if(is_array($navigation)): $i = 0; $__LIST__ = $navigation;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li <?php if($actionName == $nav['alias']): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/'.$nav['alias']);?>"><?php echo ($nav["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>	
					</ul>
                </div>
            </div>
        </div><!--#topnav--> 

<div id="container" class="wrap">
    
	<?php if(!empty($config["slideshow"])): ?><div class="benner mtop" id="banner">
	<ul>
		<?php $slideshow = M('Advert')->where('status=1')->order('sort_order desc')->select(); ?>
		<?php if(is_array($slideshow)): $i = 0; $__LIST__ = $slideshow;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["link"]); ?>" target="<?php echo ($vo["target"]); ?>"><img src="__PUBLIC__/Uploads<?php echo ($vo["image"]); ?>"><div class="banner_content"><?php echo ($vo["description"]); ?></div></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div>
<script type="text/javascript" src="__PUBLIC__/Skins/unslider.min.js"></script>
<script type="text/javascript">
$(function() { $('#banner').unslider({fluid: true,dots: true});});
</script><?php endif; ?> 
    <?php if(!empty($config["item_hot_show"])): ?><div class="section mtop">
	<h2 class="title"><i class="icon-map"></i><?php echo lang('latest_recommend');?></h2>
	<div class="content">
		<ul class="gallery-list clearfix">
			<?php $hot = D('Item')->hotList(); ?>
			<?php if(is_array($hot)): $i = 0; $__LIST__ = $hot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
				<div class="img" style="width:<?php echo ($config["recommend_img_width"]); ?>px"><a href="<?php echo ($vo["url"]); ?>" target="_blank" rel="nofollow"><img src="__PUBLIC__/Uploads<?php echo ($vo["logo"]); ?>" width="100%" alt="<?php echo ($vo["title"]); ?>" /></a></div>
				<div class="description"><h2><?php echo ($vo["title"]); ?></h2><p><?php echo ($vo["description"]); ?></p></div>
			</li><?php endforeach; endif; else: echo "" ;endif; ?>
		</ul>
	</div>
</div><!--.section--><?php endif; ?> 
    
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="section mtop" id="<?php echo ($vo["alias"]); ?>">
        <h2 class="title">
            <i class="icon-<?php echo ($vo["icon"]); ?>"></i><?php echo ($vo["name"]); ?>
            <span class="sub-category">
                <?php if(!empty($vo["category"])): ?><a href="<?php echo U('Index/'.$vo['alias']);?>" class="current"><?php echo lang('all');?></a><?php endif; ?>
                <?php if(is_array($vo["category"])): $i = 0; $__LIST__ = $vo["category"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cat): $mod = ($i % 2 );++$i;?>| <a href="<?php echo U('Index/'.$cat['alias']);?>"><?php echo ($cat["name"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
            </span>
            <a href="<?php echo U('Index/'.$vo['alias']);?>" class="more"><?php echo lang('more');?>&gt;&gt;</a>
        </h2>
        <div class="content">
            <ul class="time-list clearfix">
            	<?php if(is_array($vo["list"])): $i = 0; $__LIST__ = $vo["list"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$li): $mod = ($i % 2 );++$i;?><li>
					<a href="<?php echo ($li["url"]); ?>" target="_blank" rel="nofollow"><?php echo ($li["title"]); ?> <?php if(($li["is_hot"]) == "1"): ?><img src="__PUBLIC__/Skins/hot.gif" /><?php endif; ?></a>
					<p><?php echo ($li["description"]); ?></p>
				</li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div><!--.section--><?php endforeach; endif; else: echo "" ;endif; ?>
    
</div><!--#container-->

<script type="text/javascript">
$(function(){
	$('.gallery-list .img').hover(function(){
		var height = $(this).outerHeight()+10;
		$(this).parent().addClass('active');
		$(this).next('.description').css('padding-top',height).stop(true,true).fadeIn();
	},function(){ $(this).next('.description').stop(true,true).fadeOut('fast',function(){ $(this).parent().removeClass('active');});});	
	$('.gallery-list a').click(function(){
		var href = $(this).attr('href');
		countClick(href);
	})
})
</script>
<?php if(!empty($config["sidenav"])): ?><div id="nav-plane">
	<ul>
		<?php $sideNav = 'Index'==ACTION_NAME?$navigation:$list; ?>
		<?php if(is_array($sideNav)): $i = 0; $__LIST__ = $sideNav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><li><a href="#<?php echo ($nav["alias"]); ?>"><?php echo ($nav["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
	</ul>
</div><?php endif; ?>

<div id="shortcut-box">
	<a class="qrcode" href="javascript:;"><i><img src="__PUBLIC__/<?php if(empty($config["qrcode"])): ?>Skins/qr.png<?php else: ?>Uploads<?php echo ($config["qrcode"]); endif; ?>" /></i></a>
	<a class="feedback" href="javascript:;"><span>留言反馈</span></a>
	<a class="gotop" id="scrollUp" href="#"><span>返回顶部</span></a>
</div>
<script type="text/javascript" src="__PUBLIC__/Skins/layer/layer.js"></script>
<script>
$('.feedback').on('click', function(){
    layer.open({  type: 2, area: ['500px', '300px'], shadeClose: true,title:'留言反馈', content: "http://<?php echo ($_SERVER['HTTP_HOST']); echo C('ROOT_FILE');?>?a=message" });
});
</script>

        <div id="footer">
        	<div class="wrap">
                <div class="footer-top">
                    <ul class="left">
                    	<?php if(is_array($link)): $i = 0; $__LIST__ = $link;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo ($vo["link"]); ?>" target="_blank"><?php echo ($vo["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
					<div class="right"><a href="#"><img src="__PUBLIC__/Skins/gobackimg.jpg"></a></div>
                </div>
                <div class="footer-bottom">
                	<dl class="clearfix">
                    	<dt><a href="<?php echo U('/');?>"><img src="<?php if(empty($config["logo"])): ?>__PUBLIC__/Skins/logo.png<?php else: ?>__PUBLIC__/Uploads<?php echo ($config["logo"]); endif; ?>" alt="<?php echo ($config["title"]); ?>" /></a></dt>
                        <dd>
                        	<div class="copyright">
								<?php echo ($config["footer"]); ?>
							</div>
							<!--
                            <div class="linklist">
                            	<ul>
                                	<li><a href="#">关于我们</a></li>
                                    <li><a href="#">联系我们</a></li>
                                    <li><a href="#">友情链接</a></li>
                                </ul>
                            </div>
							-->
                        </dd>
                    </dl>
                </div>
            </div>
        </div><!--#footer-->
<script>
function countClick(url){
	$.post("http://<?php echo ($_SERVER['HTTP_HOST']); echo C('ROOT_FILE');?>?a=click",{url:url});
}
</script> 
    </body>
</html>