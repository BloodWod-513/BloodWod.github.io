<?php

namespace application\controllers;

use application\core\Controller;
use application\lib\Pagination;
use application\models\Main;

class AdminController extends Controller
{
	
	public function __construct($route)
	{
		parent::__construct($route);
		$this->view->layout = 'admin';
		
	}
	
	public function loginAction()
	{
		if(isset($_SESSION['admin']))
		{
			$this->view->redirect('add');
		}
		if(!empty($_POST))
		{
			if(!$this->model->loginValidate($_POST))
			{
				$this->view->message('Error', $this->model->error);
			}
			$_SESSION['admin'] = true;
			$this->view->redirectjs('first_mvc/public_html/admin/add');
		}
		$this->view->render('Вход');		
	}	
	
	public function addAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->postValidate($_POST, 'add'))
			{
				$this->view->message('Error', $this->model->error);
			}
			$id = $this->model->postAdd($_POST);
			if(!$id)
			{
				$this->view->message('error', 'Ошибка обработки запроса');
			}
			$this->model->postUploadImage($_FILES['img']['tmp_name'], $id);
			$this->view->message('Succes', 'Пост добавлен!');
		}

		$this->view->render('Добавить пост');
	}
	
	public function editAction()
	{
		if(!$this->model->isPostExists($this->route['id']))
		{
			$this->view->errorCode(404);
		}
		if(!empty($_POST))
		{
			if(!$this->model->postValidate($_POST, 'edit'))
			{
				$this->view->message('Error', $this->model->error);
			}
			$this->model->postEdit($_POST, $this->route['id']);
			if($_FILES['img']['tmp_name'])
			{
				$this->model->postUploadImage($_FILES['img']['tmp_name'], $this->route['id']);
			}
			$this->view->message('Succes', 'ok');
		}
		$vars = [
			'data' => $this->model->postData($this->route['id'])[0],
		];
		$this->view->render('Редактировать пост', $vars);
	}
	
	public function deleteAction()
	{
		if(!$this->model->isPostExists($this->route['id']))
		{
			$this->view->errorCode(404);
		}
		$this->model->postDelete($this->route['id']);
		$this->view->redirect('/first_mvc/public_html/admin/posts');
	}
	
	
	public function logoutAction()
	{
	unset($_SESSION['admin']);
	$this->view->redirect('login');
	}
	
	public function postsAction()
	{
		$mainModel = new Main;
		$pagination = new Pagination($this->route, $mainModel->postsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $mainModel->postsList($this->route),
		];
		$this->view->render('Списпок постов', $vars);
	}
}