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

	public function edit()
	{
		$cate = $this->select('categories', null, array('*'))
				->order('weight_category', 'ASC')
				->execute()
				->getData('all', 'obj');

		$array = array(
			'file' => 'views/Categories/edit.php',
		);

		$array = array_merge($array, array('categories' => $cate));

		if($this->user >= 9999)
		{
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