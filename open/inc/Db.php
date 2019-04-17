<?php
/**
 * @abstract 数据库操作类
 */

class Db {
	/**
	 * @abstract 数据库链接
	 */
	protected static $conn = null;
	
	/**
	 * @abstract 操作执行数目
	 */
	protected static $queryNum = 0;
	
	/**
	 * @abstract 连接
	 */
	public static function connect($dbhost, $dbport, $dbuser, $dbpass) {
		if(!$dbhost) {
			self::halt('dbhost not defined');
		}
		self::$conn = mysql_connect($dbhost.':'.$dbport, $dbuser, $dbpass);
		if(!self::$conn) {
			self::halt('mysql connect failed : '.mysql_error());
		}
	}
	
	/**
	 * @abstract 选择数据库
	 */
	public static function selectDb($dbname) {
		if (!$dbname) {
			self::halt('db name not defined');
		}
		if(!mysql_select_db($dbname, self::$conn)) {
			self::halt('mysql select db failed : '.mysql_error());
		}
	}
	
	/**
	 * @abstract 关闭函数
	 */
	public static function close() {
		mysql_close(self::$conn);
	}
	
	/**
	 * @abstract 执行sql
	 */
	public static function query($sql) {
		if (!$sql || !self::$conn) {
			return false;
		}
		$query = mysql_query($sql, self::$conn);
		if (!$query) {
			self::halt('SQL 错误 ： '.$sql);
		}
		self::$queryNum++;
		return $query;
	}
	
	/**
	 * @abstract 取一条
	 */
	public static function getRow($sql) {
		$resource = self::query($sql);
		if(!$resource) {
			return false;
		}
		$row = mysql_fetch_assoc($resource);
		self::free($resource);
		return $row;
	}
	
	/**
	 * @abstract 取多条
	 */
	public static function getRows($sql) {
		$resource = self::query($sql);
		if(!$resource) {
			return false;
		}
		$rows = array();
		while ($row = mysql_fetch_assoc($resource)) {
			$rows[] = $row;
		}
		self::free($resource);
		return $rows;
	}
	
	/**
	 * @abstract 取一个
	 */
	public static function getOne($sql) {
		$row =self::getRow($sql);
		if (!is_array($row)) {
			return false;
		}
		return array_shift($row);
	}
	
	/**
	 * @abstract 取一组
	 */
	public static function getCol($sql) {
		$rows = self::getRows($sql);
		if (!is_array($rows)) {
			return false;
		}
		$data = array();
		foreach ($rows as $v) {
			$data[] = array_shift($v);
		}
		return $data;
	}
	
	/**
	 * @abstract 取总数
	 */
	public static function getCount($table, $cond = null) {
		if (!$table) {
			return false;
		}
		$sql = "SELECT COUNT(*) FROM `{$table}`";
		if (null != $cond) {
			$sql .= " WHERE {$cond}";
		}
		return self::getOne($sql);
	}
	
	/**
	 * @abstract 插入
	 */
	public static function insert($table, $data, $id = false, $i = false) {
		if (!$table) {
			return false;
		}
		if(!is_array($data)) {
			return false;
		}
		$field = array();
		$value = array();
		$set = array();
		foreach ($data as $k => $v) {
			$field[] = $k;
			$value[] = $v;
			$set[] = "`{$k}`='{$v}'";
		}
		$field = "`".join("`,`", $field)."`";
		$value = "'".join("','", $value)."'";
		$sql = "INSERT INTO `{$table}` ({$field}) VALUES ({$value})";
		if ($i) {
			$sql .= " ON DUPLICATE KEY UPDATE ".join(',', $set);
		}
	    if (self::query($sql)) {
			return $id ? self::insertId() : true;
		} else {
			return false;
		}
	}
	
	/**
	 * @abstract 更新
	 */
	public static function update($table, $data, $cond, $limit = null) {
		if (!$table) {
			return false;
		}
		$set = array();
		foreach ($data as $k => $v) {
			$set[] = "`{$k}`='{$v}'";
		}
		if (empty($set)) {
			return false;
		}
		$sql = "UPDATE `{$table}` SET ".join(',', $set)." WHERE {$cond}";
		if ($null != $limit) {
			$sql .= " LIMIT {$limit}";
		}
		if(self::query($sql)) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * @abstract 上次插入的id
	 */
	public static function insertId() {
		return mysql_insert_id(self::$conn);
	}
	
	/**
	 * @abstract 影响的记录数
	 */
	public static function affectRows() {
		return mysql_affected_rows(self::$conn);
	}
	
	/**
	 * @abstract 结果集的数目
	 */
	public static function numRows($resource) {
		if (!is_resource($resource)) {
			return false;
		}
		return mysql_num_rows($resource);
	}
	
	/**
	 * @abstract 释放结果集
	 */
	public static function free($resource) {
		if (!is_resource($resource)) {
			return false;
		}
		return mysql_free_result($resource);
	}
	
	/**
	 * @abstract 出错中断
	 */
    public static function halt($message = null) {
    	exit($message);
	}
}