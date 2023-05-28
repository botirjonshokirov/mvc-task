<?php

namespace application\core;

use application\core\View;
use application\lib\Utils;

abstract class Controller {
	private $route;
	public $view;
	public $model;
	protected $utils;

	public function __construct($route){
		$this->route = $route;
		$utils = new Utils();
		$this->utils = $utils;
		$this->view = new View($route, $utils);

		$this->model = $this->loadModel($route['controller']);
	}

	private function loadModel($modelName) {
		$modelPath = 'application\models\\'.ucfirst($modelName). 'Model';
		if(class_exists($modelPath)) return new $modelPath;
	}
}