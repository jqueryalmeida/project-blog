<?php
namespace App\Models;

trait Post
{
	protected function treatData()
	{
		if(isset($_POST))
		{
			$data = array();

			foreach ($_POST as $index => $value)
			{
				$data[$index] = htmlspecialchars($value, ENT_HTML5, 'UTF-8');
			}

			return $this->transformInJson($data);
		}
	}

	protected function transformInJson($data)
	{
		$json = json_decode(json_encode($data));

		return $json;
	}
}