<?php
class Categories extends \Application\Core\Router
{
	protected $user = 0;

	public function __construct()
	{
		\Core\Database\ConnectionDB::__construct();
		$this->user = $this->checkUserGrade();
	}
	public function index()
	{

	}

	public function add()
	{
		$array = array(
			'file' => 'views/Categories/add.php',
		);

		if($this->user >= 9999)
		{
			$cate = $this->select('categories', null, array('*'))
					->order('weight_category', 'ASC')
					->execute()
					->getData('all', 'obj');

			$array = array_merge($array, array('categories' => $cate));
			if(isset($_POST) && !empty($_POST))
			{
				$post = new PostController($_POST);
				$post = $post->getJson();

				$id = uniqid();
				$name = $post->cate_title;
				$desc = '';
				$weight = (int) $post->cate_weight;
				!empty($post->cate_parent) ? $parent = $post->cate_parent : $parent = null;

				if(!empty($id) && !empty($name))
				{
					$insert = $this->insert('categories',
							array('id_category, name_category, description_category, weight_category, parent_category', ':id, :name, :desc, :weight, :parent'),
							array(
									':id' => $id,
									':name' => $name,
									':desc' => $desc,
									':weight' => $weight,
									':parent' => $parent,
							));

					if($insert)
					{
						$this->status = array(
							'insert' => TRUE,
						);
					} else
					{
						$this->status = array(
							'insert' => FALSE,
						);
					}

					$this->status = array(
						'error' => FALSE,
					);
				} else
				{
					$this->status = array(
						'error' => TRUE,
					);
				}
			}

			$array = array_merge($array, $this->status);
			$this->json_output($array);
		}else
		{
			print "false grade";
		}
	}

	public function edit($selected = null)
	{
		if($this->user >= 9999)
		{
			$cate = $this->select('categories', null, array('*'))
				->order('weight_category', 'ASC')
				->execute()
				->getData('all', 'obj');

			$array = array(
				'file' => 'views/Categories/edit.php',
			);

			if(!empty($selected))
			{
				$select = $this->select('categories', null, array('*'))
					->operator('WHERE')
					->condition(array('id_category', '=', ':id'))
					->prepared(array('id' => $selected[0]))
					->getData('fetch', 'obj');

				$array = array_merge($array, array('category' => $select));
			}

			$array = array_merge($array, array('categories' => $cate));

			$edit = file_get_contents('php://input');

			if(!empty($edit))
			{
				$post = new PostController(json_decode($edit));
				$post = $post->getJson();

				$id = $post->id_category;
				$name = $post->name_category;
				$weight = (int) $post->weight_category;

				$update = $this->update('categories', array(
					'name_category' => ':name',
					'weight_category' => ':weight'
				))
				->operator('WHERE')
				->condition(array('id_category', '=', ':id'))
				->prepared(array(
					'name' => $name,
					'weight' => $weight,
					'id' => $id
				));

				$array = array_merge($array, array('status' => $update->statement));
			}

			$this->json_output($array);
		} else
		{
			print "false grade";
		}
	}

	public function delete($id)
	{
		$this->del('categories', array('id_category = :id'))
			->prepared(array('id' => $id[0]));
	}
}