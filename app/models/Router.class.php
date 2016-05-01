<?php
namespace App\Models;
	/**
	 * Class Router
	 */
	/**
	 * {@inheritdoc}
	 */

//Loading the Database File :
use App\Controllers\ErrorClass;
use App\Database\Database;

class Router extends Database
{
	use Model;
	use Form;
	use Post;

	protected $_controller;
	protected $_action;
	protected $subaction;
	protected $_args = array();
	protected $url;
	protected $_admin;
	protected $user;
	protected $_server = array();

	public function __construct(string $url, string $config)
	{
		parent::__construct($config);
		$this->setUrl($url);
		$this->explodeUrl();
		$this->loadController($this->getController(), $this->getAction());
		$this->user = $this->getSession('pseudo');
	}

	protected function setServerRequest()
	{
		$this->_server = $_REQUEST;
	}

	protected function setUrl(string $url)
	{
		$this->url = $url;
	}

	protected function defineAdmin()
	{
		if(explode('\\', get_called_class())[2] == "Admin")
		{
			$this->_admin = TRUE;
		}
		else
		{
			$this->_admin = FALSE;
		}
	}

	public function getAdminController()
	{
		return $this->_admin;
	}

	public function userAdmin()
	{
		$admin = $this->select(array('*'))
			->from('users', 'us')
			->join('grades', 'gr')
			->using('id_grade')
			->where('id_user', '=', $this->getSession('id_user'))
			->query()
			->fetch('fetch', 'obj');

		$admin = $admin->power_grade;

		$this->user = $admin;


		return $this->_admin;
	}

	private function explodeUrl()
	{
		$array = explode('/', $this->url);

		if(isset($array[0]) && !empty($array[0]))
		{
			$this->setController($array[0]);
		} else
		{
			$this->setController('index');
		}

		if(isset($array[1]) && !empty($array[1]))
		{
			$this->setAction($array[1]);
		} else
		{
			$this->setAction('index');
		}

		if(isset($array[2]))
		{
			$this->setSubAction($array[2]);
		}

		if(isset($array[3]))
		{
			$args = explode('/', $this->url);
			$args = array_splice($args, 3);

			$this->setArgs($args);
		}
	}

	private function setController(string $controller)
	{
		$this->_controller = $this->escapeString($controller);
	}

	/**
	 * Method to set the action
	 * @param string $action
	 */
	private function setAction(string $action)
	{
		$this->_action = $this->escapeString($action);
	}

	private function setSubAction(string $sub_action)
	{
		$this->subaction = $this->escapeString($sub_action);
	}

	private function setArgs(array $args = null)
	{
		$this->_args = $args;
	}

	/**
	 * Method to return the controller called
	 * @return string Return the controller called
	 */
	protected function getController() : string
	{
		return $this->_controller;
	}

	/**
	 * Method to get the action
	 * @access protected
	 * @version 0.0.1
	 * @author M. Tahitoa
	 * @contributors :
	 * @return string Return the action called
	 *
	 * Sample
	 *
	 * $this->getAction();
	 */
	protected function getAction() : string
	{
		return $this->_action;
	}

	public function getRequestServer(string $index)
	{
		if(isset($_REQUEST) && !empty($_REQUEST[$index]))
		{
			return $_REQUEST[$index];
		}
	}

	protected function loadController(string $controller, string $action)
	{
		$controller = $this->escapeString(ucfirst($controller));
		$action = $this->escapeString($action);
		$subaction = $this->subaction;

		$dir = ROOT.'/app/controllers'.'/'.$controller.'/'.$controller.'.class.php';

		try
		{
			if(file_exists($dir))
			{
				$controller ='App\Controllers\\'.$controller;

				if(class_exists($controller))
				{
					$controller = new $controller();
					if(method_exists($controller, $action))
					{
						$controller->$action($subaction, $this->_args);
					}
					else
					{
						$err = new ErrorClass();
						$err->index();
						throw new \Exception('No method');
					}
				}
				else
				{
					$err = new ErrorClass();
					$err->index();
					throw new \Exception('No class');
				}
			} else
			{
				$err = new ErrorClass();
				$err->index();

				throw new \Exception("Missing file");
			}
		}
		catch(\Exception $e)
		{
			var_dump($e);
			$this->error($e);
		}
	}

	public function render(array $arrayMerge = null)
	{
		$calledClass = explode('\\', get_called_class());
		$this->defineAdmin();

		try
		{
			$regex = '/^([a-zA-Z]).+/i';
			$files = glob('views/'.$calledClass[2].'/*.tpl.php');

			$result = array();
			$i = 0;

			foreach($files as $index => $file)
			{
				preg_match($regex, $file, $match);
				$str = explode('/', $file);

				$result[$i] = substr($str[2], 0, -8);
				$i++;
			}

			$file = '';

			foreach($result as $key => $value)
			{
				$test = preg_match('/^'.$value.'/i', $calledClass[2], $match);

				if($test)
				{
					$file = $value;
				}
			}

			if(file_exists('views/'.$calledClass[2].'/'.$file.'.tpl.php'))
			{
				$view = 'views/'.$calledClass[2].'/'.$file.'.tpl.php';
			} else
			{
				throw new \Exception('No file to render');
			}

			$default = array(
				'content' => $view,
			);

			if(isset($arrayMerge))
			{
				$array = array_merge($default, $arrayMerge);
			} else
			{
				$array = $default;
			}

			extract($array);

			require_once 'views/template.tpl.php';
		}
		catch(\Exception $e)
		{
			$err = new ErrorClass();
			$err->index();

			$this->error($e);
		}
	}

	protected function setPath()
	{
		return $_GET['c'];
	}

	protected function reload()
	{
		return header('Location:'.$this->setPath());
	}

	public function getMenus()
	{
		$categorie = $this->select(array('*'))
			->from('menu')
			->query()
			->fetch('all', 'obj');

		return $categorie;
	}
}