<?php
$waterPos =9; //水印位置，有10种状态，0为随机位置；
// 1为顶端居左，2为顶端居中，3为顶端居右；
// 4为中部居左，5为中部居中，6为中部居右；
// 7为底端居左，8为底端居中，9为底端居右；
$waterImage=EMLOG_ROOT.'/content/plugins/gvgu_image_watermark/gvgu_watermark.gif'; //图片水印，即作为水印的图片，暂只支持GIF,JPG,PNG格式；
$waterText="";//文字水印，即把文字作为为水印；
$textFont =22;//文字大小；
$textColor="#FF0000";//文字颜色，值为十六进制颜色值，默认为#FF0000(红色)；
$watermarkType="image";
$watermarkPlace="log";
?>