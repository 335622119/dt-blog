<?php
error_reporting(0);
header("Content-type: text/html;charset=utf-8");
$uri = $_SERVER["QUERY_STRING"];
$url="http://".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
$CS_url=preg_replace("/\/[a-z0-9]+\.php.*/is","",$url);
if(isset($_GET['qq'])){
$qq = $_GET['qq'];
$searchs= "你查询的QQ：<b><font color='#FF0066'>".$qq."</b></font> 空间背景音乐歌曲列表请往下看↓↓ 如有问题请";
$qqurl='http://qzone-music.qq.com/fcg-bin/cgi_playlist_xml.fcg?uin='.$qq.'&TYPE=16&PAGE_START=1&PAGE_END=10000&SELECT_FLAG=1';
$data=file_get_contents($qqurl);
preg_match_all("/<xsinger_name>(.*?)<\/xsinger_name>/is",$data,$singer_name);
preg_match_all("/<xsong_name>(.*?)<\/xsong_name>/is",$data,$song_name);
preg_match_all("/<xsong_url>(.*?)<\/xsong_url>/is",$data,$song_url);
preg_match_all("/<xmusicnum>(.*?)<\/xmusicnum>/is",$data,$song_num);
}elseif($_GET['play']){
if(strstr($_GET['play'],"http://streamrdt.music.qq.com/")){
preg_match("|streamrdt.music.qq.com\/(.+)\/(\d*)/|",$_GET['play'],$code);
$id = $code[1]."/".$code[2];
$qqurl=$CS_url."/?music/".$id.".mp3";
}elseif(strstr($_GET['play'],"qqmusic.qq.com")){
$Type=substr($_GET['play'],-3);
$match = "/http:\/\/stream(\d+)\.qqmusic\.qq\.com\/(\d+)\./";
preg_match($match,$_GET['play'],$res);
list($id, $uk) = array_slice($res, 1, 2);
$mp3id=18000000+$uk;
if($Type!="wma") exit($qqurl=$CS_url."/$id/$uk.mp3");
$qqurl=$CS_url."/?$id/$mp3id.mp3";
}
else
{
$qqurl=$_GET['play'];
}
?>
<html>
<head>
<title>QQ空间背景音乐查询_QQ空间歌曲查询_QQ空间歌曲下载链接_免费上传QQ空间音乐 - XDans最好用的博客网</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="输入QQ号即可查询QQ空间背景音乐，可以将QQ空间歌曲链接地址复制，用在你的QQ空间做背景音乐，查询出来的歌曲也可以下载，欢迎你使用QQ空间歌曲查询。" />
<meta name="keywords" content="QQ空间背景音乐查询,qq空间音乐地址查询,QQ空间歌曲查询 - XDans最好用的博客网" />
</head>
<body>
<p align="center"><embed src="mp3.swf?mp3=<?php echo $qqurl?>&amp;autostart=1" width="600" height="50" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash"></embed></p>
<p align="center">外链地址：<input type="text" onclick="oCopy(this)" style="width:432px;height:27px;border:1px solid #91C848;padding:0px 5px;" id="url" value="<?php echo $qqurl?>"/> <a target="_blank" href="<?php echo $qqurl?>" style="background-color: #475669;border-radius: 3px 3px 3px 3px;-moz-border-radius: 3px 3px 3px 3px;display: inline-block;font-size: 14px;line-height: 17px;margin: 1px;padding: 4px;color:#ffffff;text-decoration: none;">点击下载</a></p>
<script language=javascript>
function oCopy(obj){
if('v'=='\v'){
obj.select();
js=obj.createTextRange();
js.execCommand("Copy")
alert("复制成功!");
	}else{
alert('您使用的是非IE内核浏览器，请按下 CTRL + C 复制！');
obj.select();
}
}
</script>
</body>
</html>
<?php
exit();
}elseif(preg_match("/(.*?)\/(.*?)\.mp3/",$uri,$code)) {
if(!is_numeric($code[1])){
$songurl = "http://streamrdt.music.xiyoo.com/mp3.asp?url=streamrdt.music.qq.com/".$code[2].".html";
}else{
$songurl = "http://stream$code[1].qqmusic.kelongdao.com:8090/$code[2].mp3";
}
//echo $songurl;
header('Content-Type:application/force-download');
header("Location: $songurl");
exit();
}
?>
<html>
<head>
<title>QQ空间背景音乐查询 QQ空间歌曲查询 QQ空间歌曲下载链接 免费上传QQ空间音乐 - XDans最好用的博客网</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="description" content="输入QQ号即可查询QQ空间背景音乐，可以将QQ空间歌曲链接地址复制，用在你的QQ空间做背景音乐，查询出来的歌曲也可以下载，欢迎你使用QQ空间歌曲查询。" />
<meta name="keywords" content="QQ空间背景音乐查询,qq空间音乐地址查询,QQ空间歌曲查询XDans最好用的博客网" />
<style type="text/css">
<!--
body,td,th{font-family: "Microsoft YaHei","宋体";font-size: 12px;letter-spacing:1px;line-height:1.5;color: #000000;margin-left: 0pt;margin-top: 10pt;margin-right: 0pt;margin-bottom: 0pt;}
a {text-decoration: none;}
h1{font-size:14px; display : inline}
.white_content{display: none;position: absolute;width:680px;left:50%;margin-left:-340px;border: 10px solid orange;background-color: white;z-index:1002;overflow-x:hidden;overflow-y:hidden;text-align:center;}
.seh_c {background:#357EBD;color:#FFFFFF;display:inline;text-align:center;font-weight:bold;margin:0 10px;}
-->
</style>
</head>
<body>
<table width="760" border="0" cellspacing="0" cellpadding="0" align="center" height="425" background="bj.gif">
  <tr> 
    <td width="3" background="bjl.gif"></td>
    <td width="754">
      <table width="752" border="0" cellspacing="0" cellpadding="0" align="center" height="420">
        <tr> 
          <td height="30" width="28" align="left"><img src="qq.gif" width="15" height="16"></td>
          <td height="30" width="724"><h1>QQ空间背景音乐查询系统 - XDans最好用的博客网</h1></td>
        </tr>
        <tr> 
          <td height="360" colspan="2">
            <table width="610" border="0" cellspacing="0" cellpadding="0" align="center">			
<tr><td>
<form method="get" name="post" onsubmit="return qqPost();">
请输入要查询的QQ号码：<input type="text" name="qq" id="qq" style="width:180px;" value="<?php echo $qq;?>" onchange="if(/\D/.test(this.value)){alert('请输需要查询的QQ号码...');this.value='';}">
<input type="submit" value="点击查询" />
</form>
</td></tr>


</table>
</td></tr>
<tr></td>
<td height="30" width="716"><font>XDans最好用的博客网-在线QQ空间音乐获取</font></a></td>
</tr>
</table>
    </td>
    <td width="3" background="bjr.gif"></td>
  </tr>
</table>
<?php
function arrContentReplact($array)
{
        if(is_array($array))
        {
                foreach($array as $k => $v)
                {
                $array[$k] = arrContentReplact($array[$k]);
                }
        }else
        {
                $array = str_replace(array('<![CDATA[', ']]>'), array('', ''), $array);
        }
        return $array;
}
$singerarr=arrContentReplact($singer_name[1]);
$songarr=arrContentReplact($song_name[1]);
$urlarr=arrContentReplact($song_url[1]);
echo "<table width=\"650\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\" style=\"padding-top: 20px;\">";
for($i=0;$i<$song_num[1][0];$i++){
	$j++;
$singer = iconv("GB2312","UTF-8//IGNORE",trim($singerarr[$i]));
$song = iconv("GB2312","UTF-8//IGNORE",trim($songarr[$i]));
$qqurl=trim($urlarr[$i]);
echo "<tr><td align=\"left\" height=\"30\" style=\"border-bottom: solid 1px #2FB7F0;\"><img src=\"http://img.t.sinajs.cn/t35/style/images/common/face/ext/normal/d0/music_thumb.gif\" width=\"20\" height=\"20\"> $j 、$singer - $song</td><td align=\"right\" style=\"border-bottom: solid 1px #2FB7F0;\"><input type=\"button\" value=\"试 听\" style=\"width:65px;height:25px;\" onclick=\"javascript:openwindow('?play=$qqurl','音乐试听',630,200);\"></td></tr>";
}
echo "</table>";
?>
<script language=javascript>
function qqPost(){
if(post.qq.value==""){
alert("请输入QQ号!");
post.qq.focus();
return false;
}
}
var dispatch = function() {
        q = document.getElementById("q");
        if (q.value != "" && q.value != "站内搜索") {
            window.open('http://lj.519c.com/?search=' + q.value, "_blank");
            return false;
        } else {
            return false;
        }
}
function openwindow(url,name,iWidth,iHeight)
{
var url; //转向网页的地址;
var name; //网页名称，可为空;
var iWidth; //弹出窗口的宽度;
var iHeight; //弹出窗口的高度;
var iTop = (window.screen.availHeight-30-iHeight)/2; //获得窗口的垂直位置;
var iLeft = (window.screen.availWidth-40-iWidth)/2; //获得窗口的水平位置;
window.open(url,name,'height='+iHeight+',,innerHeight='+iHeight+',width='+iWidth+',innerWidth='+iWidth+',top='+iTop+',left='+iLeft+',toolbar=no,menubar=no,scrollbars=auto,resizeable=no,location=no,status=no');
}
</script>
<div style="display:none">
<div>
</body>
</html>