<?php

namespace App\Validator;

use App\Validator\AbstractValidator;

class SendMailValidator extends AbstractValidator{
	public function __construct($data)
	{
		parent::__construct($data);
		$this->validator->rule('required', ['name', 'email', 'subject', 'message']);
		$this->validator->rule('lengthBetween', 'name', 10, 100);
		$this->validator->rule('lengthBetween', 'email', 15, 150);
		$this->validator->rule('lengthMin', 'message', 20);
		$this->validator->rule('email', 'email');	
	}
}