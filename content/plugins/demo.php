<?php
/**
 * 文件演示页面
 * @copyright (c) Emlog All Rights Reserved
 */

require_once 'init.php';
$id=addslashes($_GET['id']);
$options_cache = $CACHE->readCache('options');
$db = MySql::getInstance();
$data = $db->query("SELECT * FROM ".DB_PREFIX."cpdown WHERE logid ='$id'");
$row = $db->fetch_array($data);
$title = htmlspecialchars($row['name']);
if(empty($id)){
	emDirect(BLOG_URL);
}elseif(empty($row['yanshi'])){
	emDirect(BLOG_URL);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?>_<?php echo $options_cache['blogname']; ?></title>
<style>
body{margin: 0;padding: 0;font-family: 'microsoft yahei';font-size: 14px;overflow: hidden;}
#demobar{background-color: #444;color: #eee;height: 32px;line-height: 32px;position: relative;z-index: 9}
#demologo{float: left;padding: 0 20px;position: relative;}
#demoaction{float: right;}
#demoaction a{display: inline-block;padding: 0 30px;color: #fff;background-color: #61B3E6;text-decoration: none;}
#demoaction a:hover{background-color: #3DA3E2;}
#demoframe{position: absolute;top: 32px;bottom: 0;left: 0;right: 0;}
#demoframe iframe{border: 0;width: 100%;height: 100%;margin: 0;position: absolute;top: 0;bottom: 0;left: 0;right: 0;}
</style>
</head>
<body>
<h1 style="display:none"><?php echo $title; ?>_<?php echo $options_cache['blogname']; ?></h1>
<div id="demobar">
<div id="demologo"><?php echo $title; ?>官方演示</div>
    <div id="demoaction">
        <a target="_blank" href="<?php echo BLOG_URL; ?>download.php?id=<?php echo $id; ?>">点击下载</a>
    </div>
</div>
<div id="demoframe">
    <iframe src="<?php echo $row['yanshi']; ?>" frameborder="0"></iframe>
</div>
<div style="display:none"></div>
</body>
</html>