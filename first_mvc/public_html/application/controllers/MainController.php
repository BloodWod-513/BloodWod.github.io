<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Admin;
use application\lib\Pagination;

class MainController extends Controller
{
	public function indexAction()
	{
		$pagination = new Pagination($this->route, $this->model->postsCount());
		$vars = [
			'pagination' => $pagination->get(),
			'list' => $this->model->postsList($this->route),
		];
		$this->view->render('Главная страница', $vars);		
	}	
	
	public function aboutAction()
	{
		$this->view->render('Обо мне');
	}
	
	public function contactAction()
	{
		if(!empty($_POST))
		{
			if(!$this->model->contactValidate($_POST))
			{
				$this->view->message('Error', $this->model->error);
			}
			mail('email admin', 'Сообщение из блога от: ', $_POST['name'].'| Message:'.$_POST['text'].'| Email'.$_POST['email']);
			$this->view->message('success', 'Сообщение отправлено.');
		}
		$this->view->render('Контакты');
	}
	
	public function postAction()
	{
		$adminModel = new Admin;
		if (!$adminModel->isPostExists($this->route['id'])) {
			$this->view->errorCode(404);
		}
		$vars = [
			'data' => $adminModel->postData($this->route['id'])[0],
		];
		$this->view->render('Пост', $vars);
	}
}