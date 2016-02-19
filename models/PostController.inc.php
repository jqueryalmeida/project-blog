<?php
class PostController
{
	public function __construct($data)
	{
		$this->treatJson($data);
	}

	private function treatJson($data)
	{
		//var_dump($data);
	}
}