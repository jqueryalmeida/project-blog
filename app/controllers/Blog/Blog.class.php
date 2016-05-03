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

	public function read(int $article)
	{
		$array = array();

		try
		{
			if(is_int($article))
			{
				$article = $this->select(array('*, DATE_FORMAT(publication_article, \' %d/%m /%Y - %H:%i\')'))
					->as('date')
					->from('articles', 'art')
					->join('users', 'us')
					->on('art.author_article', 'us.id_user')
					->where('id_article', '=', $this->escapeString($article))
					->query()
					->fetch('fetch', 'obj');
				$array = array(
					'title' => $article->title_article,
				);

				$array = array_merge($array, array('article' => $article));
			}
			else
			{
				$error = new ErrorClass();
				$error->index();
				
				throw new \Exception('Not an article');
			}
		}
		catch(\Exception $e)
		{
			$this->error($e, 'article_error');
		}

		$this->render($array);
	}
}