<?php

namespace App\Validator;

use Valitron\Validator;

abstract class AbstractValidator {

	protected $data;
	protected $validator;

	public function __construct($data)
	{
		$this->data = $data;
		$this->validator = new Validator($data);
		Validator::lang('fr');
	}

	public function validate(): bool 
	{
		return $this->validator->validate();
	}

	public function getErrors(): array 
	{
		return $this->validator->errors();
	}
}