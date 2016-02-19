<?php
namespace Core\Database;

require_once('settings_database.php');

abstract class ConnectionDB extends \PDO
{
	static $instance;
	protected $req;
	protected $database = 'blog';

	protected $fetch = array(
			'all' => 'fetchAll',
			'fetch' => 'fetch'
	);

	protected $fetch_type = array(
			'fetch' => \PDO::FETCH_ASSOC,
			'obj' => \PDO::FETCH_OBJ,
			'single' => \PDO::FETCH_COLUMN,
			'class' => \PDO::FETCH_CLASS,
	);

	protected $type_var = array(
			'string' => \PDO::PARAM_STR,
			'boolean' => \PDO::PARAM_BOOL,
			'integer' => \PDO::PARAM_INT,
			'float' => \PDO::PARAM_STR,
			'object' => \PDO::PARAM_STR,
	);

	protected $fetched;
	protected $prepared;
	protected $executed;

	public function __construct()
	{
		global $host, $login, $password, $database, $type, $env, $options;

		$db = new \PDO($type.':'.$host.':dbname='.$database, $login, $password, $options);

		if($env == 'dev')
		{
			$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_WARNING);
		}

		$db->exec('SET NAMES UTF8');

		$this::$instance = $db;
	}


	public static function getInstance()
	{
		if(!self::$instance)
		{
			return new self::$instance;
		}

		return self::$instance;
	}

	public function select($table, $alias = null, $fields = array())
	{
		$this->req = 'SELECT '.$fields[0]. ' FROM blog.'.$table;

		return $this;
	}

	public function operator($operator)
	{
		$this->req .= ' ' . $operator;

		return $this;
	}

	public function condition($condition = array())
	{
		$this->req .= ' ' . $condition[0] . $condition[1] . $condition[2];

		return $this;
	}

	public function prepared($args = array())
	{
		$this->prepared = $this::$instance->prepare($this->req);

		foreach($args as $index => $value)
		{
			$type = gettype($value);

			$this->prepared->bindParam(':'.$index, $value, $this->type_var[$type]);
		}

		$this->prepared->execute();

		return $this;
	}

	public function join($table, $alias)
	{
		$this->req .= " JOIN blog.".$table." AS ".$alias;

		return $this;
	}

	public function on($t1, $t2)
	{
		$this->req .= " ON ".$t1 . " = " . $t2;

		return $this;
	}

	public function getData($fetch, $type)
	{
		$result = $this->prepared->{$this->fetch[$fetch]}($this->fetch_type[$type]);

		return $result;
	}

	public function execute()
	{
		$req = $this::$instance->query($this->req);

		$req->execute();

		$this->prepared = $req;

		return $this;
	}
}