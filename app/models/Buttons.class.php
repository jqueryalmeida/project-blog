<?php
namespace App\Models;

use App\Controllers;

class Buttons extends Router
{
	protected $allowedTags = array('#id', '#class', '#role', '#script', '#href', '#value', '#text', '#type', '#event', '#tag', '#title', '#alt');

	public function __construct()
	{
	}

	public function createButton(array &$button)
	{
		$html = "<".$button['#tag']." ";
		foreach ($button as $index => $value)
		{
			$preg = $this->preg('/\#/', $index);
			try
			{
				if($preg && isset($button[$index]))
				{
					switch ($index)
					{
						case '#id':
							//$html .= '"class=\"$button['#tag']\" ";
							$html .= "id=\"".$button['#id']."\"";
							break;
						case '#class':
							//$html .= '"class=\"$button['#tag']\" ";
							$html .= "class=\"".$button['#class']."\"";
							break;
						case '#role' :
							$html .= "role=\"".$button['#role']."\"";
							break;
						case '#href' :
							$html .= "class=\"".$button['#href']."\"";
							break;
						case '#type' :
							$html .= "type=\"".$button['#type']."\"";
							break;
						case '#event' :
							$html .= "class=\"".$button['#event']."\"";
							break;
						case '#title' :
							$html .= "title=\"".$button['#title']."\"";
							break;
						case '#alt' :
							$html .= "alt=\"".$button['#alt']."\"";
							break;
					}
				}

				else
				{
					throw new \Exception('Not in');
				}
			}
			catch(\Exception $e)
			{
				$this->error($e);
				print "Erreur lors de la création";
			}
		}

		$html .= ">".$button['#text']."</".$button['#tag'].">";

		return $html;
	}

	protected function createTag(string $tag)
	{
		return "<".$tag.">"."</".$tag.">";
	}
}