<?php
namespace App\Controllers;

use App\Database\Database;
use App\Models\Router;

class ErrorClass extends Router
{
	public function __construct()
	{
		
	}

	public function index()
	{
		print "page erreur";
	}
}