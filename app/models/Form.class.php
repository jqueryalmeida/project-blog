<?php
namespace App\Models;

trait Form
{
	protected $name;

	public function buildForm(array &$form)
	{
		$form = json_decode(json_encode($form));

		var_dump($form);

		$this->insert('Forms', true)
			->values(array(':idForm, :dataForm, :attributes'))
			->prepare()
			->setParam(':idForm', $form->attributes->id)
			->setParam(':dataForm', json_encode($form->input))
			->setParam(':attributes',json_encode($form->attributes))
			->execute();
		
	}

	public function retrieveForm(string $idForm)
	{
		$form = $this->select(array('*'))
			->from('Forms')
			->where('nameForm', '=', ':idForm')
			->prepare()
			->setParam(':idForm', $this->escapeString($idForm))
			->execute()
			->fetch('fetch', 'obj');

		$html = "<form ";

		foreach (json_decode($form->attributes) as $index => $value)
		{
			$html .= $index.'="'.$value.'"';
		}

		$html .= ">";

		foreach (json_decode($form->dataForm) as $index => $value)
		{
			$html .= '<input ';
			//var_dump($index);
			if(is_object($value))
			{
				foreach ($value as $i => $v)
				{
					$html .=  $i.'="'.$v.'"';
				}
			}

			$html .= ' />';
		}

		$html .= "</form>";
		return $html;
	}
}