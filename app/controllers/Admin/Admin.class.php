<?php
namespace App\Controllers;

use App\Models\Router;

class Admin extends Router
{
	protected $user = FALSE;

	public function __construct()
	{
		$this->user = $this->getSession('id_user');
		$this->userAdmin();
	}

	private function checkUser()
	{
		$this->login();
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

					$this->user = TRUE;

					header('Location: /admin');
				}
			}
		}

		$this->render($array);
	}
	public function index()
	{
		if($this->user)
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
		else
		{
			$this->checkUser();
		}
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
		if($this->user)
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
								);

								$adding = $this->insert('menu', true)
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
									->values(array(':data, :name'))
									->prepare()
									->setParam(':data', json_encode($form))
									->setParam(':name', $post->cate_title)
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

			$this->render($array, null);
		}
		else
		{
			$this->checkUser();
		}
	}

	public function content(string $arg, $args)
	{
		if($this->user)
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
		else
		{
			$this->checkUser();
		}
	}

	public function reports(string $event = null, $args)
	{
		if($this->user)
		{
			$array = array();

			$errors = $this->select(array('*'))
				->from('Error')
				->query()
				->fetch('all', 'obj');

			$array = array(
				'title' => 'Administration : Liste des erreurs',
				'class_tpl' => 'errors',
			);

			if(!is_null($event))
			{
				switch ($event)
				{
					case 'event':
						$error = $this->select(array('*'))
							->from('Error')
							->where('idError', '=', $args[0])
							->query()
							->fetch('fetch', 'obj');

						$array = array_merge($array, array('error_selected' => $error));
						break;
					case 'delete' :
						$this->truncate('Error')
							->query();

						header('Location: /admin/reports');
						break;
				}
			}

			$array = array_merge($array, array('errors' => $errors));

			$this->render($array);
		}
		else
		{
			$this->checkUser();
		}
	}

	public function skills(string $event = null, $args = null)
	{
		$array = array(
			'title' => 'Gestion des compétences',
			'class_tpl' => 'skills',
			'case' => $this->escapeString($event),
			'scripts' => array('admin/admin.js'),
		);

		if($this->user)
		{
			switch($event)
			{
				case 'add':
					$post = $this->treatData();

					if(!empty($post))
					{
						if(!empty($post->skill_name) && !empty($post->level_skill))
						{
							$form = array(
								'name' => $post->skill_name,
								'level' => $post->level_skill,
							);

							$skill = $this->insert('skills', true)
								->values(array(':data, :name'))
								->prepare()
								->setParam(':data', json_encode($form))
								->setParam(':name', $post->skill_name)
								->execute();

							$array = array_merge($array, array('status' => $skill->_statement, 'ajax' => true));
						}
					}
					break;
				case 'edit':
					$post = $this->treatData();

					if(!empty($post))
					{
						$form = $form = array(
							'name' => $post->name_skill,
							'level' => $post->level_skill,
						);

						$update = $this->update('skills')
							->set(array('dataSkill' => json_encode($form), 'nameSkill' => $post->name_skill))
							->where('idSkill', '=', $post->id_skill)
							->query();

						$array = array_merge($array, array('status' => $update->_statement, 'ajax' => true));

					}

					if(isset($args[0]))
					{
						$skill = $this->select(array('*'))
							->from('skills')
							->where('idSkill', '=', $this->escapeString($args[0]))
							->query()
							->fetch('fetch', 'obj');

						$array = array_merge($array, array('selected' => $skill));

					}

					$skills = $this->select(array('*'))
						->from('skills')
						->query()
						->fetch('all', 'obj');

					$array = array_merge($array, array('skills' => $skills));
					break;
				case 'delete':
					if(isset($args[0]))
					{
						$this->delete('skills')
							->where('idSkill', '=', $this->escapeString($args[0]))
							->query();

						header('Location: /admin/skills/edit');
					}
					break;
				default :
					break;
			}
		}
		else
		{
			$this->checkUser();
		}

		$this->render($array);
	}

	public function experiences(string $event = null, $args = null)
	{
		if($this->user)
		{
			$array = array(
				'title' => 'Gestion des expériences',
				'class_tpl' => 'experiences',
				'scripts' => array('admin/admin.js'),
				'case' => $this->escapeString($event),
			);

			try
			{
				switch($event)
				{
					case 'add' :
						$post = $this->treatData();

						if(!empty($post))
						{
							$time = date_diff(date_create($post->begin_exp), date_create($post->end_exp));

							$form = array(
								'name' => $post->name_job,
								'enterprise' => $post->name_entreprise,
								'begin' => $post->begin_exp,
								'end' => $post->end_exp,
								'details' => $post->description_exp,
								'contrat' => $post->contrat,
								'dureeContrat' => array(
									'year' => $time->y,
									'months' => $time->m,
									'days' => $time->d
								),
							);
							
							$add = $this->insert('experiences', true)
								->values(array(':data, :name'))
								->prepare()
								->setParam(':data', json_encode($form))
								->setParam(':name', $post->name_job)
								->execute();

							$array = array_merge($array, array('status' => $add->_statement, 'ajax' => true));
						}
						break;
					case 'edit' :
						break;
					default :
						throw new \Exception('Not in possibilities');
				}
			}
			catch(\Exception $e)
			{
				$this->error($e, 'php_error');
			}

			$this->render($array);
		}
		else
		{
			$this->checkUser();
		}
	}
}