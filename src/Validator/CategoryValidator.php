<?php

namespace App\Validator;

use App\Table\CategoryTable;

class CategoryValidator extends AbstractValidator{

	public function __construct($data, CategoryTable $categoryTable, ?int $categoryID = null)
	{
		parent::__construct($data);
		$this->validator->rule('required', ['name', 'slug'])->message('Ce champ est requis');
		$this->validator->rule('lengthBetween', 'name', 3, 50)->message('Doit contenir entre 3 et 50 caractères');
		$this->validator->rule('lengthBetween', 'slug', 3, 100)->message('Doit contenir entre 3 et 100 caractères');
		$this->validator->rule('slug', 'slug');	
		$this->validator->rule(function($field, $value) use($categoryTable, $categoryID) {
			return !$categoryTable->checkExistence($field, $value, $categoryID);
		}, ['name', 'slug'])->message('Cette valeur est déja utilisée');
	}
}