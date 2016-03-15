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
	protected $aliasT1;
	protected $aliasT2;

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

	public function insert($table, $fields = array(), $values = array())
	{
		$req = 'INSERT INTO blog.'.$table.'('.$fields[0].') VALUE('.$fields[1].')';
		$prepared = $this->getInstance();
		$sth = $prepared->prepare($req);

		foreach($values as $key => $value)
		{
			$array[$key] = htmlspecialchars($value, ENT_HTML5, 'UTF-8');
		}

		$sth->execute($array);

		if($sth)
		{
			return true;
		} else
		{
			return false;
		}
	}
	/**
	 * Method to select a table in the database
	 * @param string $table The table's name
	 * @param null $alias Can be null, or to set an alias
	 * @param array $fields can specify fields separated by a space, or just get all fields
	 * @return $this Return the request current status
	 */
	public function select($table, $alias = null, $fields = array())
	{
		$this->req = 'SELECT '.$fields[0]. ' FROM blog.'.$table;

		$this->aliasT1 = $alias;

		!empty($alias) ? $this->req .= ' AS ' . $alias : '';

		return $this;
	}

	/**
	 * Method to use when there's a condition
	 * @param string $operator OR AND WHERE LIKE
	 * @return $this Return the request current status
	 * @require ConnectionDB::condition
	 */
	public function operator($operator)
	{
		$this->req .= ' ' . $operator;

		return $this;
	}

	/**
	 * Method to use to put a condition
	 * @param array $condition array('field', 'condition', 'value')
	 * @return $this Return the request current status
	 * @require ConnectionDB::operator
	 */
	public function condition($condition = array())
	{
		$this->req .= ' ' . $condition[0] . $condition[1] . $condition[2];

		return $this;
	}


	/**
	 * Method to use when a prepared request is made
	 * @param array $args array('index' => 'value')
	 * @return $this Return the request current status
	 */
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

	/**
	 * Method to join tables
	 * @param string $table The table to join
	 * @param string $alias The alias of the table joined
	 * @return $this
	 * @require ConnectionDB::select
	 * @require ConnectionDB:select(alias)
	 */
	//@TODO : see to join more than 2 tables => Maybe use an array of aliases
	public function join($table, $alias, $type = null)
	{
		$this->aliasT2 = $alias;
		$this->req .= " " .$type ." JOIN blog.".$table." AS ".$alias;

		return $this;
	}

	/**
	 * Method to choose on which fields make the join
	 * @param string $t1 The field of the table 1
	 * @param string $t2 The field of the table 2
	 * @return $this
	 * @require ConnectionDB:select
	 * @require ConnectionDB::select(alias)
	 * @require ConnectionDB::join(alias)
	 */
	//@TODO : See to make the join of different fields if more than 2 tables
	public function on($t1, $t2)
	{
		$this->req .= " ON ".$this->aliasT1.'.'.$t1 . " = " . $this->aliasT2.'.'.$t2;

		return $this;
	}

	public function order($field, $order)
	{
		$this->req .= " ORDER BY " . $field . " " . $order;
		return $this;
	}

	/**
	 * Method to return the fetched data
	 * @param string $fetch Choose if fetchAll or fetch
	 * @param string $type Choose how to display : obj, fetch, single, class,
	 * @return mixed Returning the result of fetch
	 * @require ConnectionDB::select or ConnectionDB::prepared()
	 */
	public function getData($fetch, $type)
	{
		$result = $this->prepared->{$this->fetch[$fetch]}($this->fetch_type[$type]);

		return $result;
	}

	/**
	 * Method to execute the request
	 * @return $this Return the request current status
	 */
	public function execute()
	{
		$req = $this::$instance->query($this->req);

		$req->execute();

		$this->prepared = $req;

		return $this;
	}

	public function del($table, $fields = array())
	{
		$this->req = "DELETE FROM blog.".$table." WHERE ".$fields[0];

		return $this;
	}
}