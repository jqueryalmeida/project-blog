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


		//$test = 'test';
		$test = $this->select('test', null, array('*'))->operator('WHERE')->condition(array('id', '=', 1))->execute()->fetch('all', 'fetch');

		var_dump($test);

		$this->render($array);
	}
}