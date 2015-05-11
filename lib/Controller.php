<?php
abstract class Controller extends Instance {

	public function getViewPath() {
		$reflector = new ReflectionClass(get_class($this));
		return realpath(dirname($reflector->getFileName()) . '/../view') . '/';
	}

	public function getView($view, $vars) {
		extract($vars);
		ob_start();
		include($this->getViewPath() . $view . '.php');
		$content = ob_get_contents();
		ob_end_clean();
		return $content;
	}

}