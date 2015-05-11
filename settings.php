<?php
function __autoload($class_name) {
	include_once PATHLIB . $class_name . '.php';
}

$routes = array(
	array('GET', '/', 'frontend/default/index', 'home'),
	array('GET', '/search/[*:s]', 'frontend/search/index', 'search'),
	array('GET|POST', '*', 'frontend/default/404', '404')
);

$matchTypes = array();

Application::setDB(new Database(DBHOST, DBUSER, DBPASSWORD, DBNAME, DBTABLEPREFIX, DBCHARSET, DBCOLLATE));
Application::setSession(new Session());
Application::setRouter(new AltoRouter($routes, BASEPATH, $matchTypes));