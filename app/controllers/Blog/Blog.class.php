<?php
namespace App\Controllers;

use App\Models\Router;

class Blog extends Router
{
	public function __construct()
	{
	}

	private function getArticle()
	{
		$articles = $articles = $this->select(array('*, DATE_FORMAT(publication_article, \'%d/%m/%Y - %H:%i\')'))
			->as('date')
			->from('articles', 'art')
			->join('categorie', 'cat')
			->on('art.category_article', 'cat.idCategory')
			->where('cat.nameCategory', '=', 'Blog')
			->query()
			->fetch('all', 'obj');

		return $articles;
	}

	function index()
	{
		$array = array(
			'title' => 'Articles de blog',
		);

		$articles = $this->getArticle();

		$array = array_merge($array, array('articles' => $articles));

		$this->render($array);
	}
}