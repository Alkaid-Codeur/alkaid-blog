<?php

namespace App\HTML;

class Form {
	private array $errors;
	private $data;

	public function __construct($data, $errors)
	{
		$this->data = $data;
		$this->errors = $errors;
	}

	public function textInput(string $field, string $label): string
	{
		return <<<HTML
			<div class="form-group mb-3">
				<label for="{$field}">$label</label>
				<input type="text" class="{$this->getInputClass('form-control', $field)}" name="{$field}" id="{$field}" value="{$this->fillField($field)}" required>
				{$this->getFeedback($field)}
			</div>
		HTML;
	}

	/**
	 * Retourne une chaine de caractere correspondant à la fonction de récupération du champ
	 */
	public function fillField(string $field): string 
	{
		$method = "get" . str_replace(" ", "", ucwords(str_replace("_", " ", $field)));
		return $this->data->$method();
	}

	public function getInputClass(string $default, $field): string 
	{
		$class = $default;
		if(isset($this->errors[$field])) {
			$class .= " is-invalid";
		}
		return $class;
	}

	public function getFeedback($field): ?string
	{
		if(isset($this->errors[$field])) {
			$errors = implode('<br>', $this->errors[$field]);
			$feedback = '<p class="invalid-feedback">'.$errors.'</p>';
			return $feedback;
		}
		else {
			return '';
		}
	}
	
}