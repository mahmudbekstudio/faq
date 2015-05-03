<?php
class Application {

	private static $vars;

	public static function setDB($db) {
		self::$vars['db'] = $db;
	}

	public static function getDB() {
		return self::$vars['db'] || false;
	}

	public static function run($debug) {
		self::$vars['debug'] = $debug;
	}

}