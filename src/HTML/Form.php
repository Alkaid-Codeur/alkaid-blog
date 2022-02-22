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

	public function textInput(string $field, string $label, string $type = "text"): string
	{
		return <<<HTML
			<div class="form-group mb-4">
				<label for="{$field}">$label</label>
				<input type="{$type}" class="{$this->getInputClass('form-control', $field)}" name="{$field}" id="{$field}" value="{$this->fillField($field)}" required>
				{$this->getFeedback($field)}
			</div>
		HTML;
	}
	
	public function textarea(string $field, string $label): string
	{
		return <<<HTML
			<div class="form-group mb-4">
				<label for="{$field}">$label</label>
				<textarea id="mytextarea" type="text" rows="15" class="{$this->getInputClass('form-control', $field)}" name="{$field}" id="{$field}" required> {$this->fillField($field)} </textarea>
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
			if(is_object($value)) {
				$selected[] = $value->getID();
			}
			else {
				$selected[] = $value;
			}
		}
		foreach($categories as $category) {
			$isSelected = (in_array($category->getID(), $selected)) ? "selected" : "";
			$id = $category->getID();
			$name = ucfirst($category->getName());
			$options[] = "<option value=\"$id\" $isSelected>$name</option>";
		}
		$fieldName = $field.'[]';
		$menu = implode('', $options);
		return <<<HTML
			<div class="form-group mt-3">
				<label for="$field">$label</label>
				<select class="{$this->getInputClass('form-control basic-multiple-select', $field)}" name="$fieldName" id="$field" multiple required>
					$menu
				</select>
				{$this->getFeedback($field)}
			</div>

		HTML;
	}

	public function insertMedias($field, $label) {
		return <<<HTML
			<div class="input-group mb-3">
				<label class="input-group-text" for="$field">$label</label>
				<input type="file" class="{$this->getInputClass('form-control files-input', $field)}" id="$field" name="{$field}[]" accept="image/*" multiple>
				{$this->getFeedback($field)}
				<div id="input-preview" class="container"></div>
			</div>
		HTML;
	}

	public function checkMode($field, $label1, $label2) {
		return <<<HTML
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="$field" id="radio{$field}1" value="{$field}1" checked>
				<label class="form-check-label" for="radio{$field}1">
					$label1
				</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="$field" id="radio{$field}2" value="{$field}2">
				<label class="form-check-label" for="radio{$field}2">
					$label2
				</label>
			</div>
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