<?php
namespace App\Controllers;

use App\Models\Router;

class Admin extends Router
{
	protected $user;

	public function __construct()
	{
		$this->user = $this->getSession('id_user');
		$this->userAdmin();
	}

	private function checkUser()
	{
		
	}

	public function login()
	{
		$array = array(
			'title' => 'Page de connexion',
			'class_tpl' => 'login',
		);

		$post = $this->treatData();

		if(!empty($post))
		{
			$user = $this->select(array('*'))
				->from('users', 'us')
				->join('grades', 'gr')
				->using('id_grade')
				->where('email_user', '=', $post->email)
				->query()
				->fetch('fetch', 'obj');

			if($user)
			{
				$check = password_verify($post->password, $user->password_user);

				if($check)
				{
					$this->setSession('id_user', $user->id_user);
					$this->setSession('grade', $user->power_grade);
				}
			}
		}

		$this->render($array);
	}
	public function index()
	{
		$array = array(
			'title'   => 'Panel administratif',
			'scripts' => array(
				$this->load_script('admin.js', 'admin'),
				$this->load_script('add.js', 'articles'),
				$this->load_script('add.js', 'categories'),
				$this->load_script('edit.js', 'categories'),
				$this->load_script('add.js', 'menus'),
				$this->load_script('edit.js', 'menus'),
			),
		);

		$this->render($array);
	}

	public function getCategories()
	{
		$categories = $this->select(array('*'))
			->from('categorie')
			->query()
			->fetch('all', 'obj');
		
		return $categories;
	}
	public function structure(string $arg, $args)
	{
		$array = array(
			'title' => 'Gestion des menus',
			'tpl' => 'views/'.ucfirst($arg).'/'.$args[0].'.php',
		);
		switch($arg)
		{
			case 'menus':
				switch($args[0])
				{
					case 'add':
						if($this->treatData())
						{
							$post = $this->treatData();

							$form = array(
								'title' => $post->menu_title,
								'description' => $post->menu_desc,
								'link' => $post->menu_link,
								'weight' => $post->menu_weight,
								'category' => $post->menu_cate,
							);

							$this->insert('menu', true)
								->values(array(':data'))
								->prepare()
								->setParam(':data', json_encode($form))
								->execute();
						}

						break;
					case 'edit':
						if($this->treatData())
						{
							$post = $this->treatData();

							$form = array(
								'title' => $post->name_menu,
								'description' => $post->description_menu,
								'link' => $post->link_menu,
								'weight' => $post->weight_menu,
							);

							$this->update('menu')
								->set(array('dataMenu' => json_encode($form)))
								->where('idMenu', '=', $post->id_menu)
								->query();
						}

						if(isset($args[1]))
						{
							$selected = $this->select(array('*'))
								->from('menu')
								->where('idMenu', '=', $args[1])
								->query()
								->fetch('fetch', 'obj');

							$array = array_merge($array, array('categorie' => $selected));
						}

						$categories = $this->select(array('*'))
							->from('menu')
							->query()
							->fetch('all', 'obj');

						$array = array_merge($array, array('data' => $categories));

						break;
					case 'delete':
						$this->delete('menu')
							->where('idMenu', '=', $args[1])
							->query();

						header('Location: /admin/structure/menus/edit');
						break;
				}
				break;
			case 'categories' :
				switch($args[0])
				{
					case 'add':
						if($this->treatData())
						{
							$post = $this->treatData();

							$form = array(
								'title' => $post->cate_title,
								'weight' => $post->cate_weight,
								'parent' => $post->cate_parent
							);

							$this->insert('categorie', true)
								->values(array(':data'))
								->prepare()
								->setParam(':data', json_encode($form))
								->execute();
						}

						$categories = $this->select(array('*'))
							->from('categorie')
							->query()
							->fetch('all', 'obj');

						$array = array_merge($array, array('categories' => $categories));
						break;
					case 'edit' :
						if(isset($args[1]))
						{
							$selected = $this->select(array('*'))
								->from('categorie')
								->where('idCategory', '=', $args[1])
								->query()
								->fetch('fetch', 'obj');

							$array = array_merge($array, array('selected' => $selected));
						}

						if($this->treatData())
						{
							$post = $this->treatData();

							var_dump($post);

							$form = array(
								'title' => $post->name,
								'weight' => $post->weight,
							);

							$this->update('categorie')
								->set(array('dataCategory' => json_encode($form)))
								->where('idCategory' , '=', $post->id)
								->query();
						}

						$categories = $this->select(array('*'))
							->from('categorie')
							->query()
							->fetch('all', 'obj');

						$array = array_merge($array, array('edit' => $categories));
						break;
					case 'delete':
						$this->delete('categorie')
							->where('idCategory', '=', $args[1])
							->query();

						header('Location: /admin/structure/categories/edit');
						break;
				}
				break;
		}

		$this->render($array);
	}

	public function content(string $arg, $args)
	{
		$array = array(
			'title' => 'Gestion ' . $arg,
			'tpl' => 'views/'.ucfirst($arg).'/'.$args[0].'.php',
		);

		switch($arg)
		{
			case 'articles':
				switch($args[0])
				{
					case 'add':
						$categories = $this->select(array('*'))
							->from('categorie')
							->query()
							->fetch('all', 'obj');

						$array = array_merge($array, array('categories' => $categories));
						if($this->treatData())
						{
							$post = $this->treatData();

							$this->insert('articles', true)
								->values(array(':title, :description, :text, :author, :cate'))
								->prepare()
								->setParam(':title', $post->title_article)
								->setParam(':description', $post->desc_article)
								->setParam(':text', $post->text_article)
								->setParam(':author', $post->author_article)
								->setParam(':cate', $post->cate_article)
								->execute();
						}
						break;
					case 'edit':
						if(isset($args[1]))
						{
							$selected = $this->select(array('*'))
								->from('articles', 'art')
								->join('categorie', 'cat')
								->on('art.category_article', 'cat.idCategory')
								->where('id_article', '=', $this->escapeString($args[1]))
								->query()
								->fetch('fetch', 'obj');

							$array = array_merge($array, array('selected' => $selected));
						}

						if($this->treatData())
						{
							$post = $this->treatData();

							$this->update('articles')
								->set(array('title_article' => ':title',
								            'description_article' => ':desc',
								            'text_article' => ':text'))
								->where('id_article', '=', ':id')
								->prepare()
								->setParam(':title', $post->title)
								->setParam(':desc', $post->description)
								->setParam(':text', $post->text)
								->setParam(':id', $post->id)
								->execute();
						}

						$articles = $this->select(array('*'))
							->from('articles')
							->query()
							->fetch('all', 'obj');

						$array = array_merge($array, array('articles' => $articles));
						break;
					case 'delete' :
						if(isset($args[1]))
						{
							$this->delete('articles')
								->where('id_article', '=', $this->escapeString($args[1]))
								->query();

							header('Location: /admin/content/articles/edit');
						}
						break;
				}
				break;
		}

		$this->render($array);
	}

	public function reports(string $event = null, $args)
	{
		$errors = $this->select(array('*'))
			->from('Error')
			->query()
			->fetch('all', 'obj');

		$array = array(
			'title' => 'Administration : Liste des erreurs',
			'class_tpl' => 'errors',
			'errors' => $errors,
		);

		if(!is_null($event))
		{
			$error = $this->select(array('*'))
				->from('Error')
				->where('idError', '=', $args[0])
				->query()
				->fetch('fetch', 'obj');
			
			$array = array_merge($array, array('error_selected' => $error));
		}

		$this->render($array);
	}
}