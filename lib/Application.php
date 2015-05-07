<?php
class Application {

	private static $vars;

	public static function setDB($db) {
		self::$vars['db'] = $db;
	}

	public static function setSession($session) {
		self::$vars['session'] = $session;
	}

	public static function setRouter($router) {
		self::$vars['router'] = $router;
	}

	public static function run($debug) {
		self::$vars['debug'] = $debug;
	}

	public static function get($var) {
		return self::$vars[$var];
	}

}