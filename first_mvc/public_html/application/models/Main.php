<?php

namespace application\models;

use application\core\Model;

class Main extends Model
{
	public function getNews()
	{
		$result = $this->db->row('SELECT title, description FROM news');
		return $result;
	}
	
	public $error;
	
	public function contactValidate($post)
	{
		$nameLen = iconv_strlen($post['name']);
		$textLen = iconv_strlen($post['text']);
		
		if ($nameLen < 3 || $nameLen > 20)
		{
			$this->error = 'Имя должно содержать от 3 до 20 символов.';
			return false;
		}
		else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL))
		{
			$this->error = 'Указан неверный e-mail адрес.';
			return false;
		}
		else if ($textLen < 10 || $textLen > 500)
		{
			$this->error = 'Сообщение должно содержать от 10 до 500 символов.';
			return false;
		}
		return true;
	}
	
	function postsCount()
	{
		return $this->db->column('SELECT COUNT(id) FROM posts');
	}
	
	function postsList($route)
	{
		$max = 10;
		$params = [
			'max' => $max,
			'start' => (($route['page'] ?? 1) - 1) * $max,
		];
		return $this->db->row('SELECT * FROM posts ORDER BY id DESC LIMIT :start, :max', $params);
	}
}