<?php
namespace App\Controllers;

use App\Models\Router;

class Menus extends Router
{
	protected $user;

	public function __construct()
	{
		//$this->user = $this->getAdminStatus();
	}

	public function index()
	{

	}

	public function add($add)
	{
		$array = array(
			'file' => 'views/Menus/add.php',
		);

		/*
		if($this->user >= 9999)
		{
			if($add[0])
			{
				$post = new PostController(file_get_contents('php://input'));
				$post = $post->getJson();

				$id = uniqid();
				$title = $post->title;
				$desc = isset($post->desc) ? $post->desc : null;
				$link = $post->link;
				$weight = isset($post->weight) ? $post->weight : 0;
				$category = isset($post->cate) ? $post->cate : null;

				if(isset($title) && !empty($title) && isset($link) && !empty($link))
				{
					$insert = $this->insert('menus', array(
						'id_menu, name_menu, description_menu, weight_menu, link_menu',
						':id, :name, :desc, :weight, :link'
					),
						array(
							':id' => $id,
							':name' => $title,
							':desc' => $desc,
							':weight' => $weight,
							':link' => $link
						));
				}

			}
			$this->json_output($array);
		} else
		{
			print "grade error";
		}

		*/


		//var_dump($categories);
	}

	public function edit($menu)
	{
		$array = array(
			'file' => 'views/Menus/edit.php',
		);

		$menus = $this->select('menus', null, array('*'))
			->execute()
			->getData('all', 'obj');

		$array = array_merge($array, array('menus' => $menus));

		if($this->user >= 9999)
		{
			if($menu[0])
			{
				$menu_selected = $this->select('menus', null, array('*'))
					->operator('WHERE')
					->condition(array('id_menu', '=', ':id'))
					->prepared(array('id' => $this->escapeString($menu[0])))
					->getData('fetch', 'obj');

				$array = array_merge($array, array('menu' => $menu_selected));

				$edit = file_get_contents('php://input');

				if(!empty($edit))
				{
					$post = new PostController($edit);
					$post = $post->getJson();

					$id = $post->id_menu;
					$name = $post->name_menu;
					$desc = isset($post->description_menu) ? $post->description_menu : null;
					$weight = isset($post->weight_menu) ? $post->weight_menu : 0;
					$link = $post->link_menu;

					if(!empty($name) && !empty($link) && !empty($id))
					{
						$update = $this->update('menus', array(
							'name_menu' => ':name',
							'description_menu' => ':desc',
							'weight_menu' => ':weight',
							'link_menu' => ':link'
						))
							->operator('WHERE')
							->condition(array('id_menu', '=', ':id'))
							->prepared(array(
								'name' => $name,
								'desc' => $desc,
								'weight' => $weight,
								'link' => $link,
								'id' => $id
							));

						$array = array_merge($array, array('update' => $update->statement));
					}
				}
			}
			$this->json_output($array);
		} else
		{
			print "grade error";
		}
	}
}