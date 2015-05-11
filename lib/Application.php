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

		if(isset(self::$vars['router'])) {
			$match = self::$vars['router']->match();print_r($match);
			self::executeRouter($match);
		}
	}

	private static function executeRouter($match) {
		if($match !== false) {
			if(is_callable( $match['target'] )) {
				call_user_func($match['target']);
			} else {
				$target = explode('/', $match['target']);
				$moduleName = $target[0] ? $target[0] : DEFAULTMODULE;
				$controllerName = ($target[1] ? $target[1] : DEFAULTCONTROLLER) . Controller;
				$actionName = 'action' . ucfirst($target[2] ? $target[2] : DEFAULTACTION);
				include_once(PATHMOD . $moduleName . '/controller/' . $controllerName . '.php');
				$controller = new $controllerName();
				call_user_func_array(array($controller, $actionName), $match['params']);
			}
		}
	}

	public static function get($var) {
		return self::$vars[$var];
	}

}