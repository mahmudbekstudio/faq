<?php
class defaultController extends Controller {

	public function actionIndex() {
		echo 'default index';
	}

	public function action404() {
		return $this->getView('404', array('name' => 'test'));
	}

}