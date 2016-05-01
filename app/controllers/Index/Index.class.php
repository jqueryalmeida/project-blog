<?php
namespace App\Controllers;

use App\Models\Router;

class Index extends Router
{
	public function __construct()
	{
		
	}

	public function index()
	{
		$array = array(
			'title' => 'title',
		);

		$this->render($array);
	}
}