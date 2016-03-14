<?php
class PostController
{
	protected $json;

	public function __construct(array $data = array())
	{
		$this->treatJson($data);
		$this->convertToJson($data);
	}

	private function treatJson($data)
	{
		//var_dump($data);

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