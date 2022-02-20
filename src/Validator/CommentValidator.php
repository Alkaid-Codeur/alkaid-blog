<?php

namespace App\Validator;

class CommentValidator extends AbstractValidator {

	public function __construct($data)
	{
		parent::__construct($data);
		$this->validator->rule('required', ['author_name', 'author_email', 'content'])->message('Ce champ est requis');
		$this->validator->rule('lengthBetween', 'author_name' , 5, 100)->message('Doit contenir entre 5 et 100 caractères');
		$this->validator->rule('lengthBetween',  'author_email', 10, 100)->message('Doit contenir entre 10 et 100 caractères');
		$this->validator->rule('lengthMin', 'content', 20)->message('Doit contenir plus de 20 caractères');
		$this->validator->rule('email', 'author_email')->message('Mail non valide');	
	}
}