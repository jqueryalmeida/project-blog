<?php
class Menus extends \Application\Core\Router
{
	protected $user;

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
			'file' => 'views/Menus/add.php',
		);

		$categories = $this->select('categories', null, array('*'))
			->execute()
			->getData('all', 'obj');

		var_dump($categories);

		if($this->user >= 9999)
		{
			if(isset($_POST) && !empty($_POST))
			{
				$post = new PostController($_POST);
				$post = $post->getJson();

				$id = uniqid();
				$title_menu = '';
			}
			$this->json_output($array);
		} else
		{
			print "grade error";
		}
	}

	public function edit()
	{
		$array = array(
			'file' => 'views/Menus/edit.php',
		);

		if($this->user >= 9999)
		{
			$this->json_output($array);
		} else
		{
			print "grade error";
		}
	}
}