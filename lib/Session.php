<?php
class Session {

	private $space;

	public function __construct($space = 'session') {
		self::start();
		$this->space = $space . session_id();
		$this->destroy();
	}

	public function start() {
		if (!session_id()) {
			session_start();
		}
	}

	public function check($key) {
		return isset($_SESSION[$this->space][$key]);
	}

	public function remove($key) {
		if ($this->checkSession($key)) {
			unset($_SESSION[$this->space][$key]);
		}
	}

	public function destroy() {
		$_SESSION[$this->space] = array();
	}

	public function set($key, $val) {
		$_SESSION[$this->space][$key] = $val;
	}

	public function get($key) {
		return $_SESSION[$this->space][$key];
	}

}