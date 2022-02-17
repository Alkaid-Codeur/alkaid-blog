<?php

namespace App\Validator;

use App\Table\PostTable;

class PostValidator extends AbstractValidator {
	public function __construct($data, PostTable $postTable, ?int $postID = null)
	{
		parent::__construct($data);
		$this->validator->rule('required', ['title', 'slug', 'categories', 'content', 'medias'])->message('Ce champ est requis');
		$this->validator->rule('lengthBetween', 'title', 10, 200)->message('Doit contenir entre 10 et 200 caractères');
		$this->validator->rule('lengthBetween', 'slug', 5, 100)->message('Doit contenir entre 5 et 100 caractères');
		$this->validator->rule('slug', 'slug');	
		$this->validator->rule('array', 'categories');
		$this->validator->rule(function($field, $value) use($postTable, $postID) {
			return !$postTable->checkExistence($field, $value, $postID);
		}, ['title', 'slug'])->message('Cette valeur est déja utilisée');
		$this->validator->rule(function($field, $value) use($data){
			return (array_sum($data['medias']['error']) === 0);
		}, 'medias')->message('Aucun fichier sélectionné');
	}
}