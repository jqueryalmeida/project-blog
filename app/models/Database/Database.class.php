<?php
namespace App\Database;

use App\Controllers\ErrorClass;
use App\Models\Model;
use App\Models\Router;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

/**
 * {@inheritdoc}
 */

/**
 * Class Database
 *
 * @package App\Database
 */
abstract class Database implements QueryBuilder
{
	use Model;

	protected static $instance;
	
	protected $_request;
	protected $_prepared;
	protected $_result;
	protected $_select = FALSE;
	protected $_order = FALSE;
	protected $setStatement = FALSE;

	protected $_df_field = FALSE;
	protected $_fields;

	protected $_statement = FALSE;

	protected $fetch = array(
		'all'    => 'fetchAll',
		'single' => 'fetch',
		'fetch'  => 'fetch',
		'column' => 'fetchColumn',
		'object' => 'fetchObject',
	);

	/**
	 * @var array $typeFetch
	 */
	protected $typeFetch = array(
		'assoc'    => \PDO::FETCH_ASSOC,
		'column'   => \PDO::FETCH_COLUMN,
		'obj'      => \PDO::FETCH_OBJ,
		'class'    => \PDO::FETCH_CLASS,
		'function' => \PDO::FETCH_FUNC,
	);


	public function __construct($settings)
	{
		try
		{
			define('SETTING', DATABASE['database'][$settings]['database']);

			$pdo = new \PDO(DATABASE['database'][$settings]['driver'].':'.DATABASE['database'][$settings]['host'].';'.DATABASE['database'][$settings]['database'], DATABASE['database'][$settings]['login'], DATABASE['database'][$settings]['password'], array());

			$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
			$pdo->exec('SET NAMES UTF8');
			$pdo->exec('USE '. SETTING);

			self::$instance = $pdo;
		}
		catch (\PDOException $e)
		{
			print "Erreur lors de la connexion";
		} finally
		{

		}
	}

	/**
	 * Method to return the PDO instance
	 *
	 * @return \PDO
	 */
	public static function getInstance()
	{
		if (self::$instance)
		{
			return Database::$instance;
		}
		else
		{
			return new self::$instance;
		}
	}

	/**
	 * Insert the error in the database
	 *
	 * @param \Exception $error The instance of Exeception
	 * @param string $type The type of error
	 * @package App\Models\Database
	 */
	public function error(\Exception $error, string $type)
	{
		$this->_request = "";
		$this->_prepared = "";

		$this->insert('Error', true)
			->values(array(':message, :code, :file, :line, :trace, :type'))
			->prepare()
			->setParam(':message', $error->getMessage())
			->setParam(':code', $error->getCode())
			->setParam(':file', $error->getFile())
			->setParam(':line', $error->getLine())
			->setParam(':trace', json_encode($error->getTrace()))
			->setParam(':type', $this->escapeString($type))
			->execute();

		$this->_request = "";
		$this->_prepared = "";
	}

	/**
	 * Method to add entry in database
	 *
	 * Sample :
	 * $this->insert('Users')
	 *      ->fields(array('pseudo, password')
	 *      ->values(array('"pseudo", "password"'))
	 *      ->query();
	 *
	 *       OR
	 *
	 * $this->insert('Users', true)
	 *      ->values(array(':pseudo, :psw'))
	 *      ->prepare()
	 *      ->setParam(':pseudo', 'pseudo')
	 *      ->setParam(':psw', 'password')
	 *      ->execute();
	 *
	 *
	 * @param string $table The table target
	 * @param bool   $all If FALSE we assume that to define the columns targeted, TRUE means all columns
	 *
	 * @author : M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function insert(string $table, bool $all = FALSE)
	{
		$this->_request = "";

		if (!$all)
		{
			$this->_request .= "INSERT INTO " . $table;
		}
		else
		{
			$this->getFields($table);

			$this->_request .= "INSERT INTO " . $table . "(" . $this->_fields . ") ";
		}

		return $this;
	}

	/**
	 * Method to select in the database
	 *
	 * Sample :
	 *
	 * $this->select(array('pseudo, password'))
	 *      ->from('Users', 'u')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 *      OR
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'u')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param array $fields The fields concerned, or "*" for all field
	 * @access public
	 * @author M. Tahitoa
	 *
	 * @return $this
	 */
	public function select(array $fields)
	{
		$this->_request = null;
		$this->_prepared = null;

		$this->_request .= "SELECT " . $fields[0] . " ";
		$this->_select = TRUE;

		return $this;
	}

	/**
	 * Method to update entry in database
	 *
	 * Sample :
	 *
	 * $this->update('Users')
	 *      ->set(array('pseudo' => 'newpseudo', 'password' => 'newPassword'))
	 *      ->where('idUser', '=', 2)
	 *      ->query();
	 *
	 *      OR
	 *
	 * $this->update('Users')
	 *      ->set(array(
	 *          ('pseudo' => ':pseudo',
	 *           'password' => ':newPass'
	 *       ))
	 *      ->where('idUser', '=', ':id')
	 *      ->prepare()
	 *      ->setParam(':pseudo', 'newPseudo')
	 *      ->setParam(':newPass', 'newPassword')
	 *      ->setParam(':id', 1)
	 *      ->execute();
	 *
	 * @param string $table
	 * @access public
	 * @author M. Tahitoa
	 * @return $this
	 */
	public function update(string $table)
	{
		$this->_request = null;
		$this->_prepared = null;
		$this->setStatement = FALSE;

		$this->_request .= "UPDATE " . $table . " ";

		return $this;
	}

	/**
	 * Method to delete entry in database
	 *
	 * SampleS :
	 *
	 * $this->delete('Users')
	 *      ->where('idUser', '=', 1)
	 *      ->query();
	 *
	 * $this->delete('Users')
	 *      ->where('idUser', '=', ':i')
	 *      ->prepare()
	 *      ->setParam(':id', 1)
	 *      ->execute();
	 *
	 * @param string $table Table target
	 * @access public
	 * @author M. Tahitoa
	 * @return $this
	 */
	public function delete(string $table)
	{
		$this->_request = null;
		$this->_prepared = null;

		$this->_request .= "DELETE FROM " . $table . " ";

		return $this;
	}

	/**
	 * Method to TRUNCATE a table
	 *
	 * @param string $table
	 *
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function truncate(string $table)
	{
		$this->_request = null;
		$this->_prepared = null;

		$this->_request .= "TRUNCATE ".$table;
		return $this;
	}

	/**
	 * Method to define the table to get data
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $table Name of table
	 * @param string $alias If need to define alias
	 * @access public
	 * @author M. Tahitoa
	 * @return $this
	 */
	public function from(string $table, string $alias = null)
	{
		if (!is_null($alias) && is_string($alias))
		{
			$this->_request .= "FROM " . $table . " AS " . $alias . " ";
		}
		else
		{
			$this->_request .= "FROM " . $table . " ";
		}


		return $this;
	}

	/**
	 * Method to use in an insert request
	 *
	 * SampleS :
	 *
	 * $this->insert('Users')
	 *      ->fields(array('pseudo, password, email'))
	 *      ->values(array('pseudo, password, email@mail.com'))
	 *      ->query();
	 *
	 * $this->insert('Users')
	 *      ->fields(array('pseudo, password, email'))
	 *      ->values(array(':pseudo, :pass, :mail'))
	 *      ->prepare()
	 *      ->setParam(':pseudo', 'pseudo')
	 *      ->setParam(':pass', 'password')
	 *      ->setParam(':mail', 'email@mail.com')
	 *      ->execute();
	 *
	 * @param array $fields The concerned fields
	 * @access public
	 * @author M. Tahitoa
	 * @return $this
	 */
	public function fields(array $fields)
	{
		if (!$this->_select)
		{
			$this->_request .= "(" . $fields[0] . ") ";
		}
		else
		{
			$this->_request .= "," . $fields[0] . " ";
		}


		$this->_df_field = TRUE;

		return $this;
	}

	/**
	 * Method to give an alias to fields/request/result
	 *
	 * @Sample :
	 *
	 * $articles = $this->select(array('*, DATE_FORMAT(publication_article, \'%d/%m/%Y - %H:%i\')'))
					->as('date')
					->from('articles')
					->query()
					->fetch('all', 'obj');
	 *
	 * @param string $alias The name of alias
	 * @access public
	 * @author M. Tahitoa
	 * @return $this
	 */
	public function as (string $alias)
	{
		$this->_request .= "AS " . $alias . " ";

		return $this;
	}

	/**
	 * Method to use with an update request
	 *
	 * Samples :
	 *
	 * $this->update('Users')
	 *      ->set(array('pseudo' => 'newpseudo', 'password' => 'newPassword'))
	 *      ->where('idUser', '=', 2)
	 *      ->query();
	 *
	 *      OR
	 *
	 * $this->update('Users')
	 *      ->set(array(
	 *          ('pseudo' => ':pseudo',
	 *           'password' => ':newPass'
	 *       ))
	 *      ->where('idUser', '=', ':id')
	 *      ->prepare()
	 *      ->setParam(':pseudo', 'newPseudo')
	 *      ->setParam(':newPass', 'newPassword')
	 *      ->setParam(':id', 1)
	 *      ->execute();
	 *
	 * @param array $params
	 * @access public
	 * @author M. Tahitoa
	 * @return $this
	 */
	public function set(array $params = array())
	{
		foreach ($params as $column => $value)
		{
			$param = preg_match('/^\:/i', $value);

			if (!$this->setStatement)
			{
				if ($param)
				{
					$this->_request .= "SET " . $column . "=" . $value . ", ";
				}
				else
				{
					$this->_request .= "SET " . $column . "='" . $value . "', ";
				}

				$this->setStatement = TRUE;
			}
			else
			{
				if ($param)
				{
					$this->_request .= $column . "=" . $value . ", ";
				}
				else
				{
					$this->_request .= $column . "='" . $value . "', ";
				}
			}
		}

		$this->_request = substr($this->_request, 0, -2);
		$this->_request .= " ";

		return $this;
	}

	/*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
	/*      Opérations simple sur les champs/tables*/
	/*----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/


	/**
	 * Method to make a DISTINCT select
	 *
	 * Samples :
	 *
	 * $this->distinct('pseudo')
	 *      ->fields(array('articles'))
	 *      ->from('articles')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $field The field target
	 * @param string $alias The alias to have access to the selection
	 * @access public
	 * @author M. Tahitoa.
	 * @version 0.0.1
	 * @return $this
	 */

	public function distinct(string $field, string $alias = null)
	{
		if (!$this->_select)
		{
			$this->_request .= "SELECT DISTINCT(" . $field . ") AS " . $alias . " ";
			$this->_select = TRUE;
		}
		else
		{
			$this->_request .= "DISTINCT " . $field . " AS " . $alias . " ";
		}

		return $this;
	}
	

	/**
	 * Method to count entries in request
	 *
	 * Sample :
	 *
	 * $this->count('*', 'TotalUsers')
	 * ->fields(array('pseudo, idAccess'))
	 * ->from('Users')
	 * ->query()
	 * ->fetch('all', 'obj');
	 *
	 * @param string $field The field target
	 * @param string $alias If an alias is used
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function count(string $field, string $alias = null)
	{
		if (!$this->_select)
		{
			if (!is_null($alias))
			{
				$this->_request .= "SELECT COUNT(" . $field . ") AS " . $alias . " ";
			}
			else
			{
				$this->_request .= "SELECT COUNT(" . $field . ") ";
			}
			$this->_select = TRUE;
		}
		else
		{
			if (!is_null($alias))
			{
				$this->_request .= "COUNT(" . $field . ") AS " . $alias . " ";
			}
			else
			{
				$this->_request .= "COUNT(" . $field . ") ";
			}
		}

		return $this;
	}

	/**
	 * Method to select the minimum in the request
	 *
	 * Sample :
	 *
	 * $this->min('price', 'LowestPrice')
	 *      ->fields(array('name, description, constructor'))
	 *      ->from('articles', 'art')
	 *      ->query()
	 *      ->fetch('single', 'obj');
	 *
	 * @param string $field The field target
	 * @param string $alias The alias of the field
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function min(string $field, string $alias)
	{
		if (!$this->_select)
		{
			$this->_request .= "SELECT MIN(" . $field . ") AS " . $alias . " ";
			$this->_select = TRUE;
		}
		else
		{
			$this->_request .= "MIN(" . $field . ") AS " . $alias . " ";
		}

		return $this;
	}

	/**
	 * Method to select the maximum in the request
	 *
	 * Sample :
	 *
	 * $this->max('price', 'LowestPrice')
	 *      ->fields(array('name, description, constructor'))
	 *      ->from('articles', 'art')
	 *      ->query()
	 *      ->fetch('single', 'obj');
	 *
	 * @param string $field The field target
	 * @param string $alias The alias of the field
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function max(string $field, string $alias)
	{
		if (!$this->_select)
		{
			$this->_request .= "SELECT MAX(" . $field . ") AS " . $alias . " ";
			$this->_select = TRUE;
		}
		else
		{
			$this->_request .= "MAX(" . $field . ") AS " . $alias . " ";
		}

		return $this;
	}

	/**
	 * Method to make the sum in the request
	 *
	 * Sample :
	 *
	 * $this->sum('price', 'LowestPrice')
	 *      ->fields(array('name, description, constructor'))
	 *      ->from('articles', 'art')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $field The field target
	 * @param string $alias The alias of the field
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function sum(string $field, string $alias)
	{
		if (!$this->_select)
		{
			$this->_request .= "SELECT SUM(" . $field . ") AS " . $alias . " ";
			$this->_select = TRUE;
		}
		else
		{
			$this->_request .= "MAX(" . $field . ") AS " . $alias . " ";

		}

		return $this;
	}

	/**
	 * Method to select the average in the request
	 *
	 * Sample :
	 *
	 * $this->avg('price', 'LowestPrice')
	 *      ->fields(array('name, description, constructor'))
	 *      ->from('articles', 'art')
	 *      ->query()
	 *      ->fetch('single', 'obj');
	 *
	 * @param string $field The field target
	 * @param string $alias The alias of the field
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function avg(string $field, string $alias)
	{
		if (!$this->_select)
		{
			$this->_request .= "SELECT AVG(" . $field . ") AS " . $alias . " ";
			$this->_select = TRUE;
		}
		else
		{
			$this->_request .= "AVG(" . $field . ") AS " . $alias . " ";

		}

		return $this;
	}
	
	/*
	 * Condition
	 */

	/**
	 * Method to add WHERE clause
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users')
	 *      ->where('idUser', '=', '1')
	 *      ->query()
	 *      ->fetch('single', 'obj');
	 *
	 * @param string $field The field concerned by the clause
	 * @param string $operator The operator
	 * @param string $value The value for the clause
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function where(string $field, string $operator = null, string $value = null)
	{
		$preg = $this->preg("/\:/", $value);

		if (!$preg)
		{
			$this->_request .= "WHERE " . $field . $operator . "'" . $value . "' ";
		}
		else
		{
			$this->_request .= "WHERE " . $field . $operator . $value . " ";
		}
		
		return $this;
	}

	/**
	 * Method to add AND clause
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users')
	 *      ->where('idUser', '=', '1')
	 *      ->and('pseudo', '=', 'pseudo')
	 *      ->query()
	 *      ->fetch('single', 'obj');
	 *
	 * @param string $field The field concerned by the clause
	 * @param string $operator The operator
	 * @param string $value The value for the clause
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function and (string $field, string $operator, string $value)
	{
		$this->_request .= "AND " . $field . $operator . $value . " ";

		return $this;
	}

	/**
	 * Method to add OR clause
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users')
	 *      ->where('idUser', '=', '1')
	 *      ->or('pseudo', '=', 'pseudo')
	 *      ->query()
	 *      ->fetch('single', 'obj');
	 *
	 * @param string $field The field concerned by the clause
	 * @param string $operator The operator
	 * @param string $value The value for the clause
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function or (string $field, string $operator, string $value)
	{
		$this->_request .= "OR " . $field . $operator . $value . " ";

		return $this;
	}

	/**
	 * Method to add IN clause
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users')
	 *      ->where('idAccess')
	 *      ->in(array('pseudo1, pseudo2')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param array $values The field concerned by the clause
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function in(array $values)
	{
		$explode = explode(',', $values[0]);

		$this->_request .= "IN(";

		foreach ($explode as $index => $value)
		{
			$this->_request .= "'" . $value . "',";
		}

		$this->_request = substr($this->_request, 0, -1);
		$this->_request .= ')';

		return $this;
	}

	/**
	 * Method to add BETWEEN clause
	 *
	 * Sample :
	 *
	 *$this->select(array('*'))
	 *      ->from('Users')
	 *      ->where('idUser')
	 *      ->between(0,10)
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param $min
	 * @param $max
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function between($min, $max)
	{
		$this->_request .= "BETWEEN '" . $min . "' AND '" . $max . "' ";

		return $this;
	}

	public function not(string $field, string $operator, string $value)
	{

	}

	/**
	 * Method to add NOT IN clause
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users')
	 *      ->where('idAccess')
	 *      ->notin(array('0,1,2,5')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param array $values The field concerned by the clause
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */

	public function notIn(array $values)
	{
		$explode = explode(',', $values[0]);

		$this->_request .= "NOT IN(";

		foreach ($explode as $index => $value)
		{
			$this->_request .= "'" . $value . "',";
		}

		$this->_request = substr($this->_request, 0, -1);
		$this->_request .= ')';

		return $this;
	}
	
	/**
	 * Method to add LIKE clause
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('test')
	 *      ->where('name')
	 *      ->like('%mae%')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $value String to search
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function like(string $value)
	{
		$this->_request .= "LIKE '" . $value . "' ";

		return $this;
	}

	public function condition(string $condition)
	{
		// TODO: Implement condition() method.
	}
	
	/*
	 * JOIN operations
	 */

	/**
	 * Method to join table
	 *
	 * Samples :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->join('Access', 'acc')
	 *      ->using('idAccess')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->join('Access', 'acc')
	 *      ->on('us.idAccess', 'acc.id')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $table Table to join
	 * @param string $alias Alias to give
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function join(string $table, string $alias)
	{
		$this->_request .= "JOIN " . $table . " AS " . $alias . " ";

		return $this;
	}

	/**
	 * Method to make left join table
	 *
	 * Samples :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->leftjoin('Access', 'acc')
	 *      ->using('idAccess')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->leftjoin('Access', 'acc')
	 *      ->on('us.idAccess', 'acc.id')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $table Table to join
	 * @param string $alias Alias to give
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function leftjoin(string $table, string $alias)
	{
		$this->_request .= "LEFT JOIN " . $table . " AS " . $alias . " ";

		return $this;
	}

	/**
	 * Method to make right join table
	 *
	 * Samples :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->rightjoin('Access', 'acc')
	 *      ->using('idAccess')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->rightjoin('Access', 'acc')
	 *      ->on('us.idAccess', 'acc.id')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $table Table to join
	 * @param string $alias Alias to give
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function rightjoin(string $table, string $alias)
	{
		$this->_request .= "RIGHT JOIN " . $table . " AS " . $alias . " ";

		return $this;
	}


	/**
	 * Method to make natural join table
	 *
	 * Samples :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->naturaljoin('Access', 'acc')
	 *      ->using('idAccess')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->naturaljoin('Access', 'acc')
	 *      ->on('us.idAccess', 'acc.id')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $table Table to join
	 * @param string $alias Alias to give
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function naturaljoin(string $table, string $alias)
	{
		$this->_request .= "NATURAL JOIN " . $table . " AS " . $alias . " ";

		return $this;
	}

	/**
	 * Method to make the join table when the column to join have different name
	 *
	 * Samples :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->leftjoin('Access', 'acc')
	 *      ->on('us.idAccess', 'acc.id')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $field1 Field of the first table
	 * @param string $field2 Field of the second table
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function on(string $field1, string $field2)
	{
		$this->_request .= "ON (" . $field1 . "=" . $field2 . ") ";

		return $this;
	}

	/**
	 * Method to make the join table when the column have the same name
	 *
	 * Samples :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->leftjoin('Access', 'acc')
	 *      ->using('idAccess')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $field Field to make the join
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function using(string $field)
	{
		$this->_request .= "USING (" . $field . ") ";

		return $this;
	}

	/*
	 * ORDER
	 */

	/**
	 * Method to order the results of the request
	 *
	 * Samples :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->order('idUser', 'DESC')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $field Column
	 * @param string $order Default ASC
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function order(string $field, string $order = 'ASC')
	{
		if (!$this->_order)
		{
			$this->_request .= "ORDER BY " . $field . " " . $order . " ";
			$this->_order = TRUE;
		}
		else
		{
			$this->_request .= ", " . $field . " " . $order . " ";
		}

		return $this;
	}
	
	/**
	 * Method to group result of the request
	 *
	 * Samples :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->order('idUser', 'DESC') //By default we assume the order is ASC
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string $field Column
	 * @param string $order Default ASC
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function group(array $fields)
	{
		$this->_request .= "GROUP BY " . $fields[0] . " ";

		return $this;
	}

	/**
	 * Method to limit the results retrieve by the request
	 *
	 * Samples :
	 *
	 * $articles = $this->select(array('*, DATE_FORMAT(publication_article, \'%d/%m/%Y - %H:%i\')'))
	 *                  ->as('date')
	 *                  ->from('articles')
	 *                  ->order('publication_article', 'DESC')
	 *                  ->limit(0, 5)
	 *                  ->query()
	 *                  ->fetch('all', 'obj');
	 *
	 * @param int $begin Min num for the return
	 * @param int $max Max number to return
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @tag join
	 * @return $this
	 */
	public function limit(int $begin, int $max)
	{
		$this->_request .= "LIMIT ".$begin .",".$max . " ";

		return $this;
	}

	/**
	 * Method to return all the fields of a table
	 *
	 * Sample :
	 *
	 * $this->getFields('Users');
	 *
	 * @param string $table The table target
	 * @param string $database Database target if different of the default
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */

	public function getFields(string $table, string $database = SETTING)
	{
		try
		{
			$req = "SELECT DISTINCT * FROM information_schema.columns WHERE TABLE_SCHEMA = '" . $database . "' AND TABLE_NAME = '$table' AND EXTRA != 'auto_increment'";

			$result = $this::getInstance()->query($req);

			$fields = $result->fetchAll(\PDO::FETCH_OBJ);

			$fieldsStr = "";

			foreach ($fields as $index => $colMeta)
			{
				if (is_null($colMeta->COLUMN_DEFAULT))
				{
					$fieldsStr .= $colMeta->COLUMN_NAME . ', ';
				}
			}

			$fieldsStr = substr($fieldsStr, 0, -2);

			$this->_fields = $fieldsStr;

			return $this;
		}
		catch (\Exception $e)
		{
			$_REQUEST['error_message'] = $e->getMessage();
			$this->error($e);
		} finally
		{

		}
	}

	/**
	 * Method to add entry in database
	 *
	 * Samples :
	 *
	 * $this->insert('Users')
	 *      ->fields(array('pseudo, password')
	 *      ->values(array('"pseudo", "password"'))
	 *      ->query();
	 *
	 *       OR
	 *
	 * $this->insert('Users', true)
	 *      ->values(array(':pseudo, :psw'))
	 *      ->prepare()
	 *      ->setParam(':pseudo', 'pseudo')
	 *      ->setParam(':psw', 'password')
	 *      ->execute();
	 *
	 * @param array $values The values to insert
	 *
	 * @author : M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 *
	 * */

	public function values(array $values = array())
	{
		$this->_request .= "VALUE(";
		if(Router::preg('/\{/', $values[0]))
		{
			$this->_request .= "'" . $values[0] . "', ";
		}
		else
		{
			$value = explode(',', $values[0]);

			foreach ($value as $index => $v)
			{
				$preg = preg_match('/\:/', $v);

				if (!$preg)
				{
					$this->_request .= "'" . $v . "',";
				}
				else
				{
					$this->_request .= $v . ",";
				}
			}
		}

		$this->_request = substr($this->_request, 0, -1);
		$this->_request .= ") ";

		return $this;
	}

	/**
	 * Method to make a prepared request
	 *
	 * Sample :
	 *
	 * $this->insert('Users', true)
	 *      ->values(array(':pseudo, :psw'))
	 *      ->prepare()
	 *      ->setParam(':pseudo', 'pseudo')
	 *      ->setParam(':psw', 'password')
	 *      ->execute();
	 *
	 * @access public
	 * @author : M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function prepare()
	{
		$this->_prepared = $this::getInstance()->prepare($this->_request);

		$this->_request = null;

		return $this;
	}

	/**
	 * Method to set a value for a param in prepared request
	 *
	 * Sample :
	 *
	 * $this->insert('Users', true)
	 *      ->values(array(':pseudo, :psw'))
	 *      ->prepare()
	 *      ->setParam(':pseudo', 'pseudo')
	 *      ->setParam(':psw', 'password')
	 *      ->execute();
	 *
	 *
	 * @param string $param The defined param in the prepared request
	 * @param mixed  $value The value for the param
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function setParam(string $param, $value)
	{
		$this->_prepared->bindParam($param, $value);

		return $this;
	}

	/**
	 * Method to execute prepared request
	 *
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function execute()
	{
		try
		{
			$this->_prepared->execute();
			$this->_request = null;

			return $this;
		}
		catch (\Exception $e)
		{
			$_REQUEST['error_message'] = $e->getMessage();
			$this->error($e, 'sql_error');
		} finally
		{
		}
	}

	/**
	 * Method to fetch result of a request
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->order('idUser', 'DESC')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @param string      $type The type is defined in the $fetch
	 * @param string|null $format The type of display format fetch in $typeFetch
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return array
	 */
	public function fetch(string $type, string $format = 'assoc')
	{
		$this->_statement = FALSE;
		$data = array();

		try
		{
				if (!is_null($this->_prepared))
				{
					$prepared = $this->_prepared->{$this->fetch[$type]}($this->typeFetch[$format]);

					if (!empty($prepared))
					{
						$data = $prepared;
						$this->_statement = TRUE;
					}

				}

				if (!is_null($this->_result))
				{
					$query = $this->_result->{$this->fetch[$type]}($this->typeFetch[$format]);

					$data = $query;
				}

			$this->_result = null;
			$this->_request = null;
			$this->_prepared = null;

			return $data;
		}
		catch(\Exception $e)
		{
			$this->error($e, 'sql_error');
		}
	}

	/**
	 * Method to execute query
	 *
	 * Sample :
	 *
	 * $this->select(array('*'))
	 *      ->from('Users', 'us')
	 *      ->order('idUser', 'DESC')
	 *      ->query()
	 *      ->fetch('all', 'obj');
	 *
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return $this
	 */
	public function query()
	{
		$this->_prepared = null;
		try
		{
			$this->_result = $this::getInstance()->query($this->_request);
		}
		catch (\Exception $e)
		{
			$this->error($e, 'sql_error');
			$error = new ErrorClass();
			$error->index();
		}

		if(!isset($e))
		{
			return $this;
		}
	}

	/**
	 * Method to create a produre
	 *
	 * @param string $procedure The procedure to create
	 */
	public function createProcedure(string $procedure)
	{
		try
		{
			$this->getInstance()->query($procedure);
		}
		catch (\Exception $e)
		{
			$this->error($e);
		}
	}

	/**
	 * Method to create a function
	 *
	 * @param string $function The function to create
	 */
	public function createFunction(string $function)
	{
		try
		{
			$this->getInstance()->query($function);
		}
		catch (\Exception $e)
		{
			$this->error($e);
		}
	}

	/**
	 * Method to return the statement of a request
	 *
	 * @access public
	 * @author M. Tahitoa
	 * @version 0.0.1
	 * @return bool
	 */
	public function getStatement()
	{
		return $this->_statement;
	}

	public function getRequest()
	{
		return var_dump($this->_request, $this->_prepared);
	}
}