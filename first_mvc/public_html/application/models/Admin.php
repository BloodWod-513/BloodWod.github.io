<?php

namespace application\models;

use application\core\Model;
use SimpleImage;

class Admin extends Model
{
	public $error;
	
	public function loginValidate($post)
	{
		$config = require 'application/config/admin.php';
		if($config['login'] != $post['login'] || $config['password'] != $post['password'])
		{
			$this->error = 'Логин или пароль указан неверно!';
			return false;
		}
		return true;
	}
	
	public function postValidate($post, $type)
	{
		
		$nameLen = iconv_strlen($post['name']);
		$descriptionLen = iconv_strlen($post['description']);
		$textLen = iconv_strlen($post['text']);
		
		if ($nameLen < 3 || $nameLen > 100)
		{
			$this->error = 'Имя должно содержать от 3 до 100 символов.';
			return false;
		}
		else if ($descriptionLen < 3 || $descriptionLen > 100)
		{
			$this->error = 'Опписание должно содержать от 3 до 100 символов.';
			return false;
		}
		else if ($textLen < 10 || $textLen > 5000)
		{
			$this->error = 'Сообщение должно содержать от 10 до 5000 символов.';
			return false;
		}
		
		if($type == 'add' && empty($_FILES['img']['tmp_name']))
		{
			$this->error = 'Изображение не выбрано';
			return false;
		}
		return true;
	}
	
	public function postAdd($post)
	{
		$params = [
			'id' => '',
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		$this->db->query('INSERT INTO posts VALUE (:id, :name, :description, :text)', $params);
		return $this->db->lastInsertId();
	}
	
	public function postEdit($post, $id)
	{
		$params = [
			'id' => $id,
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
		];
		
		$this->db->query('UPDATE posts SET name = :name, description = :description, text = :text WHERE id = :id', $params);	
	}
	
	public function postData($id)
	{
		$params = [
			'id'=> $id,
		];
		return $this->db->row('SELECT * FROM posts WHERE id = :id', $params);		
	}
	
	public function isPostExists($id)
	{
		$params = [
			'id' => $id,
		];
		return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
	}
	
	public function postDelete($id)
	{
		$params = [
			'id' => $id,
		];
		$this->db->query('DELETE FROM posts WHERE id = :id', $params);
		unlink('public/materials/'.$id.'.jpg');
	}
	
	public function postUploadImage($path, $id)
	{
		// $img = new Imagick($path);
		// $img->cropThumbnailImage(1080, 600);
		// $img->setImageCompressionQuality(80);
		// $img->writeImage('public/materials/'.$id.'.jpg');
		// include($_SERVER['DOCUMENT_ROOT'].'/first_mvc/public_html/application/lib/classSimpleImage.php');
		include('classSimpleImage.php');
		$image = new SimpleImage();
	    $image->load($path);
	    $image->resize(1024, 720);
	    $image->save('public/materials/'.$id.'.jpg');
		//move_uploaded_file($path, 'public/materials/'.$id.'.jpg');
	}
}