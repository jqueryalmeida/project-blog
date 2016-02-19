<?php
namespace Application\Core;

require_once ('Functions.imp.php');
require_once('Database/Database.inc.php');
require_once('PostController.inc.php');

use Interfaces;
use Core\Database;

class Router extends Database\ConnectionDB implements Interfaces\Functions
{
	protected $url;
	protected $controller;
	protected $action;
	protected $args;

	public function __construct($url)
	{
		$this->setUrl($url);
		$this->loadController();
		parent::__construct();
	}

	public function setUrl($url)
	{
		$params = explode('/', $url);

		if(isset($params[0]) && !empty($params[0]))
		{
			$this->setController($params[0]);
		} else
		{
			$controller = 'index';

			$this->setController($controller);
		}

		isset($params[1]) ? $params[1] : $params[1] = 'index';
		$this->setAction($params[1]);

		if(isset($params[2]))
		{
			$args = explode('/', $url);
			$args = array_splice($args, 2);

			$this->setArgs($args);
		}
	}

	protected function setController(&$controller)
	{
		$this->controller = $this->escapeString($controller);
	}

	protected function setAction(&$action)
	{
		$this->action = $this->escapeString($action);
	}

	protected function setArgs(array $args = null)
	{
		$this->args = $args;
	}

	protected function loadController()
	{
		$controller = ucfirst($this->controller);

		if(file_exists('controllers/'.$controller.'/'.$controller.'.php'))
		{
			require_once 'controllers/'.$controller.'/'.$controller.'.php';
		} else
		{
			require_once 'views/error.tpl.inc.php';
		}


		if(class_exists($controller) && method_exists($controller, $this->action))
		{
			$action = $this->action;
			$controller = new $controller();

			$controller->$action($this->args);
		}
	}

	public function render(array $array = null)
	{
		if(file_exists('views/'.get_called_class().'/'.get_called_class().'.php'))
		{
			$view = 'views/'.get_called_class().'/'.get_called_class().'.php';
		} else
		{
			$view = 'views/error.tpl.inc.php';
		}

		$default = array(
			'content' => $view,
		);

		$array = array_merge($default, $array);
		extract($array);
		require_once 'views/template.tpl.inc.php';
	}

	public function checkUserGrade()
	{
		$user = $this->select('users', 'us', array('*'))
				->join("grades", 'gr')
				->on('us.id_grade', 'gr.id_grade')
				->operator('where')
				->condition(array('id_user', '=', ':id_user'))
				->prepared(array('id_user' => $this->getSession('id_user')))
				->getData('fetch', 'obj');

		return $user->power_grade;
	}

	public function escapeString($string)
	{
		$string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

		return $string;
	}

	public function setSession($key, $value)
	{
		$_SESSION[$key] = $this->escapeString($value);
	}

	public function getSession($key)
	{
		return $_SESSION[$key];
	}

	public function json_output($array)
	{
		return print json_encode($array);
	}
}