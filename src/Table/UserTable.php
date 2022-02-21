<?php

namespace App\Table;

use PDO;
use App\Table\Table;
use App\Models\Users;

class UserTable extends Table{

	protected $class = Users::class;
	protected $table = 'users';


	/**
	 * Authenfification ...
	 * @param Users $user
	 * @return Users $tempUser || false
	 */
	public function userAuth($user)
	{
		$query = $this->pdo->prepare("SELECT * FROM users WHERE mail = :mail");
		$query->execute([
			'mail' => $user->getMail()
		]);
		$tempUser = $query->fetchAll(PDO::FETCH_CLASS, $this->class);
		if(!empty($tempUser)) {
			if(password_verify($user->getPassword(), $tempUser[0]->getPassword())) {
				return $tempUser[0];
			}
			else return false;
		}
		else return false;
		
	}

}