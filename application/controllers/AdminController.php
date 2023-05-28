<?php

namespace application\controllers;

use application\core\Controller;

class AdminController extends  MainController{

	public function indexAction(){
		if(!isset($_SESSION['logged'])){
			header('Location: /admin/login/');
			exit;
		}

		$sort = isset($_GET['sort']) ? $_GET['sort'] : 'user_name';
		$this->tasks = $this->model->getTasks($this->pageNum, $sort);
		
		$task = isset($_GET['id_edit']) ? $this->model->getTask($_GET['id_edit']) : [];
		
		$pageTitle = isset($this->model->pageTitle) ? $this->model->pageTitle : '';
		$this->view->render($pageTitle, $this->tasks, $this->paginator, $task);
	}

	public function updateAction(){

		if(isset($_POST['update_form'])){
			$task = $_POST['task'];
			$checked = ($_POST['checked'] == 'on') ? 1 : 0;
			$task_id = $_POST['task_id'];
			$sql = "UPDATE tasks SET task = :task, checked = :checked WHERE id = :id";
			$this->model->db->doQuery($sql, ['task'=> $task, 'checked' => $checked, 'id'=> $task_id]);

			header("Location: {$_SERVER['HTTP_REFERER']}");
		}

	}

	public function loginAction($loginError=''){
		$postData = $_POST;

		if(isset($_SESSION['logged'])) {
			header('Location: /admin/index/1/');
			exit;
		}

		if(isset($postData['check_login'])){

			if($postData['login'] == 'admin' && $postData['password'] == '123'){ //todo have to use password_hash
				 $_SESSION['logged'] = true;
				header('Location: /admin/index/1/');
				exit;
			
			} else {
				$loginError =  'Ошибка авторизации!';
				$this->view->render('Login', '','', ['loginError'=>$loginError]);
			}
		} else {
			$this->view->render('Login');
		}
		
	}

	public function logoutAction(){

		if(isset($_SESSION['logged'])) {
			unset($_SESSION['logged']);
		}
		header('Location: /admin/login/');
		exit;
	}
	
}