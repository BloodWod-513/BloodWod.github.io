<?php

namespace application\core;

class View
{
	public $path;
	public $layout = 'default';
	public $route;
	
	
	public function __construct($route)
	{
		$this->route = $route;
		$this->path = $route['controller'].'/'.$route['action'];
	}
	
	public function render($title, $vars = [])
	{
		extract($vars);
		ob_start();
		require 'application/views/'.$this->path.'.php';
		$content = ob_get_clean();
		require 'application/views/layouts/'.$this->layout.'.php';
		// if (file_exists('application/views/'.$this->path.'.php'))
		// {
			// ob_start();
			// require 'application/views/'.$this->path.'.php';
			// $content = ob_get_clean();
			// require 'application/views/layouts/'.$this->layout.'.php';
		// }
		// else
		// {
			// echo 'Вид не найден: '.$this->path;
		// }
	}
	
	public function redirect($url)
	{
		header('Location: '.$url);
		exit;
	}
	
	public static function errorCode($code)
	{
		http_response_code($code);
		$path = 'application/views/errors/'.$code.'.php';
		if(file_exists($path))
		{
			require $path;
		}	
		exit;
	}
	
	public function message($status, $message)
	{
		exit(json_encode(['status' => $status, 'message' => $message]));
	}
	
	public function redirectjs($url)
	{
		exit(json_encode(['url' => $url]));
	}
}