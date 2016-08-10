<?php
/**
 * 评论管理
 * @copyright kurly@foxmail.com
 */

class Gbook_Option {

	private $db;

	function __construct() {
		$this->db = Database::getInstance();
	}

	// 初始化配置项
	function initOptions(){
		$data = array(
			'duration' => 15,
			'indexPerPageNum' => 10,
			'adminPerPageNum' => 10,
			'formpos' => 0,
			'emlypage' => 0,

			'show_form' => 1,
			'show_front' => 1,
			'show_verify' => 1,

			'show_nickname' => 1,
			'show_time' => 1,
			'show_siteurl' => 1,
			'show_sex' => 0,
			'show_content' => 1,

			'need_check' => 1,
			'need_login' => 0,
			
			'is_nickname' => 1,
			'is_email' => 2,
			'is_siteurl' => 2,
			'is_phone' => 2,
			'is_qq' => 2,
			'is_sex' => 2,
			'is_content' => 1
		);
		$data_str = '';
		foreach ($data as $key => $value) {
			$data_str .= '(\''.$key.'\',\''.$value.'\'),';
		}
		$data_str = rtrim($data_str,',');
		$sql = " INSERT INTO `".DB_PREFIX."gbook_opts` ( `name`, `value` ) VALUES ".$data_str." ";
		$this ->db -> query($sql);

		$sql2 = " INSERT INTO `".DB_PREFIX."gbook` ( `time`,`nickname`,`email`,`siteurl`,`qq`,`sex`,`content`,`pass` ) VALUES ( '".time()."','秦时明月','kurly@foxmail.com','http://www.myemlog.com/','87419525','男','欢迎使用EMLOG独立留言板',1 ) ";
		$this ->db -> query($sql2);
	}

	// 获取配置项
	function gbookOptions(){
		$opts = array();
		$sql = " SELECT * FROM `".DB_PREFIX."gbook_opts` ";
		$rs = $this -> db -> query($sql);
		while($row = $this -> db -> fetch_array($rs)){
			$opts[$row['name']] = $row['value'];
		}
		return $opts;
	}

	// 更新配置项
	function updateGbookOpts($data){
		foreach ($data as $key => $value) {
			$sql = " UPDATE `".DB_PREFIX."gbook_opts` SET `value` = '".$value."' WHERE `name` = '".$key."' ";
			$this -> db -> query($sql);
		}
	}

}