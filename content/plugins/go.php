<?php
/**
 * 网站外链跳转
 * @copyright (c) Emlog All Rights Reserved
 */

require_once 'init.php';

$db = Database::getInstance();
$title = isset($_GET['go']) ? addslashes(trim($_GET['go'])) : '';
//获取跳转链接
$sql_go = "SELECT * FROM " . DB_PREFIX . "go where title='$title'";
$res = $db->query($sql_go);
$row = $db->fetch_array($res);
if(preg_match("/[\x7f-\xff]/", $title) || empty($title) || empty($row['title'])){
	emDirect(BLOG_URL);
}else{
	//访问+1
	$db->query("UPDATE " . DB_PREFIX . "go SET views=views+1 where title='$title'");
	//最终跳转
	emDirect(htmlspecialchars($row['siteurl']));
}