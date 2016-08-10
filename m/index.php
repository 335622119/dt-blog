<?php
/**
 * 主题名称: Emlog 触屏版 X-Mobile V1.3
 *
 * 主题设计: 笑忘书 (XIAOWS)
 *
 * 主题出处: http://xiaows.com/m
 *
 * 适用版本: emlog 5.3.1(以下未测)
 *
 * @copyright (c) Emlog All Rights Reserved
 */


require_once '../init.php';

define ('TEMPLATE_PATH', EMLOG_ROOT . '/m/view/');

ini_set('date.timezone','Asia/Shanghai'); //设置为上海时区

$isgzipenable = 'n'; //手机浏览关闭gzip压缩
$index_lognum = 10;//每页显示文章数目
$blog_name = Option::get('blogname');//获取博客标题
$site_title = $blog_name;
$site_key = Option::get('site_key');
$site_description = Option::get('site_description');


$logid = isset ($_GET['post']) ? intval ($_GET['post']) : '';
$action = isset($_GET['action']) ? addslashes($_GET['action']) : '';

$sort_id = isset ($_GET['sort']) ? intval ($_GET['sort']) : '';


if (Option::get('ismobile') == 'n') {
	emMsg('本博客未开启手机版访问', BLOG_URL);
}

$navi_cache = $CACHE->readCache('navi');
$user_cache = $CACHE->readCache('user');
$sort_cache = $CACHE->readCache('sort');
$log_cache_tags = $CACHE->readCache('logtags');
// 首页
if (empty ($action) && empty ($logid)) {
	$Log_Model = new Log_Model();
	$page = isset($_GET['page']) ? abs(intval ($_GET['page'])) : 1;
	$sqlSegment = "ORDER BY top DESC ,date DESC";
	$sta_cache = $CACHE->readCache('sta');
	$lognum = $sta_cache['lognum'];
	$pageurl = './?page=';
	$logs = $Log_Model->getLogsForHome ($sqlSegment, $page, $index_lognum);
	$page_url = paginationX($lognum, $index_lognum, $page, $pageurl);

     //按分类显示文章列表
if(!empty ($sort_id)){
	$sqlSegment = "AND sortid = $sort_id ORDER BY date DESC";
	$logs = $Log_Model->getLogsForHome($sqlSegment,$page,$index_lognum);
        $lognum = $sort_cache[$sort_id]['lognum'];
       $page = isset($_GET['page']) ? abs(intval ($_GET['page'])) : 1;
        $sort = $sort_cache[$sort_id];
        $sortName = $sort['sortname'];
        $site_title = $sortName." - ".$site_title;//分类页面标题
        $site_key = $sortName.",".$site_key;//分类页面关键词
        $site_description = $sort['description'];//分类页面描述
        $pageurl = "./?sort=$sort_id&page=";
        $page_url = paginationX($lognum, $index_lognum, $page, $pageurl);
}
	include View::getView('header');
	include View::getView('log');
	include View::getView('footer');
	View::output();
}
function handlearticledes($des) {
	$str = preg_replace("/(<\/?)(\w+)([^>]*>)/e",'',$des);
	$str = preg_replace("/阅读全文&gt;&gt;/",'',$str);
	$str = strip_tags($str,"");
$str = ereg_replace("\t","",$str);
$str = ereg_replace("\r\n","",$str);
$str = ereg_replace("\r","",$str);
$str = ereg_replace("\n","",$str);
$str = ereg_replace(" "," ",$str);
	return mb_substr($str,0,200,'utf8').'...';
}

// 文章
if (!empty ($logid)) {
	$Log_Model = new Log_Model();
	$Comment_Model = new Comment_Model();
        $Sort_Model = new Sort_Model();
	$logData = $Log_Model->getOneLogForHome($logid);
	if ($logData === false) {
		mMsg ('不存在该条目', './');
	}
	extract($logData);

    $site_title = $log_title.' - '.$site_title;//文章标题
    if (!empty($log_cache_tags[$logid])){
	$tags = '';
	foreach ($log_cache_tags[$logid] as $value){
$tags .= $value['tagname'].',';
}

    $site_key = $tags;
}
    $site_description = subString(str_replace("\n","",strip_tags($log_content)), 0,140);
    if (!empty($password)) {
		$postpwd = isset($_POST['logpwd']) ? addslashes(trim ($_POST['logpwd'])) : '';
		$cookiepwd = isset($_COOKIE ['em_logpwd_' . $logid]) ? addslashes(trim($_COOKIE ['em_logpwd_' . $logid])) : '';
		authPassword ($postpwd, $cookiepwd, $password, $logid);
	}
	// comments
	$commentPage = isset($_GET['comment-page']) ? intval($_GET['comment-page']) : 1;
	$verifyCode = ISLOGIN == false && Option::get('comment_code') == 'y' ? "<img src=\"../include/lib/checkcode.php\" /><br/><input name=\"imgcode\" type=\"text\" />" : '';
	$comments = $Comment_Model->getComments(2, $logid, 'n', $commentPage);
	extract($comments);

	$Log_Model->updateViewCount($logid);
	include View::getView('header');
	include View::getView('single');
	include View::getView('footer');
	View::output();
}
if (ISLOGIN === true && $action == 'write') {
	$logid = isset($_GET['id']) ? intval($_GET['id']) : '';
        $site_title = "发表博文 - ".$site_title;
	$Sort_Model = new Sort_Model();
	$sorts = $Sort_Model->getSorts();
	if ($logid) {
		$Log_Model = new Log_Model();
		$Tag_Model = new Tag_Model();
		$blogData = $Log_Model->getOneLogForAdmin($logid);
		extract($blogData);
		$tags = array();
		foreach ($Tag_Model->getTag($logid) as $val) {
			$tags[] = $val['tagname'];
		}
		$tagStr = implode(',', $tags);
	}else {
		$title = '';
		$sortid = -1;
		$content = '';
		$excerpt = '';
		$tagStr = '';
		$logid = -1;
		$author = UID;
		$date = '';
	}
	include View::getView('header');
	include View::getView('write');
	include View::getView('footer');
	View::output();
}
if (ISLOGIN === true && $action == 'savelog') {
	$Log_Model = new Log_Model();
	$Tag_Model = new Tag_Model();

    //LoginAuth::checkToken();

	$title = isset($_POST['title']) ? addslashes(trim($_POST['title'])) : '';
	$sort = isset($_POST['sort']) ? intval($_POST['sort']) : '';
	$content = isset($_POST['content']) ? addslashes(trim($_POST['content'])) : '';
	$excerpt = isset($_POST['excerpt']) ? addslashes(trim($_POST['excerpt'])) : '';
	$tagstring = isset($_POST['tag']) ? addslashes(trim($_POST['tag'])) : '';
	$blogid = isset($_POST['gid']) ? intval(trim($_POST['gid'])) : -1;
	$date = isset($_POST['date']) ? addslashes($_POST['date']) : '';
	$author = isset($_POST['author']) ? intval(trim($_POST['author'])) : UID;
	$postTime = $Log_Model->postDate(Option::get('timezone'), $date);

	$logData = array(
		'title' => $title,
		'content' => $content,
		'excerpt' => $excerpt,
		'author' => $author,
		'sortid' => $sort,
		'date' => $postTime,
		'allow_remark' => 'y',//允许评论
		'hide' => 'n',//不隐藏
		'password' => '',//不设密码
		'checked' => $user_cache[UID]['ischeck'] == 'y' ? 'n' : 'y',
		);

	if ($blogid > 0) {
		$Log_Model->updateLog($logData, $blogid);
		$Tag_Model->updateTag($tagstring, $blogid);
	}else {
		$blogid = $Log_Model->addlog($logData);
		$Tag_Model->addTag($tagstring, $blogid);
	}
	$CACHE->updateCache();
	if ('n' == $logData['checked']) {
		mMsg('文章发布成功，请等待管理员审核', './');
	}
	emDirect("./");
}
// 评论
if ($action == 'addcom') {
	$Comment_Model = new Comment_Model();

	$name = isset($_POST['comname']) ? addslashes(trim($_POST['comname'])) : '';
    $content = isset($_POST['comment']) ? addslashes(trim($_POST['comment'])) : '';
    $mail = isset($_POST['commail']) ? addslashes(trim($_POST['commail'])) : '';
    $url = isset($_POST['comurl']) ? addslashes(trim($_POST['comurl'])) : '';
    $imgcode = isset($_POST['imgcode']) ? strtoupper(trim($_POST['imgcode'])) : '';
    $blogId = isset($_GET['gid']) ? intval($_GET['gid']) : - 1;
    $pid = isset($_GET['pid']) ? intval($_GET['pid']) : 0;

    $targetBlogUrl = './?post=' . $blogId;

    //发送cookie
 if(ROLE==ROLE_VISITOR&&isset($_COOKIE['name'])===false){

	setcookie('name',$name,time()+99999999);

	setcookie('mail',$mail,time()+99999999);

	setcookie('url',$url,time()+99999999);


	}
    if (ISLOGIN === true) {
		$name = addslashes($user_cache[UID]['name_orig']);
       	$mail = addslashes($user_cache[UID]['mail']);
        $url = addslashes(BLOG_URL);
    }

	if ($url && strncasecmp($url,'http',4)) {
		$url = 'http://'.$url;
	}

    doAction('comment_post');
    //记住用户个人信息


    if (ISLOGIN === true) {
		$name = addslashes($user_cache[UID]['name_orig']);
       	$mail = addslashes($user_cache[UID]['mail']);
        $url = addslashes(BLOG_URL);
    }

	if ($url && strncasecmp($url,'http',4)) {
		$url = 'http://'.$url;
	}

    doAction('comment_post');

    if($_POST['commentc']==9) {
 setcookie("WMZZ_BLOG_LOGCOM_CHECKBOX","checked", time()+99999999); //此功能将向浏览器发送一个Cookies，可以使访客以后发表评论不再需要手动勾选，不需要可以删除
              } else {
                mMsg('评论失败：您未选中发表评论确认框','./?post=' . $blogId);
    exit; }
    //打勾评论

	if($Comment_Model->isLogCanComment($blogId) === false){
        mMsg('评论失败：该文章已关闭评论', $targetBlogUrl);
    } elseif ($Comment_Model->isCommentExist($blogId, $name, $content) === true){
        mMsg('评论失败：已存在相同内容评论', $targetBlogUrl);
    } elseif ($Comment_Model->isCommentTooFast() === true && ROLE !== ROLE_ADMIN) {
		mMsg('评论失败：您提交评论的速度太快了，请稍后再发表评论', $targetBlogUrl);
	} elseif (strlen($name) > 20 || strlen($name) == 0){
        mMsg('评论失败：昵称不符合规范', $targetBlogUrl);
    } elseif ($mail != '' && !checkMail($mail)) {
        mMsg('评论失败：邮件地址不符合规范', $targetBlogUrl);
    } elseif (ISLOGIN == false && $Comment_Model->isNameAndMailValid($name, $mail) === false){
        mMsg('评论失败：禁止使用管理员昵称或邮箱评论', $targetBlogUrl);
    } elseif (strlen($content) == '' || strlen($content) > 2000) {
        mMsg('评论失败：内容不符合规范', $targetBlogUrl);
    } elseif (ROLE == ROLE_VISITOR && Option::get('comment_needchinese') == 'y' && !preg_match('/[\x{4e00}-\x{9fa5}]/iu', $content)) {
		mMsg('评论失败：评论内容需包含中文', $targetBlogUrl);
	}elseif (ISLOGIN == false && Option::get('comment_code') == 'y' && session_start() && $imgcode != $_SESSION['code']) {
        mMsg('评论失败：验证码错误', $targetBlogUrl);
    } else {
		$DB = Database::getInstance();
        $ipaddr = getIp();
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$utctimestamp = time();

		if($pid != 0) {
			$comment = $Comment_Model->getOneComment($pid);
			$content = '@' . addslashes($comment['poster']) . '：' . $content;
		}

		$ischkcomment = Option::get('ischkcomment');
		$hide = ROLE == ROLE_VISITOR ? $ischkcomment : 'n';

		$sql = 'INSERT INTO '.DB_PREFIX."comment (date,poster,gid,comment,mail,url,hide,ip,pid,useragent)
				VALUES ('$utctimestamp','$name','$blogId','$content','$mail','$url','$hide','$ipaddr','$pid','$useragent')";
		$ret = $DB->query($sql);
		$cid = $DB->insert_id();
		$CACHE = Cache::getInstance();

		if ($hide == 'n') {
			$DB->query('UPDATE '.DB_PREFIX."blog SET comnum = comnum + 1 WHERE gid='$blogId'");
			$CACHE->updateCache(array('sta', 'comment'));
            doAction('comment_saved', $cid);
            emDirect($targetBlogUrl);
		} else {
		    $CACHE->updateCache('sta');
		    doAction('comment_saved', $cid);
		    mMsg('评论发表成功，请等待管理员审核', $targetBlogUrl);
		}
    }
}

if (ROLE === ROLE_ADMIN && $action == 'delcom') {
    //LoginAuth::checkToken();
    $blogId = isset($_GET['gid']) ? intval($_GET['gid']) : - 1;
    $id = isset($_GET['id']) ? intval($_GET['id']) : '';

	$Comment_Model = new Comment_Model();
	$Comment_Model->delComment($id);
	$CACHE->updateCache(array('sta','comment'));
	emDirect('./?post=' . $blogId);
}


if ($action == 'com') {
if (ISLOGIN === true) {
$hide = '';
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$site_title = '评论管理 - '.$site_title;
$Comment_Model = new Comment_Model();

$comment = $Comment_Model->getComments(1, null, $hide, $page);
$cmnum = $Comment_Model->getCommentNum(null, $hide);
$pageurl = paginationX($cmnum, Option::get('admin_perpage_num'), $page, "./?action=com&page=");
}
else {
$site_title = "最新评论 - ".site_title;
$comment = $CACHE->readCache('comment');
$pageurl = '';
}
include View::getView('header');
include View::getView('comment');
include View::getView('footer');
View::output();
}
//评论管理
if (ISLOGIN === true && $action == 'delcom') {
$Comment_Model = new Comment_Model();
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
$Comment_Model->delComment($id);
$CACHE->updateCache(array('sta','comment'));
emDirect("./?action=com");
}
if (ISLOGIN === true && $action == 'showcom') {
$Comment_Model = new Comment_Model();
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
$Comment_Model->showComment($id);
$CACHE->updateCache(array('sta','comment'));
emDirect("./?action=com");
}
if (ISLOGIN === true && $action == 'hidecom') {
$Comment_Model = new Comment_Model();
$id = isset($_GET['id']) ? intval($_GET['id']) : '';
$Comment_Model->hideComment($id);
$CACHE->updateCache(array('sta','comment'));
emDirect("./?action=com");
}

if ($action == 'reply') {
	$Comment_Model = new Comment_Model();
	$cid = isset($_GET['cid']) ? intval($_GET['cid']) : 0;
	$commentArray = $Comment_Model->getOneComment($cid);
	if(!$commentArray) {
		mMsg('参数错误', './');
	}
	extract($commentArray);
        $site_title = "回复评论";
	$verifyCode = ISLOGIN == false && Option::get('comment_code') == 'y' ? "<img src=\"../include/lib/checkcode.php\"/><div class=\"user-info\"><span>验证</span><input name=\"imgcode\" type=\"text\"/></div>" : '';
	include View::getView('header');
	include View::getView('reply');
	include View::getView('footer');
	View::output();
}
// 微语
if ($action == 'tw' && Option::get('istwitter') == 'y') {
    $Twitter_Model = new Twitter_Model();
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $tws = $Twitter_Model->getTwitters($page);
    $twnum = $Twitter_Model->getTwitterNum();
    $pageurl =  paginationX($twnum, Option::get('index_twnum'), $page, './?action=tw&page=');
    $site_title = '微语 - '.$site_title;

	include View::getView('header');
	include View::getView('twitter');
	include View::getView('footer');
	View::output();
}
if (ROLE === ROLE_ADMIN && $action == 't') {
    //LoginAuth::checkToken();
    $Twitter_Model = new Twitter_Model();

    $t = isset($_POST['t']) ? addslashes(trim($_POST['t'])) : '';
    $attach = isset($_FILES['img']) ? $_FILES['img'] : '';

    if ($attach['tmp_name'] && !$t) {
    	$t = '分享图片';
    }

    if (!$t){
        emDirect("./?action=tw");
    }
    $tdata = array('content' => $Twitter_Model->formatTwitter($t),
            'author' => UID,
            'date' => time(),
    );

	if ($attach['tmp_name']) {
		$fileinfo = uploadFile($attach['name'], $attach['error'], $attach['tmp_name'], $attach['size'], array('jpg', 'jpeg','png'), false, false);
		$upfname = $fileinfo['file_path'];
        $size = @getimagesize($upfname);
		$w = $size[0];
		$h = $size[1];
		if ($w>150 || $h>120) {
			$uppath = Option::UPLOADFILE_PATH . gmdate('Ym') . '/';
			$thum = str_replace($uppath,$uppath.'thum-',$upfname);
			resizeImage($upfname, $thum, 120, 150);
			$upfname = $thum;
		}

		$tdata['img'] = str_replace('../', '', $upfname);
	}

    $Twitter_Model->addTwitter($tdata);
    $CACHE->updateCache(array('sta','newtw'));
    doAction('post_twitter', $t);
    emDirect("./?action=tw");
}
if (ROLE === ROLE_ADMIN && $action == 'delt') {
    //LoginAuth::checkToken();
    $Twitter_Model = new Twitter_Model();
    $id = isset($_GET['id']) ? intval($_GET['id']) : '';
	$Twitter_Model->delTwitter($id);
	$CACHE->updateCache(array('sta','newtw'));
	emDirect("./?action=tw");
}
if ($action == 'login') {
	Option::get('login_code') == 'y' ? $ckcode = "<img src=\"../include/lib/checkcode.php\"/><div class=\"user-info\"><span>验证码</span><input name=\"imgcode\" id=\"imgcode\" type=\"text\" /></div>
" : $ckcode = '';
        $site_title = "登录博客 - ".$site_title;
	include View::getView('header');
	include View::getView('login');
	include View::getView('footer');
	View::output();
}
if ($action == 'auth') {
	session_start();
	$username = addslashes(trim($_POST['user']));
	$password = addslashes(trim($_POST['pw']));
	$img_code = (Option::get('login_code') == 'y' && isset ($_POST['imgcode'])) ? addslashes (trim (strtoupper ($_POST['imgcode']))) : '';
	$ispersis = true;
	if (LoginAuth::checkUser($username, $password, $img_code) === true) {
		loginAuth::setAuthCookie($username, $ispersis);
		emDirect('?tem=' . time());
	}else {
		emDirect("?action=login");
	}
}
if ($action == 'logout') {
	setcookie(AUTH_COOKIE_NAME, ' ', time () - 31536000, '/');
	emDirect('?tem=' . time());
}
function mMsg($msg, $url) {
	include View::getView('header');
	include View::getView('msg');
	include View::getView('footer');
	View::output();
}
function authPassword($postPwd, $cookiePwd, $logPwd, $logid) {
	$pwd = $cookiePwd ? $cookiePwd : $postPwd;
	if ($pwd !== addslashes($logPwd)) {
		include View::getView('header');
		include View::getView('logauth');
		include View::getView('footer');
		if ($cookiePwd) {
			setcookie('em_logpwd_' . $logid, ' ', time() - 31536000);
		}
		View::output();
	}else {
		setcookie('em_logpwd_' . $logid, $logPwd);
	}
}

//获取文章对应的标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
	$tag = '';
	foreach ($log_cache_tags[$blogid] as $value){
$tag .= "<a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a>';
}
echo $tag;
}
}

//获取文章对应的分类
function blog_sort($blogid){
	global $CACHE;
	$log_cache_sort = $CACHE->readCache('logsort');   if(!empty($log_cache_sort[$blogid])){
    $blog_sort = "<a href=\"./?sort=".$log_cache_sort[$blogid]['id']."\">".$log_cache_sort[$blogid]['name']."</a>";
}
else{
$blog_sort = "暂未分类";
}
echo $blog_sort;
}

 //分页函数
function paginationX($count,$perlogs,$page,$url,$anchor=''){ $pnums = @ceil($count / $perlogs);
$urlHome = preg_replace("|[\?&/][^\./\?&=]*page[=/\-]|","",$url);
$re = '';
$page = @min($pnums,$page); $prepg=$page-1; //上一页
$nextpg=($page==$pnums ? 0 : $page+1); //下一页
if($pnums<=1)
return false; //如果只有一页则跳出

$re .="<div class=\"page-box\"><table class=\"page-wrap\"><tbody><tr>";

if($prepg) //若存在上一页
{
$re .="<td class=\"page-left\"><a href=\"$url$prepg$anchor\">上页</a></td>";
}
else{
$re .="<td class=\"page-left\"><a href=\"javascript:void(0);\">首页</a></td>";
}

$re .="<td class=\"first-page\"><a href=\"$urlHome$anchor\">1</a></td><td class=\"page-select\"><select name=\"select-box\" onchange=\"window.location='$url'+this.value\">\n"; for($i=1;$i<=$pnums;$i++){ if($i==$page)
{
$re .="<option value=\"$i\" selected>$i</option>\n";
}
else
{
$re .="<option value=\"$i\">$i</option>\n";
}
}
$re .="</select></td><td class=\"last-page\"><a href=\"$url$pnums$anchor\">$pnums</a></td>";

if($nextpg) //若存在下一页
{
$re .="<td class=\"page-right\"><a href=\"$url$nextpg$anchor\">下页</a></td>";
}
else{
$re .="<td class=\"page-right\"><a href=\"javascript:void(0);\">末页</a></td>";
}

$re .="</tr></tbody></table></div>";

return $re;
}

 //图片链接
function pic_thumb($content){
 preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $content, $img);
    $imgsrc = !empty($img[1]) ? $img[1][0] : '';
	if($imgsrc):
		return $imgsrc;
	endif;
}

 //搜索
 if($action == 'dd'){
 $keyword = $_POST['keyword'];
 $Log_Model = new Log_Model();
 $page = isset($_GET['page']) ? abs(intval ($_GET['page'])) : 1;
 $sqlSegment = "and title like '%{$keyword}%' order by date desc";
 $lognum = $Log_Model->getLogNum('n', $sqlSegment);
 $logs = $Log_Model->getLogsForHome($sqlSegment, $page, 20);
 $site_title = $keyword.'-'.$site_title;
 $pageurl = "./?action=s&keyword='.$keyword.'&page=";
 $page_url = paginationX($lognum, $index_lognum, $page, $pageurl);
 include View::getView('header');
 include View::getView('log');
 include View::getView('footer');
 View::output();
 }
 //搜索
 if($action == 's'){
$Log_Model = new Log_Model();
		$options_cache = Option::getAll();
		extract($options_cache);

		$page = isset($params[4]) && $params[4] == 'page' ? abs(intval($params[5])) : 1;
		$keyword = isset($params[1]) && $params[1] == 'keyword' ? trim($params[2]) : '';
		$keyword = addslashes(htmlspecialchars(urldecode($keyword)));
		$keyword = str_replace(array('%', '_'), array('\%', '\_'), $keyword);


		$pageurl = '';

		$sqlSegment = "and title like '%{$keyword}%' order by date desc";
		$lognum = $Log_Model->getLogNum('n', $sqlSegment);
        $total_pages = ceil($lognum / $index_lognum);
        if ($page > $total_pages) {
            $page = $total_pages;
        }

		$pageurl .= './?action=s?keyword='.urlencode($keyword).'&page=';

		$logs = $Log_Model->getLogsForHome($sqlSegment, $page, $index_lognum);
		$page_url = paginationX($lognum, $index_lognum, $page, $pageurl);

		include View::getView('header');
 include View::getView('log');
 include View::getView('footer');
 View::output();
}
//相邻文章
function getnearlog($logdate){ $Log_Model = new Log_Model(); $nearlog = $Log_Model->neighborLog($logdate);
$nextlogid = $nearlog['nextLog']['gid']; $nextlogtitle = $nearlog['nextLog']['title'];
$prevlogid = $nearlog['prevLog']['gid']; $prevlogtitle = $nearlog['prevLog']['title'];
if ($nextlogid === $logid){
$log = '<div class="prevlog"><a href="./?post='.$prevlogid.'"><span>上一篇:</span> '.$prevlogtitle.'</a></div><div class="nextlog"><span>下一篇:</span> 已经是最后一篇</div>';
}
elseif ($prevlogid === $logid){
$log = '<div class="prevlog"><span>上一篇:</span> 已经是最新一篇</div><div class="nextlog"><a href="./?post='.$nextlogid.'"><span>下一篇:</span> '.$nextlogtitle.'</a></div>';
}
else{
$log = '<div class="prevlog"><a href="./?post='.$prevlogid.'"><span>上一篇:</span> '.$prevlogtitle.'</a></div><div class="nextlog"><a href="./?post='.$nextlogid.'"><span>下一篇:</span> '.$nextlogtitle.'</a></div>';
}
echo $log;
}

//获取Gravatar头像(换用多说镜像）
function getGravatarX($email, $s = 40, $d = 'mm', $g = 'g') {
	$hash = md5($email);
	$avatar = "http://gravatar.duoshuo.com/avatar/$hash?s=$s&d=$d&r=$g";
	return $avatar;
}

//替换表情
function xemoFormat($t){
	$emos = array('[微笑]'=>'01.gif', '[大哭]'=>'02.gif', '[尴尬]'=>'03.gif', '[发怒]'=>'04.gif', '[调皮]'=>'05.gif', '[呲牙]'=>'06.gif', '[惊讶]'=>'07.gif', '[难过]'=>'08.gif', '[酷]'=>'09.gif', '[冷汗]'=>'10.gif', '[抓狂]'=>'11.gif', '[撇嘴]'=>'12.gif', '[吐]'=>'13.gif', '[偷笑]'=>'14.gif', '[可爱]'=>'15.gif', '[白眼]'=>'16.gif', '[傲慢]'=>'17.gif', '[饥饿]'=>'18.gif', '[困]'=>'19.gif', '[惊恐]'=>'20.gif', '[流汗]'=>'21.gif', '[憨笑]'=>'22.gif', '[色]'=>'23.gif', '[大兵]'=>'24.gif', '[奋斗]'=>'25.gif', '[咒骂]'=>'26.gif', '[疑问]'=>'27.gif', '[嘘]'=>'28.gif', '[晕]'=>'29.gif', '[折磨]'=>'30.gif', '[衰]'=>'31.gif', '[骷髅]'=>'32.gif', '[敲打]'=>'33.gif', '[发呆]'=>'34.gif', '[再见]'=>'35.gif','[擦汗]'=>'36.gif','[抠鼻]'=>'37.gif','[鼓掌]'=>'38.gif','[糗大了]'=>'39.gif','[坏笑]'=>'40.gif','[左哼哼]'=>'41.gif','[右哼哼]'=>'42.gif','[哈欠]'=>'43.gif','[鄙视]'=>'44.gif','[得意]'=>'45.gif','[委屈]'=>'46.gif','[快哭了]'=>'47.gif','[阴险]'=>'48.gif','[亲亲]'=>'49.gif','[吓]'=>'50.gif','[可怜]'=>'51.gif','[流泪]'=>'52.gif','[害羞]'=>'53.gif','[拥抱]'=>'54.gif','[闭嘴]'=>'55.gif','[强]'=>'56.gif','[弱]'=>'57.gif','[握手]'=>'58.gif','[胜利]'=>'59.gif','[抱拳]'=>'60.gif','[勾引]'=>'61.gif','[拳头]'=>'62.gif','[睡]'=>'63.gif','[ok]'=>'64.gif');
	if(!empty($t) && preg_match_all('/\[.+?\]/',$t,$matches)){
		$matches = array_unique($matches[0]);
		foreach ($matches as $data) {
			if(isset($emos[$data]))
				$t = str_replace($data,'<img title="'.$data.'" src="'.TEMPLATE_URL.'face/'.$emos[$data].'"/>',$t);
		}
	}
	return $t;
}


//30天按点击率排行文章
function getdatelogs($log_num) {
    $db = Database::getInstance();
    $time = time();
    $sql = "SELECT gid,title FROM ".DB_PREFIX."blog WHERE type='blog' AND date > $time - 30*24*60*60 ORDER BY `views` DESC LIMIT 0,$log_num";
    $list = $db->query($sql);
    $i = 0;
    while($row = $db->fetch_array($list)){
$i++;
?>
<li><a href="<?php echo BLOG_URL; ?>m/?post=<?php echo $row['gid']; ?>" title="<?php echo $row['title']; ?>"><?php if($i==1){?><em class="hotone"><?php echo $i;?></em><?php }else if($i==2){ ?><em class="hottwo"><?php echo $i;?></em><?php }else if($i==3){ ?><em class="hotthree"><?php echo $i;?></em><?php }else{ ?><em class="hotSoSo"><?php echo $i;?></em><?php }?><?php echo $row['title']; ?></a></li>
<?php } ?>
<?php } ?>


