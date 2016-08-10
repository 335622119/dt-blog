<?php
/*
 * eMedia模板配置文件
/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
	'logotype' => array(
		'type' => 'radio',
		'name' => '设置LOGO类型',
		'values' => array(
			'image' => '图片',
			'text' => '文字'
		),
		'default' => 'image',
		'description' => '设置类型为文字时显示站点标题&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://www.idaoker.com/" target="_blank">联系模板作者</a>',
	),
	'logopic' => array(
        'type' => 'image',
        'name' => '上传LOGO图片',
        'values' => array(
            TEMPLATE_URL . 'images/emedialogo.png',
        ),
		'description' => '默认尺寸为280X60像素透明PNG图片',
    ),
	'ctqq' => array(
		'type' => 'text',
		'name' => '联系QQ号',
		'default' => '812834272',
	),
	
	'inewti' => array(
		'type' => 'text',
		'name' => '首页列表标题',
		'default' => '精品内容推荐',
	),
	'inewdes' => array(
		'type' => 'text',
		'name' => '首页列表描述',
		'default' => '专注行业与圈内动态，分享最具价值内容',
	),
	'weibourl' => array(
		'type' => 'text',
		'name' => '新浪微博地址',
		'default' => 'http://www.weibo.com/ewceo',
	),
	'qqturl' => array(
		'type' => 'text',
		'name' => '腾讯微博地址',
		'default' => 'http://t.qq.com/mxyctc',
	),
	'flinkp' => array(
		'type' => 'text',
		'name' => '友链申请说明地址',
		'default' => 'http://www.idaoker.com/?post=6',
	),
	'trad' => array(
		'type' => 'text',
		'name' => '右边栏上广告',
		'multi' => true,
		'default' => '<a href="http://www.ewceo.com/" target="_blank"><img src="../content/templates/emedia/images/emad320.png" width="320" /></a>',
		'description' => '建议广告尺寸为320X120像素，更多右侧广告可新建侧边栏自定义组件',
	),
	'bvad' => array(
		'type' => 'text',
		'name' => '底部通栏广告',
		'multi' => true,
		'default' => '<a href="http://www.ewceo.com/" target="_blank"><img src="../content/templates/emedia/images/emad950.gif" width="1000" /></a>',
		'description' => '建议广告尺寸为1000X100像素',
	),
	'logad' => array(
		'type' => 'text',
		'name' => '文章内容下广告',
		'multi' => true,
		'default' => '<a href="http://www.ewceo.com/" target="_blank"><img src="../content/templates/emedia/images/emad728.gif" width="650" /></a>',
		'description' => '建议广告尺寸为650X高100像素',
	),
	'footlink' => array(
		'type' => 'text',
		'name' => '页脚链接',
		'multi' => true,
		'default' => ' ',
	),
	'qrcode' => array(
        'type' => 'image',
        'name' => '二维码图片',
        'values' => array(
            TEMPLATE_URL . 'images/ewqrcode.png',
        ),
		'description' => '<a href="http://www.baidu.com/s?wd=%B6%FE%CE%AC%C2%EB%C9%FA%B3%C9" target="_blank">二维码图生成？</a>',
    ),
	'qrtext' => array(
		'type' => 'text',
		'name' => '二维码说明文字',
		'default' => '欢迎使用手机扫描访问本站，还可以关注微信哦~',
	),
);