<?php
namespace App\Models;

use App\Database\Database;

trait Model
{
	public function load_script(string $name_script, string $library = null)
	{
		if (isset($library))
		{
			$script = '/webroot/scripts/' . $library . '/' . $name_script;
		}
		else
		{
			$script = '/webroot/scripts/' . $name_script;
		}

		return $script;
	}

	public function load_style(string $name_syle, string $folder = null)
	{
		if (isset($folder))
		{
			$style = WEBROOT . 'styles/' . $folder . '/' . $name_syle;
		}
		else
		{
			$style = WEBROOT . 'styles/' . $name_syle;
		}

		return $style;
	}

	public function preg(string $regex, string $string) : int
	{
		if(!empty($regex) && !empty($string))
		{
			$test = preg_match($regex, $string);

			return $test;
		}
		else
		{
			return false;
		}
	}

	public function escapeString(string $string) : string
	{
		$string = htmlspecialchars($string, ENT_HTML5, 'UTF-8');

		return $string;
	}

	public function setSession(string $key, $value)
	{
		$_SESSION[$key] = $this->escapeString($value);
	}

	public function getSession(string $key)
	{
		if (isset($_SESSION[$key]))
		{
			return $this->escapeString($_SESSION[$key]);
		}
		else
		{
			return false;
		}
	}

	public function deleteSession(string $key)
	{
		unset($_SESSION[$key]);
	}

	public function json_output(array $array = array()) : string
	{
		$array = array_merge($array, array('request' => $_REQUEST));

		return print json_encode($array);
	}

	public function responseHttpRequest(string $index) : string
	{
		return $this->escapeString($_REQUEST[$index]);
	}

	public function checkConnection($user)
	{
		if($user)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}