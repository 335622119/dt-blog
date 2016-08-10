<?php session_start();?>

<?php
$pass=$_POST['aaa'];
$mm='xdans';
if(isset($pass)){
if ($pass != $mm) {
	echo '亲VIP代码错误哦！';
	return false;
	die();
}else{
	$_SESSION['s']='xdans';
}
}
?>


<?php if($_SESSION['s'] == $mm){

echo "

<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<title>不要发给其他人哦</title>
</head>
<body bgcolor='#000000'>
<font color='#FF0000' style='font-size:24px'>片源来自国外,速度不是很快.可以翻墙观看更佳.</font>
<object classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' codebase='http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0' width='100%' height='650'>
  <param name='movie' value='http://www.j8mao.com/cmp.swf?url=config.xml&amp;lists=avdp.xml,17.xml,a823a.xml,a823b.xml&amp;.swf' />
  <param name='quality' value='high' />
  <embed src='http://www.j8mao.com/cmp.swf?url=config.xml&amp;lists=avdp.xml,17.xml,a823a.xml,a823b.xml&amp;.swf' quality='high' pluginspage='http://www.macromedia.com/go/getflashplayer' type='application/x-shockwave-flash' width='100%' height='650'></embed>
</object>
</body>
</html>";
}else{
	echo "
	<body style='background:#000;color:#FFFFFF;font-size:12px;text-align:center;'><form action='s.php'method='post'>神秘通道密码<br><br><input type='text'name='aaa'><br><input type='submit'value='插插插'/></form><br><p>联系站长马上获取神秘通道密码！！</p></body>
	
	";
}



 ?>