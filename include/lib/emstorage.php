<?php
/**
 * EmStorage文件存储的类
 * 文件上传使用SaeStorage
 * @author bjdgyc@163.com
 * @time 2013年6月27日20:29:46
 * @copyright (c) Emlog All Rights Reserved
 */

class EmStorage {

	private $db;
	private static $instance = null;
	//SaeStorage
	private static $storage = null;
	// SaeStorage的存储域名，默认是emlog
	private static $domain = StorageDomain;
	//默认存储路径
	private $StoragePath = 'emlog';


	private function __construct() {

	}

	/**
	 * 静态方法，返回SaeStorage实例
	 *
	 * @return SaeStorage
	 */
	public static function getInstance() {
		if (self::$instance == null) {
			self::$instance = new EmStorage();
			//实例化SaeStorage类
			self::$storage = new SaeStorage();
		}
		return self::$instance;
	}
	
	
	public function upload($destFileName,$srcFileName) {
		$destFileName = $this->StoragePath.'/'.gmdate('Ym') . '/'.$destFileName;
		$url = self::$storage->upload(self::$domain,$destFileName,$srcFileName);
		return $url;
	}
	
	public function write($destFileName,$content) {
		$destFileName = $this->StoragePath.'/'.gmdate('Ym') . '/'.$destFileName;
		$url = self::$storage->write(self::$domain,$destFileName,$content);
		return $url;
	}
	
	
	public function delete($filename) {
		$path = explode('stor.sinaapp.com/',$filename);
		$filename = $path['1'];
		return self::$storage->delete(self::$domain,$filename);
	}
}