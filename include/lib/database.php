<?php
/**
 * 数据库操作路由
 *
 * @copyright (c) Emlog All Rights Reserved
 */

class Database {

    public static function getInstance() {
		if(class_exists('mysqli'))
			return MySqlii::getInstance();
		else
			return MySql::getInstance();
    }

}
