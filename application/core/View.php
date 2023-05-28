<?php

namespace application\core;
 
class View {
	public $route;
	public $path;
	public $layout = 'default';
	private $utils;

	public function __construct($route, $utils){
		$this->route = $route;
		$this->utils = $utils;
		$this->setPath($route['controller'].'/'.$route['action']);
	}

	public function render($title, $tasks='', $paginator='', $vars=[]){
		$path = $this->path;
		ob_start();
		require 'application/views/'.$this->path.'.php';
		$content = ob_get_clean();
		require 'application/views/layouts/'.$this->layout.'.php';
	}

	public function setPath($path){
		$this->path = $path;
	}
}