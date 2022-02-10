<?php

namespace App\Validator;

use App\Table\CategoryTable;

class CategoryValidator extends AbstractValidator{

	public function __construct($data, CategoryTable $categoryTable, ?int $categoryID = null)
	{
		parent::__construct($data);
		$this->validator->rule('required', ['title', 'slug']);
		$this->validator->rule('lengthBetween', 'title', 3, 50);
		$this->validator->rule('lengthBetween', 'slug', 5, 100);
		$this->validator->rule('slug', 'slug');	
		$this->validator->rule(function($field, $value) use($categoryTable, $categoryID) {
			return $categoryTable->checkExistence($field, $value, $categoryID);
		}, ['name', 'slug'], 'Cette valeur est déja utilisée');
	}
}