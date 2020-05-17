<?php

namespace application\core;

use application\core\View;

abstract class Controller
{
	public $route;
	public $view;
	public $acl;
	
	public function __construct($route)
	{
		$this->route = $route;
		if(!$this->checkAcl())
		{
			View::errorCode(403);
		}
		$this->view = new View($route);
		$this->model = $this->loadModel($route['controller']);
	}
	
	public function loadModel($name)
	{
		$path = 'application\models\\'.ucfirst($name);
		if(class_exists($path))
		{
			return new $path;
		}
	}
	
	public function checkAcl()
	{
		$this->acl = require 'application/acl/'.$this->route['controller'].'.php';
		if($this->isAcl('all'))
		{
			return true;
		}
		else if($this->isAcl('authorize') && isset($_SESSION['authorize']['id']))
		{
			return true;
		}
		else if(!$this->isAcl('authorize') && isset($_SESSION['guest']['id']))
		{
			return true;
		}
		else if($this->isAcl('admin') && isset($_SESSION['admin']))
		{
			return true;
		}
		return false;
	}
	
	public function isAcl($key)
	{
		return in_array($this->route['action'], $this->acl[$key]);
	}
}