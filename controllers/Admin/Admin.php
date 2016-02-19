<?php
class Admin extends \Application\Core\Router
{
	protected $user;

	public function __construct()
	{
		$this->user = $this->getSession('id_user');
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