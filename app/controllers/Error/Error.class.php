<?php
namespace App\Controllers;

use App\Models\Router;

//@TODO : Fix loop on the render

class ErrorClass extends Router
{
	public function __construct()
	{
	}

	//@TODO : Make a true error page
	public function index()
	{
		print ('Page error');
		$array = array(
			'title' => 'Error Page',
			'message' => 'Message'
		);

		extract($array);
	}
}