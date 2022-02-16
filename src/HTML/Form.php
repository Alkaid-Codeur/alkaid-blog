<?php

namespace App\HTML;

use App\PDOConnection;
use App\Table\CategoryTable;
use DateTime;
use DateTimeInterface;

class Form {
	private $data;
	private array $errors;

	public function __construct($data, array $errors)
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

	public function textarea(string $field, string $label): string
	{
		return <<<HTML
			<div class="form-group mb-3">
				<label for="{$field}">$label</label>
				<textarea type="text" class="{$this->getInputClass('form-control', $field)}" name="{$field}" id="{$field}" required> {$this->fillField($field)} </textarea>
				{$this->getFeedback($field)}
			</div>
		HTML;
	}

	public function multipleSelect(string $field, string $label): string
	{
		$pdo = PDOConnection::getPDO();
		$categories = (new CategoryTable($pdo))->getElements();	
		$options = [];
		$selected = [];
		$fieldValues = $this->fillField($field);
		foreach($fieldValues as $value) {
			$selected[] = $value->getID();
		}
		foreach($categories as $category) {
			$isSelected = (in_array($category->getID(), $selected)) ? "selected" : "";
			$id = $category->getID();
			$name = ucfirst($category->getName());
			$options[] = "<option value=\"$id\" $isSelected>$name</option>";
		}
		$menu = implode('', $options);
		return <<<HTML
			<div class="form-group mt-3">
				<label for="$field">$label</label>
				<select class="form-control basic-multiple-select" name="$field" id="$field" multiple>
					$menu
				</select>
			</div>

		HTML;
	}

	public function insertMedias($field, $label) {
		return <<<HTML

		
		HTML;
	}

	/**
	 * Retourne une chaine de caractere correspondant à la fonction de récupération du champ
	 */
	public function fillField(string $field)
	{
		$method = "get" . str_replace(" ", "", ucwords(str_replace("_", " ", $field)));
		$value = $this->data->$method();
		// if($value instanceof DateTimeInterface) {
		// 	return $value->format('Y-m-d: H:i:s');
		// }
		return $value;
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