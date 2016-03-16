<?php

class Articles extends \Application\Core\Router
{
	protected $user = 0;

	protected $status = array();

	public function __construct()
	{
		Core\Database\ConnectionDB::__construct();
		$this->user = $this->checkUserGrade();
	}

	public function index()
	{

	}

	public function add($add)
	{
		$array = array(
			'file' => 'views/Articles/add.php',
				'script' => 'articles/add.js'
		);

		$categories = $this->select('categories', null, array('*'))
				->execute()
				->getData('all', 'obj');

		$array = array_merge($array, array('categories' => $categories));


		if ($this->user >= 9999)
		{
			if($add[0])
			{
				$post = new PostController(file_get_contents('php://input'));
				$post = $post->getJson();

				$id = uniqid();
				$title = $post->title;
				$desc = $post->desc;
				$cate = $post->cate;
				$text = $post->text;
				$date = date('Y-m-d:H:m:s');
				$author = $this->getSession('id_user');

				if(!empty($title) && !empty($cate) && !empty($text))
				{
					$insert = $this->insert('articles',
							array('id_article, title_article, description_article, text_article, publication_article, author_article, category_article', ':id, :title, :desc, :text, :publi, :author, :cate'),
							array(
									':id' => $id,
									':title' => $title,
									':desc' => $desc,
									':text' => $text,
									':publi' => $date,
									':author' => $author,
									':cate' => $cate,
							));

					$this->status = array(
						'status' => TRUE,
					);

				} else
				{
					$this->status = array(
						'status' => FALSE,
					);
				}
			}

			$array = array_merge($array, $this->status);

			$this->json_output($array);
		} else {
			print "false";
		}
	}

	public function edit()
	{
		$array = array(
			'file' => 'views/Articles/edit.php',

		);

		if($this->user >= 9999)
		{
			$this->json_output($array);
		} else
		{
			print "false";
		}
	}
}