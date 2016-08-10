<?php
/**
 * 评论管理
 * @copyright kurly@foxmail.com
 */

class Gbook_Model {

	private $db;

	function __construct() {
		$this->db = Database::getInstance();
	}

	function indexGbookList($page){
		$Gbook_Option = new Gbook_Option();
		$opts = $Gbook_Option -> gbookOptions();

		$indexPerPageNum = $opts['indexPerPageNum'];

		$sql = " SELECT * FROM `".DB_PREFIX."gbook` WHERE `pass` = 1 ORDER BY `id` DESC ";
		$rs = $this -> db -> query($sql);
		$msgNum = $this -> db -> num_rows($rs);
		$pageNum = ceil($msgNum/$indexPerPageNum);
		$pageurl = '';
		if($page > $pageNum && $pageNum >=1){
			$page = $pageNum;
		}
		$pageurl .= msgListPageUrl('page');
		$page_url = pagination($msgNum, $indexPerPageNum, $page, $pageurl);

		$sql2 = " SELECT * FROM `".DB_PREFIX."gbook` WHERE `pass` = 1 ORDER BY `id` DESC LIMIT ".($page-1)*$indexPerPageNum.", ".$indexPerPageNum;
		$rs2 = $this -> db -> query($sql2);
		$msgData = array();
		while($row = $this -> db -> fetch_array($rs2)){
			$msgData[]=$row;
		}

		return array(
			'msgs' => $msgData,
			'pagehtml' => '<div id="pagenavi">'.$page_url.'</div>'
		);
	}

	// 是否已存在留言
	function isTheSameMsg($nickname,$content){
		$sql = " SELECT `nickname`,`content` FROM `".DB_PREFIX."gbook` WHERE `nickname` = '".$nickname."' AND `content` = '".$content."' ";
		$num = $this -> db -> num_rows($this -> db ->query($sql));
		if($num)
			return true;
		else
			return false;
	}

	function adminGbookList($page){
		$Gbook_Option = new Gbook_Option();
		$opts = $Gbook_Option -> gbookOptions();

		$adminPerPageNum = $opts['adminPerPageNum'];

		$sql = " SELECT * FROM `".DB_PREFIX."gbook` ORDER BY `id` DESC ";
		$rs = $this -> db -> query($sql);
		$msgNum = $this -> db -> num_rows($rs);
		$pageNum = ceil($msgNum/$adminPerPageNum);
		$pageurl = '';
		if($page > $pageNum && $pageNum>=1){
			$page = $pageNum;
		}
		$pageurl .= msgAdminPageUrl('page');
		$page_url = pagination($msgNum, $adminPerPageNum, $page, $pageurl);

		$sql2 = " SELECT * FROM `".DB_PREFIX."gbook` ORDER BY `id` DESC LIMIT ".($page-1)*$adminPerPageNum.", ".$adminPerPageNum;
		$rs2 = $this -> db -> query($sql2);
		$msgData = array();
		while($row = $this -> db -> fetch_array($rs2)){
			$msgData[]=$row;
		}

		return array(
			'msgs' => $msgData,
			'pagehtml' => $page_url
		);
	}


	// 增加留言
	function addMsg($isdaoru=0,$nickname,$email,$siteurl,$phone,$qq,$sex,$content,$verify,$uid,$pid,$pass,$time,$ip){
		$Gbook_Option = new Gbook_Option();
		$opts = $Gbook_Option -> gbookOptions();

		if($isdaoru){
			$pass = $pass;
			$time = $time;
			$ip = $ip;
		}else{
			$pass = $opts['need_check']?0:1;
			$time = time();
			$ip = getIp();

			if(!$opts['show_form']){
				echo '留言功能已经关闭！';
				return;
			}

			if($opts['need_login'] && ROLE != 'admin' && ROLE != 'writer'){
				echo '未登录！';
				return;
			}

			$mustArr =whatMustDo();
			foreach($mustArr as $v){
				if($$v == ''){
					echo '请填写必填项目';
					exit;
				}
			}

			if($opts['show_verify']==1){
				$sessionCode = isset($_SESSION['code']) ? $_SESSION['code'] : '';
		   		if($verify == !$sessionCode){
		   			echo '验证码错误！';
		   			exit;
		   		}
			}

			if(!checkDuration($time,$ip)){
				echo '您发言速度太快啦！';
				exit;
			}

			if($this -> isTheSameMsg($nickname,$content)){
				echo '请勿重复提交！';
				exit;
			}

			if($opts['need_check']){
				$passtip = '<span style="color:red" class="passwaittip">[请等待审核] </span>';
			}else{
				$passtip='';
			}
		}

		$sql = " INSERT INTO `".DB_PREFIX."gbook` ( `time`,`nickname`,`email`,`siteurl`,`phone`,`qq`,`sex`,`ip`,`content`,`pass`,`uid`,`pid` ) VALUES ( '".$time."','".$nickname."','".$email."','".$siteurl."','".$phone."','".$qq."','".$sex."','".$ip."','".$content."','".$pass."',$uid,$pid ) ";
		$this -> db -> query($sql);
		$lastId = $this -> db -> insert_id();
		echo '
			<li class="item" id="msg-'.$lastId.'">
				<p class="info">
					<span class="nickname"><b>昵称</b>'.htmlspecialchars($nickname).'</span>
					<span class="qq"><b>性别</b>'.htmlspecialchars($sex).'</span>
					<span class="qq"><b>网址</b><a href="'.htmlspecialchars($siteurl).'" target="_blank">'.htmlspecialchars($siteurl).'</a></span>
				</p>
				<p class="con">
					'.$passtip.htmlspecialchars($content).'
				</p>
			</li>
		';
		return;
	}

	function passOneMsg($msgId){
		if(ROLE!='admin'){
			echo '权限不足！';
		}
		$sql = " UPDATE `".DB_PREFIX."gbook` SET `pass` = 1 WHERE `id` = $msgId ";
		$this -> db -> query($sql);
		return true;
	}

	function delOneMsg($msgId){
		if(ROLE!='admin'){
			echo '权限不足！';
		}
		$sql = " DELETE FROM `".DB_PREFIX."gbook` WHERE `id` = $msgId ";
		$this -> db -> query($sql);
		return true;
	}

	function insertEmData($gid){
		if(ROLE!='admin'){
			echo '权限不足！';
		}
		$sessionCode = isset($_SESSION['code']) ? $_SESSION['code'] : '';
		$sql = " SELECT * FROM `".DB_PREFIX."comment` WHERE `gid` = $gid ";
		$rs = $this -> db -> query($sql);
		while( $row = $this -> db -> fetch_array($rs) ){
			if($this -> isTheSameMsg($row['poster'],$row['comment']))
				continue;
			if($row['hide'] == 'n'){
				$pass = 1;
			}else{
				$pass = 0;
			}
			$this -> addMsg(1,$row['poster'],$row['mail'],$row['url'],'','','未知',$row['comment'],$sessionCode,0,$row['pid'],$pass,$row['date'],$row['ip']);
		}
	}

}