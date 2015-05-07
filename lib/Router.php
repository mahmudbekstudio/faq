<?php
class Router extends Instance {

	private $uri;
	private $method;
	private $routes = array();
	private $basePath;
	private $patterns = array();

	public function __construct($routes) {
		$this->uri = $_SERVER['REQUEST_URI'];
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->setRoutes($routes);
	}

	public function setRoutes($routes) {
		foreach($routes as $route) {
			$this->map($route[0], $route[1], $route[2]);
		}
	}

	public function map($method, $route, $target) {
		$this->routes[] = array($method, $route, $target);
	}

	public function run() {
		foreach($this->routes as $route) {
			if($route[0] = $this->method && preg_match('/' . str_replace('/', '\/', '^' . $route[1] . '$') . '/', $this->uri, $match)) {
				$route[2]($match[0]);
			}
		}
	}

}