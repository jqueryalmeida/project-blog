<?php
namespace Interfaces;

interface Functions
{
	public function escapeString($string);

	public function getSession($key);

	public function setSession($key, $value);

	public function json_output($array);
}