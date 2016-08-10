<?php
/*
Plugin Name: 图片加水印
Version: 2.1
Plugin URL: http://kller.cn/?post=79
Description: 当你上传图片的时候，可以按照您的设定给图片添加文字或者是图片类型的水印。
Author: KLLER
Author Email: kller@foxmail.com
Author URL: http://kller.cn
*/
!defined('EMLOG_ROOT') && exit('access deined!');

function gvgu_image_watermark()//写入插件导航
{
	echo '<div class="sidebarsubmenu" id="gvgu_image_watermark"><a href="./plugin.php?plugin=gvgu_image_watermark">图片加水印</a></div>';
}
addAction('adm_sidebar_ext', 'gvgu_image_watermark');

function gvgu_image_watermark_do($tmpFile)
{
	$tmpFile_info = getimagesize($tmpFile);
	if($tmpFile_info[2]>0 and  $tmpFile_info[2]<4){
		include(EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/db.php');
		imageWaterMark($tmpFile,$waterPos,$waterImage,$waterText,$textFont,$textColor,$watermarkType);
	}
}
include_once(EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/db.php');
switch($watermarkPlace){
	case 'log':
		addAction('attach_upload', 'gvgu_image_watermark_do');
		break;
	case 'kl_album':
		addAction('kl_album_upload', 'gvgu_image_watermark_do');
		break;
	case 'log&kl_album':
		addAction('attach_upload', 'gvgu_image_watermark_do');
		addAction('kl_album_upload', 'gvgu_image_watermark_do');
		break;
	default:
		break;
}

/*
* 函数功能：实现给图片添加水印，可在设置文件里设置各种参数。
* 作    者：LaiFangwen
* 邮    箱：LaiFangwen@gmail.com
*/
function imageWaterMark($groundImage,$waterPos=9,$waterImage="",$waterText="",$textFont=12,$textColor="#FF0000",$watermarkType="")
{
	if($watermarkType == 'text')
	{
		$isWaterImage = FALSE;
	}elseif($watermarkType == 'image'){
		$isWaterImage = TRUE;
	}else{
		return;
	}
	if($isWaterImage === TRUE){
		//读取水印文件
		if(!empty($waterImage) && file_exists($waterImage))
		{
			$water_info = getimagesize($waterImage);
			$water_w = $water_info[0];//取得水印图片的宽
			$water_h = $water_info[1];//取得水印图片的高
			switch($water_info[2])//取得水印图片的格式
			{
				case 1:$water_im = imagecreatefromgif($waterImage);break;
				case 2:$water_im = imagecreatefromjpeg($waterImage);break;
				case 3:$water_im = imagecreatefrompng($waterImage);break;
				default:return;
			}
		}
	}

	//读取背景图片
	if(!empty($groundImage) && file_exists($groundImage))
	{
		$ground_info = getimagesize($groundImage);
		$ground_w = $ground_info[0];//取得背景图片的宽
		$ground_h = $ground_info[1];//取得背景图片的高
		switch($ground_info[2])//取得背景图片的格式
		{
			case 1:$ground_im = imagecreatefromgif($groundImage);break;
			case 2:$ground_im = imagecreatefromjpeg($groundImage);break;
			case 3:$ground_im = imagecreatefrompng($groundImage);break;
			default:return;
		}
	}else{
		return;
	}
	//水印位置
	if($isWaterImage === TRUE)//图片水印
	{
		$w = $water_w;
		$h = $water_h;
	}else{//文字水印
		$temp = imagettfbbox($textFont,0,EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/simfang.ttf',$waterText);//取得使用 TrueType 字体的文本的范围
		$w = $temp[2] - $temp[6];
		$h = $temp[3] - $temp[7];
		unset($temp);
	}
	if( ($ground_w<$w) || ($ground_h<$h) )
	{
		return;
	}
	switch($waterPos)
	{
		case 0://随机
		$posX = rand(0,($ground_w - $w));
		$posY = rand(0,($ground_h - $h));
		break;
		case 1://1为顶端居左
		$posX = $isWaterImage ? 0 : 3;
		$posY = $isWaterImage ? 0 : $h - 3;
		break;
		case 2://2为顶端居中
		$posX = ($ground_w - $w) / 2;
		$posY = $isWaterImage ? 0 : $h - 3;
		break;
		case 3://3为顶端居右
		$posX = $isWaterImage ? $ground_w - $w : $ground_w - $w - 3;
		$posY = $isWaterImage ? 0 : $h - 3;
		break;
		case 4://4为中部居左
		$posX = $isWaterImage ? 0 : 3;
		$posY = ($ground_h - $h) / 2;
		break;
		case 5://5为中部居中
		$posX = ($ground_w - $w) / 2;
		$posY = ($ground_h - $h) / 2;
		break;
		case 6://6为中部居右
		$posX = $isWaterImage ? $ground_w - $w : $ground_w - $w - 3;
		$posY = ($ground_h - $h) / 2;
		break;
		case 7://7为底端居左
		$posX = $isWaterImage ? 0 : 3;
		$posY = $isWaterImage ? $ground_h - $h : $ground_h - 3;
		break;
		case 8://8为底端居中
		$posX = ($ground_w - $w) / 2;
		$posY = $isWaterImage ? $ground_h - $h : $ground_h - 3;
		break;
		case 9://9为底端居右
		$posX = $isWaterImage ? $ground_w - $w : $ground_w - $w - 3;
		$posY = $isWaterImage ? $ground_h - $h : $ground_h - 3;
		break;
		default://随机
		$posX = rand(0,($ground_w - $w));
		$posY = rand(0,($ground_h - $h));
		break;
	}
	//设定图像的混色模式
	imagealphablending($ground_im, true);
	if($isWaterImage === TRUE)//图片水印
	{
		imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $water_w,$water_h);//拷贝水印到目标文件
	}else{//文字水印
		if(!empty($textColor) && strlen($textColor)==7)
		{
			$R = hexdec(substr($textColor,1,2));
			$G = hexdec(substr($textColor,3,2));
			$B = hexdec(substr($textColor,5));
		}else{
			return;
		}
		imagettftext($ground_im,$textFont,0,$posX,$posY,imagecolorallocate($ground_im, $R, $G, $B),EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/simfang.ttf',$waterText);
	}
	//生成水印后的图片
	@unlink($groundImage);
	switch($ground_info[2])//取得背景图片的格式
	{
		case 1:imagegif($ground_im,$groundImage);break;
		case 2:imagejpeg($ground_im,$groundImage);break;
		case 3:imagepng($ground_im,$groundImage);break;
		default:return;
	}
	//释放内存
	if(isset($water_info)) unset($water_info);
	if(isset($water_im)) imagedestroy($water_im);
	unset($ground_info);
	imagedestroy($ground_im);
}
?>