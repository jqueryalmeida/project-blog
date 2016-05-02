<?php
namespace App\Controllers;

use App\Database\Database;
use App\Models\Router;

class ErrorClass extends \Exception
{
	protected $type;

	public function index()
	{
		print "page erreur";
	}

	public function setType(string $type)
	{
		$this->type = $type;
	}

	public function getType()
	{
		return $this->type;
	}
}