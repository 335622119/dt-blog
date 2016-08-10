<?php

/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('junyu2015 deined!');
$options = array(
		//主题公告
		'myhk' => array(
		'type' => 'text',
		'name' => '主题公告',
		'default' => 'Colorful-Pjax明月浩空定制模板，有问题请联系QQ6354321[不可修改]',
		),
		'pjax' => array(
		'type' => 'radio',
		'name' => '全站Pjax无刷新',
		'description' => '关闭Pjax可有效解决部分JS冲突',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
		),
		'logo' => array(
        'type' => 'image',
        'name' => '导航圆形头像',
        'values' => array(
            TEMPLATE_URL . 'images/icon.png',
        ),
		'description' => '站点左侧头像，建议png格式，大小正方形。不能上传请手动ftp',
	),
	'logo1' => array(
        'type' => 'image',
        'name' => '响应式头像',
        'values' => array(
            TEMPLATE_URL . 'images/logo.png',
        ),
		'description' => '站点响应式顶部头像，建议png格式，大小长方形。不能上传请手动ftp',
	),
	'weixin' => array(
	    'type' => 'image',
        'name' => '微信二维码',
        'values' => array(
            TEMPLATE_URL . 'images/weixin.png',
        ),
		'description' => '站点导航右侧微信二维码图片',
	),
	'weiboid' => array(
	    'type' => 'text',
		'name' => '新浪微博ID',
		'description' => '新浪微博昵称',
		'default' => 'Dev-明月浩空',
	),
    'weibodz' => array(
	    'type' => 'text',
		'name' => '新浪微博地址',
		'description' => '新浪微博访问地址',
		'default' => 'http://weibo.com/u/3496187780',
	),
	'qqhao' => array(
	    'type' => 'text',
		'name' => '站长qq',
		'default' => '6354321',
	),
	'admine' => array(
	    'type' => 'text',
		'name' => '站长Email',
		'description' => '跟个人设置里管理员邮箱一致，用于评论识别博主身份',
		'default' => 'admin@limh.me',
	),
	'webtime' => array(
		'type' => 'text',
		'name' => '建站日期',
		'description' => '格式：xxxx-xx-xx',
		'default' => '2015-04-30',
	),
	'dis_num' => array(
		'type' => 'text',
		'name' => '首页自动摘要字符数',
		'description' => '请根据需要输入整数以控制首页摘要的字符数量',
		'default' => '180',
	),
	'index_hdp' => array(
		'type' => 'radio',
		'name' => '首页顶部幻灯片',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'index_slide' => array(
		'type' => 'radio',
		'name' => '幻灯片内容',
		'values' => array(
			'1' => '30天最高点击文章',
			'2' => '最新文章',
			'3' => '置顶文章',
			'4' => '自定义',
		),
		'default' => '1',
	),
	'custom1img' =>array(
		'type' => 'image',
		'name' => '自定义1-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom1url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom1url' => array(
		'type' => 'text',
		'name' => '自定义1-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom1name' => array(
		'type' => 'text',
		'name' => '自定义1-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'custom2img' =>array(
		'type' => 'image',
		'name' => '自定义2-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom2url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom2url' => array(
		'type' => 'text',
		'name' => '自定义2-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom2name' => array(
		'type' => 'text',
		'name' => '自定义2-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'custom3img' =>array(
		'type' => 'image',
		'name' => '自定义3-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom3url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom3url' => array(
		'type' => 'text',
		'name' => '自定义3-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom3name' => array(
		'type' => 'text',
		'name' => '自定义3-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'custom4img' =>array(
		'type' => 'image',
		'name' => '自定义4-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom4url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom4url' => array(
		'type' => 'text',
		'name' => '自定义4-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom4name' => array(
		'type' => 'text',
		'name' => '自定义4-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'custom5img' =>array(
		'type' => 'image',
		'name' => '自定义5-幻灯片图片',
		'values' => array(
			TEMPLATE_URL . 'images/banner.jpg',
		),
	),
	'custom5url_blank' => array(
		'type' => 'radio',
		'name' => '新窗口打开',
		'description' => '外链必须开启新窗口打开[否则Pjax无法加载外链]',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'custom5url' => array(
		'type' => 'text',
		'name' => '自定义5-幻灯片链接',
		'values' => array(
			'http://limh.me',
		),
	),
	'custom5name' => array(
		'type' => 'text',
		'name' => '自定义5-幻灯片名称',
		'values' => array(
			'Coloful主题，Pjax全站，响应式，时间轴。',
		),
	),
	'fujia' => array(
		'type' => 'text',
		'name' => '导航附加功能',
		'multi' => true,
		'description' => '请根据li格式添加导航附加菜单',
		'default' => '<li class="dropdown"> <a class="catbtns" href="javascript:">附加功能<i class="arrow"></i></a>
  <ul class="sub-menu" style="display: none;">
    <li><a href="http://limh.me/t" pjax="微言碎语">微言碎语</a></li>
	<li class="photo"><a href="http://limh.me/?plugin=kl_album" pjax="相册图库">相册图库</a></li>
    <li class="photo"><a href="http://limh.me/links.html" pjax="友情链接">友情链接</a></li>
    <li class="photo"><a href="http://limh.me/guest.html" pjax="吐槽水军">吐槽水军</a></li>
  </ul>
</li>',
	),
	'dhfj' => array(
		'type' => 'radio',
		'name' => '导航附加功能下拉菜单',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	'dhfl' => array(
		'type' => 'radio',
		'name' => '导航分类列表下拉菜单',
		'values' => array(
			'1' => '开启',
			'2' => '关闭',
		),
		'default' => '1',
	),
	
);