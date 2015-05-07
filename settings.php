<?php
function __autoload($class_name) {
	include_once PATHLIB . $class_name . '.php';
}

$routes = array(
	'frontend' => array('get', '/', function() {
		echo 'this is frontend';
	}),

	'backend' => array('get', '/admin', function() {
		echo 'this is backend';
	}),

	'category' => array('get', '/category', function() {
		echo 'this is category';
	}),

	'categoryItem' => array('get', '/category/\d*', function($id) {
		echo 'this is category ITEM ' . $id;
	}),
);

Application::setDB(new Database(DBHOST, DBUSER, DBPASSWORD, DBNAME, DBTABLEPREFIX, DBCHARSET, DBCOLLATE));
Application::setSession(new Session());
Application::setRouter(new Router($routes));

$router = Application::get('router');
$router->run();