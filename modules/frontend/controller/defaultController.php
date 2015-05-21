<?php
class defaultController extends Controller {

	public function actionIndex() {
		return $this->getView('main', array('name' => 'test'));
	}

	public function action404() {
		return $this->getView('404', array('name' => 'test'));
	}

}