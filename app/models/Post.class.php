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
				if(is_array($value))
				{
					foreach ($value as $subIndex => $subValue)
					{
						$data[$index][$subIndex] = $subValue;
					}
				}
				else
				{
					$data[$index] = htmlspecialchars($value, ENT_HTML5, 'UTF-8');
				}
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