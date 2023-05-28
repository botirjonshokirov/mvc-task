<?php

namespace application\core;
 
class Router
{
	private $routers = []; 
	private $params  = []; // actual controller and action
	private $strUrlPage;
	private $pageNum; 
	

	public function __construct() {
		$arrRoutes = require 'application/config/routes.php';
		foreach ($arrRoutes as $key => $value) {
			$this->add($key, $value);
		}
	}

	private function add($route, $params) {
		$route = '#^'.$route.'$#';
		$this->routers[$route] = $params;
	}

	private function match() {
		$strUrl = trim($_SERVER['REQUEST_URI'], '/');
		$arrUrl = explode('/', $strUrl);
		
		if(count($arrUrl) >= 2){

			$arrUrlPage = array_slice($arrUrl, 0, 2);
			$arrPageNum = array_slice($arrUrl, 2, 1);

			$this->strUrlPage = implode('/', $arrUrlPage);
			
			if(isset($arrPageNum[0]) && strpos($arrPageNum[0], '?') === false){
				$this->pageNum = $arrPageNum[0];
			} else $this->pageNum = 1;

			foreach ($this->routers as $route => $params) {
				if(preg_match($route, $this->strUrlPage)){
					$this->params = $params;
					return true;
				}
			}

		}

		return false;
	}

	public function run() {
		if($this->match()){
			$pathCtrl = 'application\controllers\\'.ucfirst($this->params['controller']).'Controller';
			if(class_exists($pathCtrl)){
				$action = $this->params['action'].'Action';
				if(method_exists($pathCtrl, $action)){
					$controller = new $pathCtrl($this->params, $this->pageNum );
					$controller->$action();
				} else {
					echo " $action action not found ";
				}
			} else {
				echo " $pathCtrl controller not find ";
			}
		} else {
			header('Location: /main/index/1');
			exit;
		}
	}
}