<?php
class PostController
{
	protected $json;

	public function __construct($data)
	{
		if(is_object($data))
		{
			$this->treatJson($data);
		} else if(is_array($data))
		{
			$this->convertToJson($data);
		}
		else if(is_string($data))
		{
			$this->treatString($data);
		}
	}

	private function treatJson($data)
	{
		$escape = array();
		foreach($data as $key => $value)
		{
			$escape[$key] = htmlspecialchars($value, ENT_HTML5, 'UTF-8');
		}

		$this->json = $escape;
	}

	private function treatString($data)
	{
		$string = json_decode($data);

		$this->treatJson($string);
	}

	private function convertToJson(array $data = array())
	{
		$escape = array();

		foreach($data as $key => $value)
		{
			$escape[$key] = htmlspecialchars($value, ENT_HTML5, 'UTF-8');
		}

		$this->json = $escape;
	}

	public function getJson()
	{
		return json_decode(json_encode($this->json));
	}
}