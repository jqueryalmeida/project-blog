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
		$name = 'AdminRoot';

		$admin = $this->select('objects', null, array('*'))
				->operator('WHERE')
				->condition(array('name_object', '=', ':name'))
				->prepared(array('name' => $name))
				//->execute()
				->getData('fetch', 'obj');

		$cat = $this->select('objects', 'obj', array('*'))
				->join('attributes', 'attr', 'LEFT')
				->on('id_object', 'id_object')
				->operator('WHERE')
				->condition(array('parent_object', '=', ':parent'))
				->order('weight_object', 'ASC')
				->prepared(array('parent' => $admin->id_object))
				->getData('all', 'obj');

		$this->json_output($cat);
	}

	public function index()
	{
		$array = array(
			'title' => 'Panel administratif',
				'menu' => 'menu.admin.tpl.inc',
				'scripts' => array('admin/admin.js'),
		);

		$this->render($array);
	}
}