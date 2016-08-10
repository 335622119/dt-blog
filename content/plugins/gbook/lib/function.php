<?php
!defined('EMLOG_ROOT') && exit('access deined!');
function gbookFace(){
	$arr = array(
		'微笑' => 1,
		'难过' => 2,
		'抓狂' => 3,
		'鼻涕' => 4,
		'好色' => 5,
		'害羞' => 6,
		'耍酷' => 7,
		'晕菜' => 8,
		'调皮' => 9,
		'流汗' => 10,
		'惊讶' => 11,
		'问号' => 12,
		'睡觉' => 13,
		'捂嘴' => 14,
		'偷笑' => 15
	);
	return $arr;
}

function formatFace($content){
	$faceArr = gbookFace();
	foreach ($faceArr as $key => $value) {
		$content = str_replace('['.$key.']', '<img src="'.BLOG_URL.'content/plugins/gbook/style/images/face/'.$value.'.gif" />', $content);
	}
	return $content;
}

// 必填项目
function whatMustDo(){
	$arr = array();
	$arr2 = array();
	$db = MySql::getInstance();
	$sql = " SELECT `name`,`value` FROM `".DB_PREFIX."gbook_opts` WHERE name = 'is_nickname' OR name = 'is_email' OR name = 'is_siteurl' OR name = 'is_phone' OR name = 'is_qq' OR name = 'is_sex' OR name = 'is_content' ";
	$rs = $db -> query($sql);
	while($row = $db -> fetch_array($rs)){
		if($row['value'] == 1){
			$arr[] = $row['name'];
		}
	}
	foreach($arr as $v){
		$v = str_replace('is_', '', $v);
		$arr2[] = $v;
	}
	return $arr2;
}

function getEmPages(){
	$arr = array();
	$db = MySql::getInstance();
	$sql = " SELECT `gid`,`title` FROM `".DB_PREFIX."blog` WHERE `type` = 'page' ";
	$rs = $db -> query($sql);
	while($row = $db -> fetch_array($rs)){
		$arr[$row['title']] = $row['gid'];
	}
	return $arr;
}

function checkDuration($time,$ip){
	$db = MySql::getInstance();
	$sql = " SELECT `time` FROM `".DB_PREFIX."gbook` WHERE `ip` = '".$ip."' ORDER BY `id` DESC LIMIT 0,1 ";
	$row = $db -> once_fetch_array($sql);
	if($time - $row['time'] <=15){
		return false;
	}else{
		return true;
	}
}

function msgListPageUrl($page = null) {
	$msgUrl = '';
	$msgUrl = BLOG_URL . '?plugin=gbook';
	if ($page)
		$msgUrl .= '&page=';
	return $msgUrl;
}

function msgAdminPageUrl($page = null) {
	$msgUrl = '';
	$msgUrl = BLOG_URL . 'admin/plugin.php?plugin=gbook';
	if ($page)
		$msgUrl .= '&page=';
	return $msgUrl;
}

function creatIndexGbookList($page){
	$Gbook_Model = new Gbook_Model();
	$Gbook_Option = new Gbook_Option();
	$opts = $Gbook_Option -> gbookOptions();

	if(!$opts['show_front']){
		return;
	}

	$nickname_flag = $opts['show_nickname']?1:0;
	$time_flag = $opts['show_time']?1:0;
	$sex_flag = $opts['show_sex']?1:0;
	$siteurl_flag = $opts['show_siteurl']?1:0;
	$content_flag = $opts['show_content']?1:0;

	$msgListData = $Gbook_Model -> indexGbookList($page);
$gbookListHtml = '
<div id="guestBookList">
	<h3 id="guestBookListTitle">
		<span>留言列表</span>
	</h3>
	<ul class="list">';
			if($msgListData['msgs']):
				foreach($msgListData['msgs'] as $k => $v):
					$gbookListHtml .= '<li class="item" id="msg-'.$v["id"].'">
						<p class="info">';
						if($nickname_flag){
							$gbookListHtml .= '<span class="nickname"><b>昵称</b>'.htmlspecialchars($v["nickname"]).'</span>';
						}
						if($time_flag){
							$gbookListHtml .= '<span class="time"><b>时间</b>'.date("Y-m-d H:m",$v["time"]).'</span>';
						}
						if($sex_flag){
							$gbookListHtml .= '<span class="sex"><b>性别</b>'.htmlspecialchars($v["sex"]).'</span>';
						}
						if($siteurl_flag){
							$gbookListHtml .= '<span class="siteurl"><b>网址</b><a href="'.htmlspecialchars($v["siteurl"]).'" target="_blank" rel="nofollow">'.htmlspecialchars($v["siteurl"]).'</a></span>';
						}

						$gbookListHtml .= '</p>';

						if($content_flag){
							$gbookListHtml .= '<p class="con">'.formatFace(htmlspecialchars($v["content"])).'</p>';
						}
					$gbookListHtml .= '</li>';
				endforeach;
			else:
				$gbookListHtml .= '暂时没有人留言！';
			endif;
			$gbookListHtml .= $msgListData['pagehtml'];
	$gbookListHtml .= '</ul>
</div>';
	return $gbookListHtml;
}

function creatAdminGbookList($page){
	$Gbook_Model = new Gbook_Model();
	$msgListData = $Gbook_Model -> adminGbookList($page);
?>
	<div id="lyList">
		<div class="doall">
			<span class="selectall"><a href="javascript:;">全选</a></span><span clss="pass"><a href="javascript:operateAct('passall');">审核</a></span><span class="del"><a href="javascript:;" onclick="return operateAct('delall')">删除</a></span>
			<span class="operateTip"></span>
		</div>
		<form action="" method="post" name="msgListForm" id="msgListForm">
			<input name="token" id="token" value="<?php echo LoginAuth::genToken(); ?>" type="hidden" />
			<ul>
				<?php if($msgListData['msgs']):?>
					<?php foreach($msgListData['msgs'] as $k => $v):?>
					<li class="item" id="msgItem<?php echo $v['id'];?>">
						<p class="lycontent">
							<input type="checkbox" class="ids" name="msgs[]" value="<?php echo $v['id'];?>" />
							<b>内容</b><?php if($v['pass']==0) echo '<span class="unpass'.$v['id'].'" style="color:red;">[未审核] </span>';?><a href="<?php echo BLOG_URL;?>?plugin=gbook#msg-<?php echo $v['id'];?>" target="_blank"><?php echo formatFace(htmlspecialchars($v['content']));?></a>
						</p>
						<p class="info">
							<span class="date">
								<b>时间</b><?php echo date("Y-m-d H:m",$v['time']);?>
							</span>
							<span class="nickname">
								<b>昵称</b>
								<?php
								if(!empty($v['siteurl']) && $v['siteurl'] != 'http://'):
									echo '<a href="'.htmlspecialchars($v['siteurl']).'" target="_blank">'.htmlspecialchars($v['nickname']).'</a>';
								else:
									echo htmlspecialchars($v['nickname']);
								endif;
								?>
							</span>
							<span class="email">
								<b>邮箱</b><?php echo htmlspecialchars($v['email']);?>
							</span>
							<span class="qq">
								<b>QQ</b><?php echo htmlspecialchars($v['qq']);?>
							</span>
							<span class="phone">
								<b>电话</b><?php echo htmlspecialchars($v['phone']);?>
							</span>
							<span class="phone">
								<b>性别</b><?php echo htmlspecialchars($v['sex']);?>
							</span>
						</p>
						<div class="operate">
							<?php if($v['pass']==0):?>
								<span class="unpass<?php echo $v['id'];?>"><a href="javascript:subPass(<?php echo $v['id'];?>,'<?php echo LoginAuth::genToken(); ?>');">审核</a></span>
							<?php endif;?>
							<span><a href="javascript:;" onclick="return delMsg(<?php echo $v['id'];?>,'<?php echo LoginAuth::genToken(); ?>');" style="color:red;">删除</a></span>
						</div>
					</li>
					<?php endforeach;?>
				<?php else:?>
				<p style="padding:0 20px;">暂时没有留言！</p>
				<?php endif;?>
			</ul>
		</form>
		<li id="gbookPagenavi">
			<?php echo $msgListData['pagehtml'];?>
		</li>
		<div class="doall">
			<span class="selectall"><a href="javascript:;">全选</a></span><span clss="pass"><a href="javascript:operateAct('passall');">审核</a></span><span class="del"><a href="javascript:;" onclick="return operateAct('delall')">删除</a></span>
			<span class="operateTip"></span>
		</div>
	</div>
<?php
}

function creatGbookForm(){
	$Gbook_Option = new Gbook_Option();
	$opts = $Gbook_Option -> gbookOptions();

	$faceArr = gbookFace();
	$faceHtml = '';
	foreach ($faceArr as $key => $value) {
		$faceHtml .= '<img src="'.BLOG_URL.'content/plugins/gbook/style/images/face/'.$value.'.gif" onclick="insertFace(\''.$key.'\')" />';
	}

	$gbookFormHtml = '';

	if(!$opts['show_form']){
		$gbookFormHtml .= '留言功能已经关闭！';
		return $gbookFormHtml;
	}
	if($opts['need_login'] && ROLE != 'admin' && ROLE != 'writer'){
		$gbookFormHtml .= '请 <a href="'.BLOG_URL.'admin/" target="_blank">登录</a> 后再留言！';
		return $gbookFormHtml;
	}

	$uid = UID?UID:0;

	$gbookFormHtml .= '
<div id="guestBook">
	<h3 id="guestBookFormTitle">
		<span>在线留言</span>
	</h3>
	<form action="" method="post" name="postMsgForm">
		<input type="hidden" name="act" value="addmsg" /> 
		<table cellspacing="0" cellspadding="0">
	';

	if( $opts['is_nickname'] ){
		if( $opts['is_nickname'] == 1 ) $tip1 = '<span class="redtip">*</span>';
		$gbookFormHtml .= '<tr>
			<td class="l">昵称：</td>
			<td>
				<input type="text" name="nickname" class= "bar" />
				'.$tip1.'
			</td>
			<td></td>
		</tr>';
	}

	if( $opts['is_email'] ){
		if( $opts['is_email'] == 1 ) $tip2 = '<span class="redtip">*</span>';
		$gbookFormHtml .= '<tr>
			<td class="l">邮箱：</td>
			<td>
				<input type="text" name="email" class= "bar" />
				'.$tip2.'
			</td>
			<td></td>
		</tr>';
	}

	if( $opts['is_siteurl'] ){
		if( $opts['is_siteurl'] == 1 ) $tip3 = '<span class="redtip">*</span>';
		$gbookFormHtml .= '<tr>
			<td class="l">网址：</td>
			<td>
				<input type="text" name="siteurl" class= "bar2" value="http://" />
				'.$tip3.'
			</td>
			<td></td>
		</tr>';
	}

	if( $opts['is_phone'] ){
		if( $opts['is_phone'] == 1 ) $tip4 = '<span class="redtip">*</span>';
		$gbookFormHtml .= '<tr>
			<td class="l">电话：</td>
			<td>
				<input type="text" name="phone" class= "bar" />
				'.$tip4.'
			</td>
			<td></td>
		</tr>';
	}

	if( $opts['is_qq'] ){
		if( $opts['is_qq'] == 1 ) $tip5 = '<span class="redtip">*</span>';
		$gbookFormHtml .= '<tr>
			<td class="l">QQ：</td>
			<td>
				<input type="text" name="qq" class= "bar" />
				'.$tip5.'
			</td>
			<td></td>
		</tr>';
	}

	if( $opts['is_sex'] ){
		if( $opts['is_sex'] == 1 ) $tip6 = '<span class="redtip">*</span>';
		$gbookFormHtml .= '
		<tr>
			<td class="l">性别：</td>
			<td>
				<input type="radio" name="sex" value="男" /> 男 <input type="radio" name="sex" value="女" /> 女
				'.$tip6.'
			</td>
			<td></td>
		</tr>';
	}

	if( $opts['is_content'] ){
		if( $opts['is_content'] == 1 ) $tip7 = '<span class="redtip">*</span>';
		$gbookFormHtml .= '
		<tr>
			<td class="l">内容：</td>
			<td>
			<p id="formFaces">'.$faceHtml.'</p>
				<textarea name="content"></textarea>
				'.$tip7.'
			</td>
			<td></td>
		</tr>';
	}

	if( $opts['show_verify'] ){
		$gbookFormHtml .= '
		<tr>
			<td>验证码：</td>
			<td colspan="2">
				<input type="text" name="verify" class= "bar3" /> 
				<img src="'.BLOG_URL.'include/lib/checkcode.php" id="verifyImg" onclick="refreshVerify(\''.BLOG_URL.'include/lib/checkcode.php\')" />
				<span class="redtip">*</span>
			</td>
		</tr>';
	}

	$gbookFormHtml .= '
				<tr>
					<td></td>
					<td colspan="2">
						<input type="hidden" name="uid" value="'.$uid.'" />
						<input type="button" value="提交留言" onclick="subMsg(checkMsgForm(),$(\'form[name=postMsgForm]\'),\''.BLOG_URL.'include/lib/checkcode.php\','.$opts['indexPerPageNum'].')" id="subMsgBtn" class= "bar4" /><span id="msgTip"></span>
					</td>
				</tr>
		</table>
	</form>
</div>';
	return $gbookFormHtml;
}
?>