<?php
class Index extends \Application\Core\Router
{
	public function __construct()
	{
		Core\Database\ConnectionDB::__construct();
	}

	public function index()
	{
		$array = array(
			'title' => 'title',
		);

		$this->render($array);
	}
}