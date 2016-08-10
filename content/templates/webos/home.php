<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $site_title; ?></title>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>jsLib/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL; ?>jsLib/myLib.js"></script>
<script type="text/javascript">
$(function(){
		   myLib.progressBar();
		   });
$.include(['<?php echo TEMPLATE_URL; ?>themes/default/css/desktop.css', '<?php echo TEMPLATE_URL; ?>jsLib/jquery-ui-1.8.18.custom.css', '<?php echo TEMPLATE_URL; ?>jsLib/jquery-smartMenu/css/smartMenu.css' , '<?php echo TEMPLATE_URL; ?>jsLib/jquery-ui-1.8.18.custom.min.js', '<?php echo TEMPLATE_URL; ?>jsLib/jquery.winResize.js', '<?php echo TEMPLATE_URL; ?>jsLib/jquery-smartMenu/js/mini/jquery-smartMenu-min.js', '<?php echo TEMPLATE_URL; ?>jsLib/desktop.js']);
$(window).load(function(){
		   myLib.stopProgress();
		   
		   //这里本应从数据库读取json数据，这里直接将数据写在页面上
		   var lrBarIconData={
			   'app0':{
					   'title':'我的博客',
					   'url':'?sort',
					   'winWidth':1100,
					   'winHeight':650
					   },
				'app1':{
					   'title':'微语',
					   'url':'t/',
					   'winWidth':800,
					   'winHeight':650
					   },
					   };
		//这里本应从数据库读取json数据，这里直接将数据写在页面上			   
		  var deskIconData={
					  <?php
  	for($i=1;$i<11;$i++){
  		if(_g('ico'.$i.'_title')=="一个emlog新模板"){

  			}else{ 
?>
				'ico_<?php echo $i;?>':{
					   'title':'<?php echo _g('ico'.$i.'_title');?>',
					   'url':'<?php echo _g('ico'.$i.'_url');?>',
					   'winWidth':550,
					   'winHeight':480
						},
 <?php }}?>


			  };			   
 		   
		  //存储桌面布局元素的jquery对象
		   myLib.desktop.desktopPanel();
 		   
		   //初始化桌面背景
		   myLib.desktop.wallpaper.init("<?php echo TEMPLATE_URL; ?>themes/default/images/blue_glow.jpg");
		   
		   //初始化任务栏
		   myLib.desktop.taskBar.init();
		   
		   //初始化桌面图标
		   myLib.desktop.deskIcon.init(deskIconData);
		   
		   //初始化桌面导航栏
		   myLib.desktop.navBar.init();
		   
		   //初始化侧边栏
		   myLib.desktop.lrBar.init(lrBarIconData);
		   
		   //欢迎窗口
		   myLib.desktop.win.newWin({
													 WindowTitle:'我的博客',
													 iframSrc:"?sort",
													 WindowsId:"welcome",
													 WindowAnimation:'none', 
													 WindowWidth:800,
													 WindowHeight:650
 													 });
  		  
		  });		

//添加应用函数
function addIcon(data){
	 myLib.desktop.deskIcon.addIcon(data);
	}




</script>
</head>
<body>
<a href="#" class="powered_by">来自 段彤‘ s Blog</a>

<div id="wallpapers"></div>
<div id="navBar"><a href="#" class="currTab" title="桌面1"></a><a href="#"  title="桌面2"></a></div>
<div id="desktopPanel">
<div id="desktopInnerPanel">
<ul class="deskIcon currDesktop">
  
  <?php
  	for($i=1;$i<11;$i++){
  		if(_g('ico'.$i.'_title')=="一个emlog新模板"){

  			}else{ ?>
<li class="desktop_icon" id="<?php echo "ico_".$i; ?>"> <span class="icon"><img src="<?php echo _g('ico'.$i.'_image'); ?>"/></span>
<div class="text"><?php echo _g('ico'.$i.'_title'); ?><s></s></div> </li>
  <?php	}}

  ?>
</ul>

</div>
</div>

<div id="taskBarWrap">
<div id="taskBar">
  <div id="leftBtn"><a href="#" class="upBtn"></a></div>
  <div id="rightBtn"><a href="#" class="downBtn"></a> </div>
  <div id="task_lb_wrap"><div id="task_lb"></div></div>
</div>
</div>

<div id="lr_bar">
  <ul id="default_app">
   <li id="app0"><span><img src="<?php echo TEMPLATE_URL; ?>icon/icon1.png" title="我的博客"/></span><div class="text">我的博客<s></s></div></li>
   <li id="app1"><span><img src="<?php echo TEMPLATE_URL; ?>icon/icon2.png" title="微语"/></span><div class="text">微语<s></s></div></li>
  </ul>
  <div id="default_tools"> <span id="showZm_btn" title="全屏"></span>
  <div id="start_block">
<a title="开始" id="start_btn"></a>
<div id="start_item">
   
<?php fenlei_navi();?><?php blog_navi();?>
    </div>
</div>
</div>
</div>
呵呵呵呵
</body>
</html>


























<?php mysql_close();?>