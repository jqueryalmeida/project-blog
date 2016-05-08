<?php
namespace App\Controllers;

use App\Models\Router;

class Skills extends Router
{
	public function __construct()
	{
	}

	private function getAllSkills()
	{
		$skills = $this->select(array('*'))
			->from('skills')
			->query()
			->fetch('all', 'obj');

		return $skills;
	}

	private function getAllExperiences()
	{
		$experiences = $this->select(array('*'))
			->from('experiences')
			->query()
			->fetch('all', 'obj');

		return $experiences;
	}

	public function index()
	{
		$array = array(
			'title' => 'Curriculum Vitae',
			'skills' => $this->getAllSkills(),
			'experiences' => $this->getAllExperiences(),
		);


		$this->render($array);
	}
}