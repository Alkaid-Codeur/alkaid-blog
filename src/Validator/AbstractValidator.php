<?php

namespace App\Validator;

use Valitron\Validator;

abstract class AbstractValidator {

	private $data;
	private $validator;

	public function __construct($data)
	{
		$this->data = $data;
		$this->validator = new Validator($data);
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