<?php
class Admin extends \Application\Core\Router
{
	protected $user;

	public function __construct()
	{
		\Core\Database\ConnectionDB::__construct();
		$this->user = $this->getSession('id_user');
	}

	public function getCategories()
	{
		$cat = $this->select('objects', null, array('*'))->execute()->getData('all', 'obj');

		$this->json_output($cat);
	}

	public function index()
	{
		$array = array(
			'title' => 'Panel administratif',
				'menu' => 'menu.admin.tpl.inc',
				'scripts' => array('admin/admin.js'),
		);


		var_dump(json_encode('{attributes : {role:button,class : btn btn-default btn-block}}'), uniqid());
		$this->render($array);
	}
}