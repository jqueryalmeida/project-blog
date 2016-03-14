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
			if(isset($_POST) && !empty($_POST))
			{
				$post = new PostController($_POST);
				$post = $post->getJson();

				$id = uniqid();
				$name = $post->cate_title;
				$desc = '';
				$weight = (int) $post->cate_weight;

				$this->insert('categories',
						array('id_category, name_category, description_category, weight_category', ':id, :name, :desc, :weight'),
						array(
								':id' => $id,
								':name' => $name,
								':desc' => $desc,
								':weight' => $weight
						));

			}
			$this->json_output($array);
		}else
		{
			print "false grade";
		}
	}

	public function edit()
	{
		$array = array(
			'file' => 'views/Categories/edit.php',
		);

		if($this->user >= 9999)
		{
			$this->json_output($array);
		} else
		{
			print "false grade";
		}
	}
}