<?php
class Database extends Instance {

	public $prefix;

	private $connection = NULL;
	private $host;
	private $user;
	private $pass;
	private $db;
	private $charset;
	private $collate;
	private $query_list;
	private $query_result = NULL;

	public function __construct($host, $user, $pass, $db, $prefix, $charset, $collate) {
		$this->host = $host;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;
		$this->charset = $charset;
		$this->collate = $collate;
		$this->prefix = $prefix;

		$this->query_list = array();
	}

	private function connect() {
		$this->connection = mysql_connect($this->host, $this->user, $this->pass) or die($this->getError());
		mysql_select_db($this->db, $this->connection) or die($this->getError());
	}

	// error constructor
	public function getError() {
		return mysql_error($this->connection) . ' ' . mysql_error($this->connection);
	}

	// execute query
	public function query($q) {
		if(is_null($this->connection)) {
			$this->connect();
		}

		$this->query_list[] = $q;
		$this->query_result = mysql_query($q) or die($this->getError());
		return $this->query_result;
	}

	public function fetch($r = NULL, $type = '') {
		if (is_null($r) && !is_null($this->query_result)) {
			$r = $this->query_result;
		}
		if (is_null($r)) {
			return false;
		}
		$func_type = array('assoc', 'array', 'object', 'row', 'field', 'length');
		$type = ($type != '' && in_array($type, $func_type)) ? $type : $func_type[0];
		return call_user_func_array('mysql_fetch_' . $type, array($r));
	}

	public function select($table_name, $params = array()) {
		$default_params = array(
			'fields' => '*',
			'where' => '',
			'group' => '',
			'order' => '',
			'limit' => '',
		);
		$params = array_merge($default_params, $params);
		$q = "SELECT " . $params['fields'] . " FROM `" . $this->prefix . $table_name . "`";
		if ($params['where'] != '') {
			$q .= " WHERE " . $params['where'];
		}
		if ($params['group'] != '') {
			$q .= " GROUP BY " . $params['group'];
		}
		if ($params['order'] != '') {
			$q .= " ORDER BY " . $params['order'];
		}
		if ($params['limit'] != '') {
			$q .= " LIMIT " . $params['limit'];
		}
		$results = array();
		$r = $this->query($q);
		while ($f = $this->fetch()) {
			$results[] = $f;
		}
		return $results;
	}

	public function getInsertId() {
		return mysql_insert_id($this->connection);
	}

	public function insert($table_name, $fields) {
		$fields_list = array();
		foreach ($fields as $key => $val) {
			$fields_list[] = "`" . $key . "`='" . $val . "'";
		}
		$q = "INSERT INTO `" . $this->prefix . $table_name . "` SET " . implode(', ', $fields_list);
		$this->query($q);
		return $this->getInsertId();
	}

	public function update($table_name, $fields, $where = '') {
		$fields_list = array();
		foreach ($fields as $key => $val) {
			$fields_list[] = "`" . $key . "`='" . $val . "'";
		}
		$q = "UPDATE `" . $this->prefix . $table_name . "` SET " . implode(', ', $fields_list);
		if ($where != '') {
			$q .= " WHERE " . $where;
		}
		$this->query($q);
	}

	public function delete($table_name, $where = '') {
		$q = "DELETE FROM `" . $this->prefix . $table_name . "`";
		if ($where != '') {
			$q .= " WHERE " . $where;
		}
		$this->query($q);
	}

}