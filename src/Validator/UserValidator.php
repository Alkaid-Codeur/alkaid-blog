<?php 

namespace App\Validator;

class UserValidator extends AbstractValidator {
	public function __construct($data)
	{
		parent::__construct($data);
		$this->validator->rule('required', ['mail', 'password'])->message('Ce champ est requis');
		$this->validator->rule('email', 'mail')->message('Mail non valide');	
	}
}