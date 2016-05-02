<?php
namespace App\Controllers;

use App\Models\Router;

class Index extends Router
{
	public function __construct()
	{
		
	}

	public function index()
	{
		$array = array(
			'title' => 'Page d\'accueil',
		);

		$articles = $this->select(array('*, DATE_FORMAT(publication_article, \'%d/%m/%Y - %H:%i\')'))
			->as('date')
			->from('articles')
			->order('publication_article', 'DESC')
			->limit(0, 5)
			->query()
			->fetch('all', 'obj');

		$array = array_merge($array, array('articles' => $articles));

		$this->render($array);
	}
}