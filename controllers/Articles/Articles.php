<?php
class Articles extends \Application\Core\Router
{
	protected $user = false;

	public function __construct()
	{
		Core\Database\ConnectionDB::__construct();
		$this->user = $this->checkUserGrade();
	}

	public function index()
	{

	}

	public function add()
	{
		$array = array(
				'file' => 'views/Articles/add.php',
		);

			if($this->user >= 9999)
			{
				$data = file_get_contents('php://input');

				//$post = new PostController($data);

				$this->json_output($array);
			} else {
				print 'false';
			}
	}
}