<?php
namespace App\Controllers;

use App\Models\Model;
use App\Models\Router;

class Members extends Router
{
	use Model;

	public function __construct()
	{
	}

	public function index()
	{
	}

	public function register($register_data)
	{

	}

	public function login()
	{
		$post = $this->treatData();
		$array = array();

		if(isset($post) && !empty($post))
		{
			$email = $this->preg('/@/i', $post->pseudo);

			//var_dump($email);

			if($email)
			{
				$user = $this->select(array('*'))
					->from('users', 'us')
					->join('grades', 'gr')
					->using('id_grade')
					->where('email_user', '=', $post->pseudo)
					->query()
					->fetch('fetch', 'obj');

				if(!empty($user))
				{
					$check_password = password_verify($post->password, $user->password_user);

					if($check_password)
					{
						$array = array_merge($array, array('status' => true));
					}
					else
					{
						$array = array('status' => false);
					}
				}
			}
			else
			{
				$user = $this->select(array('*'))
					->from('users', 'us')
					->join('grades', 'gr')
					->using('id_grade')
					->where('pseudo_user', '=', $post->pseudo)
					->query()
					->fetch('fetch', 'obj');

				if(!empty($user))
				{
					$check_password = password_verify($post->password, $user->password_user);

					if($check_password)
					{
						$array = array('status' => true);
					}
					else
					{
						$array = array('status' => false);
					}
				}
			}

			if(isset($check_password) && $check_password)
			{
				$this->setSession('pseudo', $user->pseudo_user);
				$this->setSession('grade', $user->power_grade);
				//$this->setSession('pseudo', $user->pseudo_user);
			}
			$this->json_output($array);
		}
	}

	public function edit($id_user)
	{

	}
}