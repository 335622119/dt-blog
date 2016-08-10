<?php
/*@support tpl_options*/
!defined('EMLOG_ROOT') && exit('access deined!');
$options = array(
	    'focus_img' => array(
	    'type' => 'radio',
		'name' => '首页幻灯片',
		'values' => array(
			'yes' => '显示',
			'no' => '隐藏',
		),
		'default' => 'yes',
	),
			    'index_title' => array(
'type' => 'text',
		'name' => '置顶标题',
		'description' => '填写标题',
		'default' => 'start更新，new！',
        ),
				    'index_top1' => array(
'type' => 'text',
		'name' => '置顶标题链接',
		'description' => '填写链接',
		'default' => 'http://www.isiyuan.net',
        ),
		    'index_top' => array(
	    'type' => 'radio',
		'name' => '首页置顶推荐',
		'values' => array(
			'yes' => '显示',
			'no' => '隐藏',
		),
		'default' => 'yes',
	),
			    'pjax_on' => array(
	    'type' => 'radio',
		'name' => '整站pjax开关，默认开启。',
		'values' => array(
			'yes' => '开启',
			'no' => '关闭',
		),
		'default' => 'yes',
	),
		    's_img' => array(
	    'type' => 'radio',
		'name' => '文章缩略图',
		'values' => array(
			'yes' => '显示',
			'no' => '隐藏',
		),
		'default' => 'yes',
	),
			    'ad' => array(
	    'type' => 'radio',
		'name' => '广告开关',
		'values' => array(
			'yes' => '显示',
			'no' => '隐藏',
		),
		'default' => 'yes',
	),
        	'hda1' => array(
		'type' => 'text',
		'name' => '首页幻灯1地址',
		'description' => '填写链接',
		'default' => 'http://www.isiyuan.net',
        ),
	
		        	'hdt1' => array(
		'type' => 'text',
		'name' => '首页幻灯1标题',
		'description' => '填写标题',
		'default' => '一个emlog新模板',
        ),
        		'hd1' => array(
		'type' => 'image',
		'name' => '幻灯图片',
		'values' => array(
            TEMPLATE_URL . 'style/images/1.jpg',
        ),
	),  
        		'hda2' => array(
		'type' => 'text',
		'name' => '首页幻灯2地址',
		'description' => '填写链接',
		'default' => 'http://www.isiyuan.net',
        ),
				        	'hdt2' => array(
		'type' => 'text',
		'name' => '首页幻灯2标题',
		'description' => '填写标题',
		'default' => '一个emlog新模板',
        ),
        	'hd2' => array(
		'type' => 'image',
		'name' => '幻灯图片',
		'values' => array(
            TEMPLATE_URL . 'style/images/2.jpg',
        ),
	),  
        		'hda3' => array(
		'type' => 'text',
		'name' => '首页幻灯3地址',
		'description' => '填写链接',
		'default' => 'http://www.isiyuan.net',
        ),
		        	'hdt3' => array(
		'type' => 'text',
		'name' => '首页幻灯3标题',
		'description' => '填写标题',
		'default' => '一个emlog新模板',
        ),        	
			'hd3' => array(
		'type' => 'image',
		'name' => '幻灯图片',
		'values' => array(
            TEMPLATE_URL . 'style/images/2.jpg',
        ),
	),  
 		
							'logo' => array(
		'type' => 'image',
		'name' => 'logo',
		'values' => array(
            TEMPLATE_URL . 'style/images/logo.png',
        ),
	), 
	'echoad1' => array(
		'type' => 'text',
		'name' => '自定义内容页上AD',
		'multi' => 'true',
  'rich'=>true,
		'values' => array(
			'<a href="http://www.isiyuan.net" title="start主题">
<img width="100%" height="100%" src="http://isiyuan.net/2.gif" alt="start主题">
</a>',
		),
  'description' => 'html需切换到代码模式下输入代码。',
	),
	'echoad2' => array(
		'type' => 'text',
		'name' => '自定义内容页上AD',
		'multi' => 'true',
  'rich'=>true,
		'values' => array(
			'<a href="http://www.isiyuan.net" title="start主题">
<img width="100%" height="100%" src="http://isiyuan.net/2.gif" alt="start主题">
</a>',
		),
  'description' => 'html需切换到代码模式下输入代码。',
	),
);